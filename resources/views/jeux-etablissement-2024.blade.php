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

    <!-- Open Graph -->
    <meta property="og:title" content="Nuit du Code 2024 - {{$etablissement->etablissement}}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée / Post-bac." />
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
    <meta name="twitter:title" content="Nuit du Code 2024 - {{$etablissement->etablissement}}">
    <meta name="twitter:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée / Post-bac.">
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

    <title>Nuit du Code | Jeux 2024</title>
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
					<?php
                    $twitter_text = urlencode($etablissement->etablissement.": les jeux de la Nuit du Code 2024 \n ➡️ https://www.nuitducode.net/ndc2024/".$etablissement_jeton." \n\n #NDC2024 #Scratch #Python #NSI \n @nuitducode");
                    $mastodon_text = urlencode($etablissement->etablissement.": les jeux de la Nuit du Code 2024 \n ➡️ https://www.nuitducode.net/ndc2024/".$etablissement_jeton." \n\n #NDC2024 #Scratch #Python #NSI \n @nuitducode@mastodon.social");
                    ?>
                    Partagez cette page sur <a href="https://mastodonshare.com/?text={{$mastodon_text}}" target="_blank">Mastodon</a> et/ou <a href="https://twitter.com/intent/tweet?text={{$twitter_text}}" target="_blank">Twitter</a>.					
                </div>
            </div>
			<div class="col-md-10">
                <div class="text-center text-monospace">
                    <img src="{{ asset('img/ndc2024.png') }}" width="280" />
                    <div class="font-weight-bold" style="font-size:17px;color:#261b0c;">6h pour coder un jeu</div>
                    <div class="font-weight-bold" style="font-size:12px;color:gray">~ 8<sup>e</sup> édition ~</div>
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
				
				<div class="mt-3 text-center text-monospace">
					Les élèves ont eu 6h seulement pour découvrir les univers, imaginer un jeu et le coder.
				</div>

                <?php
                // Catégories
                $categories = ['C3' => 'SCRATCH - Cycle 3 (CM1 > 6<sup>e</sup>)', 'C4' => 'SCRATCH - Cycle 4 (5<sup>e</sup> > 3<sup>e</sup>)', 'LY' => 'SCRATCH - Lycée'];
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
                        <div class="mb-5">
                            <h2 id="{{$categorie_code}}" class="m-0 mb-2" style="text-transform:none">{!!$categorie!!}</h2>
                            <div class="row row-cols-1 row-cols-md-2">
							
                                @foreach($jeux AS $jeu)
                                   
									<div class="col mb-4">
										<div class="card p-3 h-100" style="background-color:#f8fafc;border-radius:5px;">
											<div class="card-body p-0">
												<h3 class="mt-0" style="color:#4cbf56">
													{{$jeu->nom_equipe}}
												</h3>
												@include('inc-iframe-scratch')
											</div>
										</div>
									</div>
                      
                                @endforeach
								
                            </div>
                        </div>
                    @endif
                    <?php
                }

                // PYTHON
                // Catégories
                $categories = ['PI' => 'Python - Première', 'POO' => 'Python - Terminale', 'PB' => 'Python - Post-bac'];
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
                              
								@foreach ($jeux AS $jeu)

									<?php
									$files = File::files(storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id));
									?>
									
									<div class="col mb-4">
										<div class="card p-3 h-100" style="background-color:#f8fafc;border-radius:5px;">
											<div class="card-body p-0">
												<h3 class="mt-0" style="color:#4cbf56">
													{{$jeu->nom_equipe}}
												</h3>
												@include('inc-iframe-python')
											</div>
										</div>
									</div>
									
								@endforeach
								
							</div>
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
