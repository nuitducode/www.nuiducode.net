<?php
if (App\Models\User::where('jeton', $etablissement_jeton)->exists()) {
    $etablissement = App\Models\User::where('jeton', $etablissement_jeton)->first();
} else {
    header("Location: /");
    exit();
}
?>
@include('inc-top')
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.svg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <!-- <script src="https://kit.fontawesome.com/692fbff6c4.js" crossorigin="anonymous"></script> -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Open Graph -->
    <meta property="og:title" content="Nuit du Code 2023 - {{$etablissement->etablissement}}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée." />
    <meta property="og:url" content="https://www.nuitducode.net/ndc2023/{{$etablissement->jeton}}" />
    <meta property="og:image" content="{{ asset('img/open-graph-etablissement.png') }}" />
    <meta property="og:image:alt" content="Nuit du Code" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@nuitducode">
    <meta name="twitter:creator" content="@nuitducode">
    <meta name="twitter:title" content="Nuit du Code 2023 - {{$etablissement->etablissement}}">
    <meta name="twitter:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée.">
    <meta name="twitter:image" content="{{ asset('img/open-graph-etablissement.png') }}">

    <!-- Matomo - données anonymisées - pas de cookies - RGPD -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//www.awame.net/matomo/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '10']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->  

    <title>Nuit du Code | Jeux 2023</title>
