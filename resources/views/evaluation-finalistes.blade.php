<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Nuit du Code | Évaluation des finalistes</title>
</head>
<body>

    @include('inc-nav')

    <?php
    /*
    echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">';
    echo 'LES ÉVALUATIONS DÉBUTENT DÉBUT JUIN';
    echo '</div>';
    echo '</body>';
    echo '</html>';
    exit;    
    */
    /*
    echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">';
    echo 'LES ÉVALUATIONS SONT MAINTEANT TERMINÉES';
    echo '</div>';
    echo '</body>';
    echo '</html>';
    exit;
    */
    ?>

	<div class="container mt-4 mb-5">
		<div class="row pt-3">
			<div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="/console/evaluation-finalistes-categories" role="button"><i class="fas fa-arrow-left" aria-hidden="true"></i></a>
            </div>

			<div class="col-md-10">

                <h1 class="">ÉVALUATIONS</h1>
                <p class="mb-5 text-monospace text-muted">Cliquer sur "valider" en fin de page pour enregistrer les évaluations.</p>

                <?php
                $categorie = Crypt::decryptString($categorie);

                // JEUX A EXCLURE
                //$excluded_games = [1323,1335,866,1036,1359,855,1322,1265,1042,1390,470,1866,1865,1151,98,471,431,1220,1885,196,1484,37,24,845,1107,583,1369,1129,1372,688,1256,1869,811,195,1836,827,812,56,542,1385,1486,837,409,540,986,435,565,1908,506,146,112,562,1754,403,371,1738,594,689,1357];
                $excluded_games = [1323,1335,866,1036,1265,1322,1042,855,1359,1908,1390,565,1950,1951,1953,1798,1605,1955,562,98,837,583,1581,1866,845,1865,470,592,1274,724,688,1385,1220,37,24,1486,435,1836,827,812,1370,373,828,701,1260,1885,1837,700,1868,671,506,689,112,986,1372,1256,1845,1155,1153,409,1738,196,369,442,1379,1367,1151,1038,1129,1434,811,702,1543,1847,287,4,515,56,397,1849,1872,674,1538,372,1348,1604,1826,1088,146,691,1754];
                // Exclure les jeux deja evalues par l'utilisateur
                $excluded_games = array_merge($excluded_games, App\Models\Evaluation_finaliste::where([['jury_id', Auth::user()->id], ['categorie', $categorie]])->pluck('game_id')->toArray());
                // Exclure les jeux evalues 5 fois
                $liste_jeux = App\Models\Game::where([['etablissement_id', '!=', Auth::user()->id], ['type', 'ndc'], ['categorie', $categorie], ['finaliste', 1]])->get();
                foreach ($liste_jeux AS $liste_jeu) {
                    $nb_evals = App\Models\Evaluation_finaliste::where('game_id', $liste_jeu->id)->count();
                    if($nb_evals >= 5){
                        $excluded_games[] = $liste_jeu->id;
                    }
                }

                // JEUX A EVALUER
                $jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
                    ->whereNotIn('games.id', $excluded_games)
                    ->where([
                        ['users.fin_evaluations', '=', 1], 
                        ['games.etablissement_id', '!=', Auth::user()->id], 
                        ['games.type', 'ndc'], 
                        ['games.categorie', $categorie], 
                        ['games.finaliste', 1]
                    ])
                    ->select('games.*')
                    ->inRandomOrder()
                    ->take(4)
                    ->get();

                if (count($jeux) !== 0) {

                    // SCRATCH
                    $critere1_scratch_titre = "Jouabilité";
                    $critere1_scratch_description = "Facilité de prise en main, absence de bogues, clarté des objectifs, environnement intuitif, plaisir...";
                    $critere2_scratch_titre = "Richesse / Complexité";
                    $critere2_scratch_description = "Nombre de lutins et décors, niveaux / scènes multiples, variété des actions, défilements, effets...";
                    $critere3_scratch_titre = "Originalité / Créativité";
                    $critere3_scratch_description = "Utilisation originale des lutins et des décors, orginalité du scénario, lutins à contre emploi...";
                    $critere4_scratch_titre = "Respect des consignes / Documentation";
                    $critere4_scratch_description = "Absence d'éléments extérieurs, intégrité des lutins, documentation claire et complète...";

                    if (in_array($categorie, ['C3', 'C4', 'LY'])) {
                        ?>

                        <form method="POST" action="{{ route('evaluation-finalistes_post') }}">
                            @csrf

                            <?php
                            foreach ($jeux AS $jeu) {

                                $json = @file_get_contents("https://api.scratch.mit.edu/projects/".$jeu->scratch_id);
                                if ($json !== FALSE) {
                                    $jeu_scratch = json_decode($json);
                                    ?>
                                    {{--
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-monospace small text-muted">Création : {{$jeu_scratch->history->created}}</div>
                                            <div class="text-monospace small text-muted">Derniere modification : {{$jeu_scratch->history->modified}}</div>
                                        </div>
                                    </div>
                                    --}}
                                    <div class="row mb-5">
                                        <div class="col-md-7 text-center">

                                            <div class="text-left">
                                            <?php
                                            if (Auth::user()->is_admin == 1) {
                                                $etablissement = App\Models\User::where('id', $jeu->etablissement_id)->first();
                                                ?>
                                                    <h3 class="m-0">{{$jeu->nom_equipe}}</h3>
                                                    <div class="text-monospace text-muted small mb-1" style="font-size:80%;color:silver;">
                                                        [{{$jeu->id}}] {{$etablissement->etablissement}} - {{$etablissement->ville}} - {{$etablissement->pays}}
                                                    </div>
                                                <?php
                                            }
                                            ?>
                                            </div>

                                            <div>
                                                <img src="https://uploads.scratch.mit.edu/get_image/project/{{$jeu->scratch_id}}_282x218.png" class="img-fluid" style="border-radius:4px;" width="100%" />
                                            </div>

                                            <button type="button" class="btn btn-success btn-sm mt-3" onClick="this.previousElementSibling.innerHTML='<iframe src=\'https://scratch.mit.edu/projects/{{$jeu->scratch_id}}/embed\' width=\'100%\' height=\'402\' frameborder=\'0\' scrolling=\'no\'></iframe>'">lancer / recharger le jeu</button>

                                            <div class="mt-4 mb-2 text-monospace small" style="color:silver">Si le jeu ne s'affiche pas correctement, vous pouvez l'ouvrir dans un autre onglet en cliquant <a href="https://scratch.mit.edu/projects/{{$jeu_scratch->id}}" target="_blank">ici</a>.</div>

                                            <div class="mt-4 small text-monospace text-left" style="border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
                                                @if ($jeu_scratch->instructions != NULL)
                                                {!!nl2br($jeu_scratch->instructions)!!}
                                                @else
                                                    <span class="text-danger">pas d'instructions</span>
                                                @endif
                                            </div>
                                            {{--
                                            <div class="text-monospace small text-muted pt-1 pl-1">
                                                <i class="fas fa-gamepad" style="font-size:140%;vertical-align:-1px;"></i> <a href="https://scratch.mit.edu/projects/{{$jeu_scratch->id}}" target="_blank">{{$jeu_scratch->id}}</a> ~
                                                <i class="fas fa-user-circle"></i> <a href="https://scratch.mit.edu/users/{{$jeu_scratch->author->username}}" target="_blank">{{$jeu_scratch->author->username}}</a>
                                            </div>
                                            --}}
                                        </div>
                                        <div class="col-md-5">

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere1_scratch_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere1_scratch_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere1" name="evaluation[{{$jeu->id}}]['critere1']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere1_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere2_scratch_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere2_scratch_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere2" name="evaluation[{{$jeu->id}}]['critere2']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere2_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere3_scratch_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere3_scratch_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere3" name="evaluation[{{$jeu->id}}]['critere3']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere3_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere4_scratch_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere4_scratch_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere4" name="evaluation[{{$jeu->id}}]['critere4']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere4_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <br />
                                    <br />
                                <?php
                                } else {
                                    ?>
                                    <div class="text-monospace small text-danger">Cet identifiant Scratch n'existe pas! [{{$jeu->scratch_id}}]</div>
                                    <div class="text-monospace small text-danger">Vérifier que le jeu a bien été partagé (bouton orange "Partager", ou "Share" en anglais).</div>
                                    <br />
                                    <br />
                                    <?php
                                }
                            }
                            ?>
                            <input id="categorie" name="categorie" type="hidden" value="{{$categorie}}" />
                            <button type="submit" id="submit_jeu" class="btn btn-primary inline" disabled><i class="fas fa-check"></i> valider</button>
                            <span id="submit_warning" class="pl-2 small text-danger text-monospace">il manque au moins un critère</span>
                        </form>
                        <?php
                    }

                    // PYTHON
                    $critere1_python_titre = "Jouabilité";
                    $critere1_python_description = "Facilité de prise en main, absence de bogues, clarté des objectifs, environnement intuitif, plaisir...";
                    $critere2_python_titre = "Richesse / complexité";
                    $critere2_python_description = "Nombre de personnages / objets / décors, niveaux / scènes multiples, variété des actions, défilements, effets...";
                    $critere3_python_titre = "Originalité / créativité";
                    $critere3_python_description = "Utilisation originale des personnages / objets / décors, orginalité du scénario...";
                    $critere4_python_titre = "Consignes / thème / documentation";
                    $critere4_python_description = "Respect des consignes, respect du thème, documentation claire et complète.";

                    if (in_array($categorie, ['PI', 'POO'])) {
                        ?>
                        <form method="POST" action="{{ route('evaluation-finalistes_post') }}">
                            @csrf

                            <?php
                            $n = 0;
                            foreach ($jeux AS $jeu) {
                                $n++;
                                if(File::exists(storage_path("app/public/fichiers_pyxel/".$jeu->etablissement_jeton.'-'.$jeu->python_id))) {
                                    $files = File::files(storage_path("app/public/fichiers_pyxel/".$jeu->etablissement_jeton.'-'.$jeu->python_id));
                                    ?>

                                    <div class="row">
                                        <div class="col-md-7 text-center">

                                            <div id="player_{{$jeu->id}}" class="rounded pt-1 mb-1" style="aspect-ratio:1/1;background-color:#202224;">
                                                <img src="{{ asset('img/pyxel_evaluation.png') }}" style="position:relative;top:40%" />    
                                            </div>
                                            
                                            <div id="warning_{{$jeu->id}}" class="pl-4 pr-1 mb-1 text-monospace text-danger text-left" style="font-size:75%;display:none;">
                                                <ul class="m-0 p-0">
                                                    <li>ne pas cliquer en dehors du cadre du jeu après avoir cliqué sur "click to start" afin de ne pas perdre les commandes (souris / clavier).</li>
                                                    <li>ne pas cliquer sur le mode plein écran après avoir cliqué sur "click to start".</li>
                                                </ul>
                                            </div>

                                            <button type="button" class="mt-3 btn btn-success btn-sm" onClick="this.previousElementSibling.previousElementSibling.innerHTML='<iframe src=\'/ndc/evaluation-pyxel-player/{{ Crypt::encryptString($jeu->etablissement_jeton . '-' . $jeu->python_id) }}\' width=\'100%\' height=\'100%\' frameborder=\'0\' scrolling=\'no\'></iframe>';document.getElementById('warning_{{$jeu->id}}').style.display='block';">lancer / recharger le jeu</button>  

                                            <button type="button" class="mt-3 btn btn-light btn-sm ml-3 pl-3 pr-3" onclick="fullscreen('player_{{$jeu->id}}')" data-toggle="tooltip" data-placement="right" data-title="mode plein écran"><i class="fas fa-expand"></i></i></button> 
                                              
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

                                                @if($fichier_py)
                                                <div class="text-monospace text-left mt-3 ml-1">{{basename($fichier_py)}}</div>
                                                <div style="width:100%;margin:0px auto 0px auto;">
                                                    <div id="editor_code-{{$n}}" style="border-radius:5px;">{{ Storage::disk('local')->get('/public/fichiers_pyxel/'.$jeu->etablissement_jeton.'-'.$jeu->python_id.'/'.basename($fichier_py)) }}</div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mt-4 small text-monospace text-left mb-2" style="border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
                                                @if ($jeu->documentation != NULL)
                                                    {!!nl2br($jeu->documentation)!!}
                                                @else
                                                    <span class="text-danger">pas d'instructions</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere1_python_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere1_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere1" name="evaluation[{{$jeu->id}}]['critere1']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere1_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere2_python_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere2_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere2" name="evaluation[{{$jeu->id}}]['critere2']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere2_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere3_python_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere3_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere3" name="evaluation[{{$jeu->id}}]['critere3']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere3_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere4_python_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere4_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->id}}_critere4" name="evaluation[{{$jeu->id}}]['critere4']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->id}}_critere4_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <br />
                                    <br />
                                <?php
                                }
                            }
                            ?>
                            <input id="categorie" name="categorie" type="hidden" value="{{$categorie}}" />
                            <button type="submit" id="submit_jeu" class="btn btn-primary inline" disabled><i class="fas fa-check"></i> valider</button>
                            <span id="submit_warning" class="pl-2 small text-danger text-monospace">il manque au moins un critère</span>
                        </form>
                        <?php
                    }
                } else {
                    ?>
                    <div class="text-success text-monospace text-center mt-5 pb-4" role="alert">
                        Pas de jeu à évaluer.
                    </div>
                    <?php
                }
                ?>

            </div>
        </div><!-- /row -->
	</div><!-- /container -->

    <script>
    function curseur(id, note) {
        if (note == "-1") {
            document.getElementById(id+"_note").innerHTML = '<i class="fas fa-times text-danger">';
        } else {
            document.getElementById(id+"_note").innerHTML = note;
        }
        var inputs, index, values;
        values = []
        inputs = document.getElementsByTagName('input');
        for (index = 0; index < inputs.length; ++index) {
            values.push(inputs[index].value);
        }
        document.getElementById('submit_jeu').disabled = values.includes("-1");
        if (values.includes("-1")){
            document.getElementById('submit_warning').style.display = "inline";
        } else {
            document.getElementById('submit_warning').style.display = "none";
        }
    }
    </script>

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>

	@include('inc-bottom-js')

    <script src="{{ asset('js/ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>
	<script>
        for (var i = 1; i <= {{ $jeux->count() }}; i++) {
            editor_code = 'editor_code-' + i;
    		var editor_code = ace.edit(editor_code, {
    			theme: "ace/theme/puzzle_code",
    			mode: "ace/mode/python",
    			maxLines: 500,
    			fontSize: 14,
    			wrap: true,
    			useWorker: false,
                highlightActiveLine: false,
                highlightGutterLine: false,
    			showPrintMargin: false,
    			displayIndentGuides: true,
    			showLineNumbers: true,
    			showGutter: true,
    			showFoldWidgets: false,
    			useSoftTabs: true,
    			navigateWithinSoftTabs: false,
    			tabSize: 4,
                readOnly: true
    		});
            editor_code.container.style.lineHeight = 1.5;
        }
	</script>

</body>
</html>