</head>
<body>

    @include('inc-nav')

    <div class="container mb-5">
		<div class="row">
            <div class="col-md-2">
                <div class="mt-4 text-monospace small sticky-top">
                    <br />
                    <b style="text-transform: uppercase">{{$etablissement->etablissement}}</b><br />
                    @if (strpos($etablissement->ac_zone, "AEFE") !== FALSE)
                        {{$etablissement->ac_zone}}<br />
                    @else
                        Académie: {{$etablissement->ac_zone}}<br />
                    @endif
                    {{$etablissement->ville}}<br />
                    {{$etablissement->pays}}<br />
                    <br />
                </div>
            </div>
			<div class="col-md-10">
                <div class="text-center text-monospace">
                    <img src="{{ asset('img/ndc2023.png') }}" width="280" />
                    <div class="font-weight-bold" style="font-size:17px;color:#261b0c;">6h pour coder un jeu</div>
                    <div class="font-weight-bold" style="font-size:12px;color:gray">~ 7<sup>e</sup> édition ~</div>
                </div>
                <div class="mt-3 text-center text-monospace">
                    <?php
                    // Catégories
                    $categories = ['C3' => 'Scratch CM1 > 6<sup>e</sup>', 'C4' => 'Scratch 5<sup>e</sup> > 3<sup>e</sup>', 'LY' => 'Scratch Lycée', 'PI' => 'Python NSI 1<sup>re</sup>', 'POO' => 'Python NSI Tle'];
                    foreach ($categories AS $categorie_code => $categorie) {
                        $nb_jeux = App\Models\Game::where([
                            ['is_public', 1], 
                            ['etablissement_jeton', $etablissement_jeton], 
                            ['type', 'ndc'], 
                            ['categorie', $categorie_code]
                        ])
                        ->count();
                        if ($nb_jeux !== 0) {
                            echo '<a class="btn btn-success btn-sm mb-1 ml-1 mr-1" href="#'.$categorie_code.'" role="button">'.$categorie.'</a>';
                        }
                    }
                    ?>
                </div>

                <?php
                // Catégories
                $categories = ['C3' => 'Scratch - Cycle 3', 'C4' => 'Scratch - Cycle 4', 'LY' => 'Scratch - Lycée'];
                foreach ($categories AS $categorie_code => $categorie) {
                    $jeux = App\Models\Game::where([
                        ['is_public', 1], 
                        ['etablissement_jeton', $etablissement_jeton], 
                        ['type', 'ndc'], 
                        ['categorie', $categorie_code]
                    ])
                    ->inRandomOrder()
                    ->get();
                    ?>
                    @if(count($jeux) !== 0)
                        <div class="mt-5 mb-5">
                            <h2 id="{{$categorie_code}}" class="m-0 mb-2">{{$categorie}}</h2>
                            <div class="row row-cols-1 row-cols-md-2">
                                @foreach($jeux AS $jeu)
                                    @php
                                    $json = @file_get_contents("https://api.scratch.mit.edu/projects/".$jeu->scratch_id);
                                    @endphp
                                    @if ($json !== FALSE)
                                        @php
                                        $jeu_scratch = json_decode($json);
                                        @endphp

                                        <div class="col mb-4">
                                            <div class="card p-3 h-100" style="background-color:#f8fafc;border-radius:5px;">
                                                <div class="card-body p-0">
                                                    <h3 class="mt-0" style="color:#4cbf56">
                                                        {{$jeu->nom_equipe}}
                                                    </h3>
                                                    <div class="text-center">
                                                        <div>
                                                            <img src="https://uploads.scratch.mit.edu/get_image/project/{{$jeu->scratch_id}}_282x218.png" class="img-fluid" style="border-radius:4px;" width="100%" />
                                                        </div>
                                                        <button type="button" class="btn btn-primary btn-sm mt-3" onClick="this.previousElementSibling.innerHTML='<iframe src=\'https://scratch.mit.edu/projects/{{$jeu->scratch_id}}/embed\' width=\'100%\' height=\'402\' frameborder=\'0\' scrolling=\'no\'></iframe>'">
                                                            lancer / recharger le jeu
                                                        </button>
                                                    </div>
                                                    <div class="mt-4 mb-2 text-monospace small" style="color:silver">
                                                    Ouvrir le jeu en mode plein écran dans un <a href="https://scratch.mit.edu/projects/{{$jeu_scratch->id}}/fullscreen" target="_blank">nouvelle onglet</a>.
                                                    </div>
                                                    <div class="mt-4 small text-monospace text-left" style="border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
                                                        @if ($jeu_scratch->instructions != NULL)
                                                            {!!nl2br($jeu_scratch->instructions)!!}
                                                        @else
                                                            <span class="text-danger">pas d'instructions</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <?php
                }

                // PYTHON
                // Catégories
                $categories = ['PI' => 'Python - Première', 'POO' => 'Python - Terminale'];
                foreach ($categories AS $categorie_code => $categorie) {
                    $jeux = App\Models\Game::where([
                        ['is_public', 1], 
                        ['etablissement_jeton', $etablissement_jeton], 
                        ['type', 'ndc'], 
                        ['categorie', $categorie_code]
                    ])
                    ->inRandomOrder()
                    ->get();
                    ?>
                    @if(count($jeux) !== 0)
                        <div class="mt-5 mb-5">
                            <h2 id="{{$categorie_code}}" class="m-0 mb-2">{{$categorie}}</h2>
                            <div class="row row-cols-1 row-cols-md-2">
                              
                            <?php
                            $n = 0;
                            foreach ($jeux AS $jeu) {
                                $n++;
                                if(File::exists(storage_path("app/public/fichiers_pyxel/".$jeu->etablissement_jeton.'-'.$jeu->python_id))) {
                                    $files = File::files(storage_path("app/public/fichiers_pyxel/".$jeu->etablissement_jeton.'-'.$jeu->python_id));
                                    ?>
                                    <div class="col mb-4">
                                        <div class="card p-3 h-100" style="background-color:#f8fafc;border-radius:5px;">
                                            <div class="card-body p-0">
                                                <h3 class="mt-0" style="color:#4cbf56">
                                                    {{$jeu->nom_equipe}}
                                                </h3>
                                                <div class="text-center">
                                                    <div id="player_{{$jeu->id}}" class="rounded pt-1 mb-1" style="aspect-ratio:1/1;background-color:#202224;">
                                                        <img src="{{ asset('img/pyxel_evaluation.png') }}" style="position:relative;top:40%" />    
                                                    </div>
                                                    <div id="warning_{{$jeu->id}}" class="pl-4 pr-1 mb-1 text-monospace text-danger text-left" style="font-size:75%;display:none;">
                                                        <ul class="m-0 p-0">
                                                            <li>ne pas cliquer en dehors du cadre du jeu après avoir cliqué sur "click to start" afin de ne pas perdre les commandes (souris / clavier).</li>
                                                            <li>ne pas cliquer sur le mode plein écran après avoir cliqué sur "click to start".</li>
                                                        </ul>
                                                    </div>
                                                    <button type="button" class="mt-3 btn btn-primary btn-sm" onClick="this.previousElementSibling.previousElementSibling.innerHTML='<iframe src=\'/ndc/evaluation-pyxel-player/{{ Crypt::encryptString($jeu->etablissement_jeton . '-' . $jeu->python_id) }}\' width=\'100%\' height=\'100%\' frameborder=\'0\' scrolling=\'no\'></iframe>';document.getElementById('warning_{{$jeu->id}}').style.display='block';">lancer / recharger le jeu</button>  
                                                    <button type="button" class="mt-3 btn btn-light btn-sm ml-3 pl-3 pr-3" onclick="fullscreen('player_{{$jeu->id}}')" data-toggle="tooltip" data-placement="right" data-title="mode plein écran"><i class="fas fa-expand"></i></i></button> 
                                                </div>
                                                <div class="mt-4 mb-2 text-monospace small text-left" style="color:silver">Si le jeu ne s'affiche pas correctement, vous pouvez utiliser ce <a data-toggle="collapse" href="#collapse_{{$jeu->id}}" role="button" aria-expanded="false" aria-controls="collapse_{{$jeu->id}}">code Python</a>.</div>

                                                <div class="collapse mb-4" id="collapse_{{$jeu->id}}">
<pre class="m-0 text-left"><code id="htmlViewer" style="color:rgb(216, 222, 233); font-weight:400;background-color:rgb(46, 52, 64);background:rgb(46, 52, 64);display:block;padding: 1.5em;border-radius:5px;"><span style="color:rgb(129, 161, 193); font-weight:400;">import</span> requests, os
code = <span style="color:rgb(163, 190, 140); font-weight:400;">'{{$jeu->etablissement_jeton}}-{{$jeu->python_id}}'</span>
site = <span style="color:rgb(163, 190, 140); font-weight:400;">'https://www.nuitducode.net'</span>
url = site + <span style="color:rgb(163, 190, 140); font-weight:400;">'/storage/fichiers_pyxel/'</span> + code
@foreach($files as $file)
<span style="color:rgb(129, 161, 193); font-weight:400;">{{pathinfo($file, PATHINFO_EXTENSION)}}</span> = requests.<span style="color:rgb(129, 161, 193); font-weight:400;">get</span>(url + <span style="color:rgb(163, 190, 140); font-weight:400;">'/{{basename($file)}}'</span>)
with <span style="color:rgb(129, 161, 193); font-weight:400;">open</span>(<span style="color:rgb(163, 190, 140); font-weight:400;">'{{basename($file)}}'</span>, <span style="color:rgb(163, 190, 140); font-weight:400;">'wb'</span>) <span style="color:rgb(129, 161, 193); font-weight:400;">as</span> file:
file.write(<span style="color:rgb(129, 161, 193); font-weight:400;">{{pathinfo($file, PATHINFO_EXTENSION)}}</span>.content)
@endforeach
@foreach($files as $file)
@if(pathinfo($file, PATHINFO_EXTENSION) == 'py')
print(<span style="color:rgb(129, 161, 193); font-weight:400;">py</span>.content.<span style="color:rgb(129, 161, 193); font-weight:400;">decode</span>())
os.system(<span style="color:rgb(163, 190, 140); font-weight:400;">'pyxel run "{{basename($file)}}"'</span>)
@endif
@endforeach
</code></pre>
                                                    <div class="text-monospace text-muted p-2" style="text-align:justify;font-size:70%;">
                                                        Copier-coller ce code dans un environnement Python possédant la bibliothèque <a href="https://github.com/kitao/pyxel/" target="_blank">Pyxel</a> pour lancer le jeu.<br />
                                                        Pour installer un environnement Python + Pyxel, voir la <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/02-installation/" target="_blank">documentation</a>.
                                                    </div>
                                                </div>

                                                <div class="mb-2 text-left text-monospace small" style="color:silver">Afficher les <a data-toggle="collapse" href="#fichiers_{{$jeu->id}}" role="button" aria-expanded="false" aria-controls="fichiers_{{$jeu->id}}">fichiers</a>.</div>

                                                <div class="collapse mb-4" id="fichiers_{{$jeu->id}}">
                                                    <ul class="list-group text-left small text-monospace">
                                                    @foreach($files as $file)
                                                        <?php
                                                        if(pathinfo($file, PATHINFO_EXTENSION) == 'py') {
                                                            $fichier_py = $file;
                                                        }
                                                        ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center p-2 pl-3 pr-3">
                                                            {{basename($file)}}
                                                            <a href="/storage/fichiers_pyxel/{{$jeu->etablissement_jeton}}-{{$jeu->python_id}}/{{basename($file)}}" class="text-secondary" download><i class="fa-solid fa-circle-arrow-down"></i></a>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                </div>

                                                <div class="mt-4 small text-monospace text-left mb-2" style="border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
                                                    @if ($jeu->documentation != NULL)
                                                        {!!nl2br(htmlentities($jeu->documentation))!!}
                                                    @else
                                                        <span class="text-danger">pas d'instructions</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    @endif
                    <?php
                }
                ?>

            </div><!-- /col -->
        </div><!-- /row -->
	</div><!-- /container -->

    <script>
		function fullscreen(id) {
			var el = document.getElementById(id);
			if (el.requestFullscreen) {
				el.requestFullscreen();
			} else if (el.webkitRequestFullscreen) { /* Safari */
				el.webkitRequestFullscreen();
			} else if (el.msRequestFullscreen) { /* IE11 */
				el.msRequestFullscreen();
			}
		}
	</script>   

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>

	@include('inc-bottom-js')

</body>
</html>
