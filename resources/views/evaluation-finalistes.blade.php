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
                
                <?php
				$nb_evaluations_par_jeu = 5;

                $categorie = Crypt::decryptString($categorie);

                // JEUX A EXCLURE
                
                //$excluded_games = [1323,1335,866,1036,1359,855,1322,1265,1042,1390,470,1866,1865,1151,98,471,431,1220,1885,196,1484,37,24,845,1107,583,1369,1129,1372,688,1256,1869,811,195,1836,827,812,56,542,1385,1486,837,409,540,986,435,565,1908,506,146,112,562,1754,403,371,1738,594,689,1357];
                //$excluded_games = [1323,1335,866,1036,1265,1322,1042,855,1359,1908,1390,565,1950,1951,1953,1798,1605,1955,562,98,837,583,1581,1866,845,1865,470,592,1274,724,688,1385,1220,37,24,1486,435,1836,827,812,1370,373,828,701,1260,1885,1837,700,1868,671,506,689,112,986,1372,1256,1845,1155,1153,409,1738,196,369,442,1379,1367,1151,1038,1129,1434,811,702,1543,1847,287,4,515,56,397,1849,1872,674,1538,372,1348,1604,1826,1088,146,691,1754];
				
                $excluded_games = [];

                // Exclure les jeux deja evalues par l'utilisateur
                $excluded_games = array_merge($excluded_games, App\Models\Evaluation_finaliste::where([['jury_id', Auth::user()->id], ['categorie', $categorie]])->pluck('game_id')->toArray());
                
                // Exclure les jeux evalues 4 fois
                $liste_jeux = App\Models\Game::where([['etablissement_id', '!=', Auth::user()->id], ['type', 'ndc'], ['categorie', $categorie], ['finaliste', 1]])->get();
                foreach ($liste_jeux AS $liste_jeu) {
                    $nb_evals = App\Models\Evaluation_finaliste::where([['game_id', $liste_jeu->id],['removed', '=', 0]])->count();
                    if($nb_evals >= $nb_evaluations_par_jeu){
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
                        ['games.finaliste', 1],
						['games.removed_from_finalists', '=', 0]
                    ])
                    ->select('games.*')
                    ->inRandomOrder()
                    ->take(4)
                    ->get();

                if (count($jeux) !== 0) {

                    ?>
                    <p class="mb-5 text-monospace text-muted">Cliquer sur "valider" en fin de page pour enregistrer les évaluations.</p>
                    <?php

                    // SCRATCH
                    if (in_array($categorie, ['C3', 'C4', 'LY'])) {

						$critere1_scratch_titre = "Jouabilité";
						$critere1_scratch_description = "
						<div class='pt-2 pb-0 pr-2'>
						<ul class='pl-3'>					
							<li><b>jeu injouable</b><br />Le jeu est gravement affecté par des bugs majeurs qui compromettent, dès le début, la jouabilité (plantages, erreurs d'affichage, situations où le joueur se retrouve bloqué de manière irrémédiable...).</li>
							<li><b>jeu incomplet</b><br />Le jeu débute correctement mais il est rapidement affecté par des bugs majeurs qui interrompent l'expérience.</li>
							<li><b>jouabilité bonne avec quelques bogues non bloquants</b><br />Malgré quelques bugs mineurs, le jeu offre une expérience de jeu globalement fluide et agréable. Les bugs rencontrés sont généralement mineurs et n'entravent pas sérieusement la progression ou le plaisir de jouer.</li>
							<li><b>jouabilité bonne et sans bogues</b><br />Le jeu est exempt de bugs, offrant une expérience de jeu fluide et agréable.</li>
							<li><b>jouabilité excellente</b><br />Le jeu est exempt de bugs, offrant une excellente expérience de jeu fluide et très agréable.</li>
						</ul>
						</div>
						";
						$critere2_scratch_titre = "Originalité / Créativité";
						$critere2_scratch_description = "
						<div class='pt-2 pb-0 pr-2'>
						<ul class='pl-3'>	
							<li><b>jeu classique</b><br />Le jeu est classique. Il semble largement inspiré ou copié d'autres titres existants.</li>
							<li><b>jeu classique revisité</b><br />Le jeu s'appuit sur des mécanismes classiques mais il apporte quelques éléments originaux.</li>
							<li><b>jeu original</b><br />Le jeu présente des éléments originaux et créatifs qui le distinguent des autres titres du même genre.
							<li><b>jeu très original</b><br />L'originalité est l'une des forces principales du jeu, avec des idées novatrices et des concepts décalés.</li>
						</ul>
						</div>
						";
						$critere3_scratch_titre = "Respect des consignes";
						$critere3_scratch_description = "
						<div class='pt-2 pb-0 pr-2'>
						Consignes Scratch:
						<ul class='pl-3'>
							<li>La présentation et le mode d'emploi du jeu doivent être écrits en français.</li>
							<li>Ne pas ajouter de lutins. Seuls ceux fournis dans l'univers de jeu doivent être utilisés.</li>
							<li>Ne pas ajouter de lutins. Seuls ceux fournis dans l'univers de jeu doivent être utilisés.</li>
							<li>Ne pas ajouter de scènes. Seules celles fournies dans l'univers de jeu doivent être utilisés.</li>
							<li>Ne pas ajouter de sons. Seuls ceux fournis dans l'univers de jeu doivent être utilisés.</li>
							<li>Ne pas faire des retouches graphiques importantes des éléments de l'univers de jeu. Seules les retouches mineures sont autorisées.</li>
							<li>Ne pas regarder ou copier/coller des scripts d'autres projets trouvés sur internet ou sur l'ordinateur.</li>
							<li>Ne pas aller chercher des informations ou de l'aide sur internet ou sur l'ordinateur.</li>
							<li>Ne pas utiliser des notes personnelles ou de la documentation papier.</li>
						</ul>
						</div>
						";
						$critere4_scratch_titre = "Présentation / mode d'emploi";	
                        ?>

                        <form method="POST" action="{{ route('evaluation-finalistes_post') }}">
                            @csrf

                            <?php
                            foreach ($jeux AS $jeu) {
                                ?>
                                <div class="row">
                                    <div class="col-md-7 text-center">
										
										<div id="player_{{$jeu->id}}" class="pt-1 mb-1" style="border-radius:4px;width:100%;height:420px;background-color:#f3f5f7;">
											<img src="{{ asset('img/scratch_evaluation.png') }}" style="position:relative;top:40%" />    
										</div>										

                                        <button type="button" class="btn btn-success btn-sm mt-3" onClick="this.previousElementSibling.innerHTML='<iframe id=\'iframe_{{$jeu->id}}\'  src=\'https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{strtolower($jeu->etablissement_jeton)}}/{{$jeu->scratch_id}}.sb3\' width=\'100%\' height=\'402\' allowtransparency=\'true\' frameborder=\'0\' scrolling=\'no\'></iframe>'">lancer / recharger le jeu</button>

                                        <button type="button" class="mt-3 btn btn-light btn-sm ml-3 pl-3 pr-3" onclick="fullscreen('iframe_{{$jeu->id}}')" data-toggle="tooltip" data-placement="right" data-title="mode plein écran"><i class="fas fa-expand"></i></i></button> 

                                        <div class="mt-4 mb-2 text-monospace small" style="color:silver">Si vous voulez voir le code ou si le jeu ne s'affiche pas correctement, vous pouvez l'ouvrir dans un autre onglet en cliquant sur <a href="https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{strtolower($jeu->etablissement_jeton)}}/{{$jeu->scratch_id}}.sb3" target="_blank">ici</a>.</div>

                                        <div class="mt-2 small text-monospace text-left" style="overflow-wrap: break-word;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
											{!! nl2br(e($jeu->documentation)) !!}
                                        </div>
										
                                    </div>
                                    <div class="col-md-5">
										
                                        <div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere1_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere1_scratch_description}}"></i></sup></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere1_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere1" name="evaluation[{{$jeu->id}}]['critere1']" class="custom-range" value="-2" min="-2" max="8" step="2" oninput="curseur(this.id, this.value);">
                                                    
                                                </div>
                                                <div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->scratch_id}}_critere1_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere2_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere2_scratch_description}}"></i></sup></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere2_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere2" name="evaluation[{{$jeu->id}}]['critere2']" class="custom-range" value="-2" min="-2" max="6" step="2" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->scratch_id}}_critere2_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere3_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere3_scratch_description}}"></i></sup></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere3_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere3" name="evaluation[{{$jeu->id}}]['critere3']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->scratch_id}}_critere3_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere4_scratch_titre}}</div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere4_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere4" name="evaluation[{{$jeu->id}}]['critere4']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->scratch_id}}_critere4_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
										
										<div id="{{$jeu->scratch_id}}_total" class="text-monospace text-right font-weight-bold text-primary" style="padding-right:12px;">&nbsp;</div>

                                    </div>
                                </div>
                                <br />
                                <br />
                                <?php
                            }
                            ?>
                            <input id="categorie" name="categorie" type="hidden" value="{{$categorie}}" />
                            <button type="submit" id="submit_jeu" class="btn btn-primary inline" disabled><i class="fas fa-check"></i> valider</button>
                            <span id="protection_validation" class="pl-2 small text-danger text-monospace">il manque au moins un critère</span>
                        </form>
                        <?php
                    }


                    // PYTHON
                    if (in_array($categorie, ['PI', 'POO', 'PB'])) {
                        
						$critere1_python_titre = "Jouabilité";
						$critere1_python_description = "
						<div class='pt-2 pb-0 pr-2'>
						<ul class='pl-3'>					
							<li><b>jeu injouable</b><br />Le jeu est gravement affecté par des bugs majeurs qui compromettent, dès le début, la jouabilité (plantages, erreurs d'affichage, situations où le joueur se retrouve bloqué de manière irrémédiable...).</li>
							<li><b>jeu incomplet</b><br />Le jeu débute correctement mais il est rapidement affecté par des bugs majeurs qui interrompent l'expérience.</li>
							<li><b>jouabilité bonne avec quelques bogues non bloquants</b><br />Malgré quelques bugs mineurs, le jeu offre une expérience de jeu globalement fluide et agréable. Les bugs rencontrés sont généralement mineurs et n'entravent pas sérieusement la progression ou le plaisir de jouer.</li>
							<li><b>jouabilité bonne et sans bogues</b><br />Le jeu est exempt de bugs, offrant une expérience de jeu fluide et agréable.</li>
							<li><b>jouabilité excellente</b><br />Le jeu est exempt de bugs, offrant une excellente expérience de jeu fluide et très agréable.</li>
						</ul>
						</div>
						";
						$critere2_python_titre = "Originalité / Créativité";
						$critere2_python_description = "
						<div class='pt-2 pb-0 pr-2'>
						<ul class='pl-3'>	
							<li><b>jeu classique</b><br />Le jeu est classique. Il semble largement inspiré ou copié d'autres titres existants.</li>
							<li><b>jeu classique revisité</b><br />Le jeu s'appuit sur des mécanismes classiques mais il apporte quelques éléments originaux.</li>
							<li><b>jeu original</b><br />Le jeu présente des éléments originaux et créatifs qui le distinguent des autres titres du même genre.
							<li><b>jeu très original</b><br />L'originalité est l'une des forces principales du jeu, avec des idées novatrices et des concepts décalés.</li>
						</ul>
						</div>
						";
						$critere3_python_titre = "Respect des consignes";
						$critere3_python_description = "
						<div class='pt-2 pb-0 pr-2'>
							Consignes Python:
							<ul class='pl-3'>
								<li>La présentation et le mode d'emploi du jeu doivent être écrits en français.</li>
								<li>La taillede l'écran doit être de 128x128 ou 256x256 pixels.</li>
								<li>Ne pas modifier les images de la banque d'images du fichier .pyxres fourni.</li>
								<li>Ne pas ajouter d'images dans la banque d'images du fichier .pyxres fourni.</li>
								<li>Ne pas importer de fichier .py.</li>
								<li>Ne pas importer des fichiers .pyxres autres que ceux fournis.</li>
								<li>Ne pas regarder ou copier/coller du code trouvés sur internet ou sur l'ordinateur.</li>
								<li>Ne pas aller chercher des informations ou de l'aide sur internet ou sur l'ordinateur.</li>
								<li>Ne pas utiliser des notes personnelles ou de la documentation papier (autre que celle fournie).</li>
								<li>Si le thème a été choisi, ne pas sortir du cadre du thème.</li>
							</ul>
						</div>
						";
						$critere4_python_titre = "Présentation / mode d'emploi";
                        ?>
                        
                        <form method="POST" action="{{ route('evaluation-finalistes_post') }}">
                            @csrf

                            <?php
                            $n = 0;
                            foreach ($jeux AS $jeu) {
                                $n++;
                                if(File::exists(storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id))) {
                                    $files = File::files(storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id));
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
codes = <span style="color:rgb(163, 190, 140); font-weight:400;">'{{$jeu->etablissement_jeton}}/{{$jeu->python_id}}'</span>
site = <span style="color:rgb(163, 190, 140); font-weight:400;">'https://www.nuitducode.net'</span>
url = site + <span style="color:rgb(163, 190, 140); font-weight:400;">'/storage/depot-jeux/python/'</span> + codes
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
                                                        <a href="/storage/depot-jeux/python/{{$jeu->etablissement_jeton}}/{{$jeu->python_id}}/{{basename($file)}}" class="text-secondary" download><i class="fa-solid fa-circle-arrow-down"></i></a>
                                                    </li>
                                                @endforeach
                                                </ul>

                                                @if($fichier_py)
                                                <div class="text-monospace text-left mt-3 ml-1">{{basename($fichier_py)}}</div>
                                                <div style="width:100%;margin:0px auto 0px auto;">
                                                    <div id="editor_code-{{$n}}" style="border-radius:5px;">{{ Storage::disk('local')->get('/public/depot-jeux/python/'.$jeu->etablissement_jeton.'/'.$jeu->python_id.'/'.basename($fichier_py)) }}</div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mt-2 small text-monospace text-left mb-2" style="overflow-wrap: break-word;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
												{!! nl2br(e($jeu->documentation)) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-5">
										
											<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
												<div class="text-uppercase" style="color:#cf63cf">{{$critere1_python_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere1_python_description}}"></i></sup></div>
												<div class="row">
													<div class="col">
														<div id="{{$jeu->python_id}}_critere1_description" class="text-monospace text-muted small">&nbsp;</div>
														<input type="range" id="{{$jeu->python_id}}_critere1" name="evaluation[{{$jeu->id}}]['critere1']" class="custom-range" value="-2" min="-2" max="8" step="2" oninput="curseur(this.id, this.value);">
														
													</div>
													<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->python_id}}_critere1_note" style="width:40px;">
														<i class="fas fa-times text-danger"></i>
													</div>
												</div>
											</div>

											<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
												<div class="text-uppercase" style="color:#cf63cf">{{$critere2_python_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere2_python_description}}"></i></sup></div>
												<div class="row">
													<div class="col">
														<div id="{{$jeu->python_id}}_critere2_description" class="text-monospace text-muted small">&nbsp;</div>
														<input type="range" id="{{$jeu->python_id}}_critere2" name="evaluation[{{$jeu->id}}]['critere2']" class="custom-range" value="-2" min="-2" max="6" step="2" oninput="curseur(this.id, this.value);">
													</div>
													<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->python_id}}_critere2_note" style="width:40px;">
														<i class="fas fa-times text-danger"></i>
													</div>
												</div>
											</div>

											<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
												<div class="text-uppercase" style="color:#cf63cf">{{$critere3_python_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere3_python_description}}"></i></sup></div>
												<div class="row">
													<div class="col">
														<div id="{{$jeu->python_id}}_critere3_description" class="text-monospace text-muted small">&nbsp;</div>
														<input type="range" id="{{$jeu->python_id}}_critere3" name="evaluation[{{$jeu->id}}]['critere3']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
													</div>
													<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->python_id}}_critere3_note" style="width:40px;">
														<i class="fas fa-times text-danger"></i>
													</div>
												</div>
											</div>

											<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
												<div class="text-uppercase" style="color:#cf63cf">{{$critere4_python_titre}}</div>
												<div class="row">
													<div class="col">
														<div id="{{$jeu->python_id}}_critere4_description" class="text-monospace text-muted small">&nbsp;</div>
														<input type="range" id="{{$jeu->python_id}}_critere4" name="evaluation[{{$jeu->id}}]['critere4']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
													</div>
													<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="{{$jeu->python_id}}_critere4_note" style="width:40px;">
														<i class="fas fa-times text-danger"></i>
													</div>
												</div>
											</div>
											
											<div id="{{$jeu->python_id}}_total" class="text-monospace text-right font-weight-bold text-primary" style="padding-right:12px;">&nbsp;</div>

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
                            <span id="protection_validation" class="pl-2 small text-danger text-monospace">il manque au moins un critère</span>
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
 	
		let critere1_prev
		let critere2_prev
		let critere3_prev
		let critere4_prev
		
        function curseur(id, note) {

            let critere_1 = ['jeu injouable', 'jeu incomplet', 'jouabilité bonne avec quelques bogues non bloquants', 'jouabilité bonne et sans bogues', 'jouabilité excellente'];
            let critere_2 = ['jeu classique', 'jeu classique revisité', 'jeu original', 'jeu très original'];
            let critere_3 = ['trop de consignes importantes non respectées', 'deux ou trois consignes non respectées', 'une consigne non respectée', 'toutes les consignes sont respectées'];
            let critere_4 = ['présentation et mode d\'emploi insuffisants / absents', 'présentation ou mode d\'emploi insuffisant / absent', 'présentation et/ou mode d\'emploi minimal', 'présentation et mode d\'emploi complets'];

			if (critere1_prev === undefined) critere1_prev = -2;
			if (critere2_prev === undefined) critere2_prev = -2;
			if (critere3_prev === undefined) critere3_prev = -1;
			if (critere4_prev === undefined) critere4_prev = -1;
			
			if (id.includes('critere1')) document.getElementById(id+'_description').innerHTML = critere_1[note/2];
			if (id.includes('critere2')) document.getElementById(id+'_description').innerHTML = critere_2[note/2];
			if (id.includes('critere3')) document.getElementById(id+'_description').innerHTML = critere_3[note];
			if (id.includes('critere4')) document.getElementById(id+'_description').innerHTML = critere_4[note];

            if (note == -1 || note == -2) {
                document.getElementById(id+"_note").innerHTML = '<i class="fas fa-times text-danger">';
				document.getElementById(id+'_description').innerHTML = '&nbsp;';
            } else {
                document.getElementById(id+"_note").innerHTML = note;
            }
			
			
			var jeu_id = id.split("_")[0];
			
			// total
			var total = 0;
			if (document.getElementById(jeu_id+"_critere1").value != -1 && document.getElementById(jeu_id+"_critere1").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere1").value);
			}
			if (document.getElementById(jeu_id+"_critere2").value != -1 && document.getElementById(jeu_id+"_critere2").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere2").value);
			}
			if (document.getElementById(jeu_id+"_critere3").value != -1 && document.getElementById(jeu_id+"_critere3").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere3").value);
			}
			if (document.getElementById(jeu_id+"_critere4").value != -1 && document.getElementById(jeu_id+"_critere4").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere4").value);
			}			
			document.getElementById(jeu_id+'_total').innerHTML = total;
			
			
			// gel des votes si injouable
			if (id.includes('critere1') && document.getElementById(id).value == "0"){

				document.getElementById(jeu_id+"_critere2").value = 0;
				document.getElementById(jeu_id+"_critere2_note").innerHTML = 0;
				document.getElementById(jeu_id+"_critere2").disabled = true;
				document.getElementById(jeu_id+'_critere2_description').innerHTML = '&nbsp;';
				document.getElementById(jeu_id+"_critere3").value = 0;
				document.getElementById(jeu_id+"_critere3_note").innerHTML = 0;
				document.getElementById(jeu_id+"_critere3").disabled = true;
				document.getElementById(jeu_id+'_critere3_description').innerHTML = '&nbsp;';
				document.getElementById(jeu_id+"_critere4").value = 0;
				document.getElementById(jeu_id+"_critere4_note").innerHTML = 0;
				document.getElementById(jeu_id+"_critere4").disabled = true;
				document.getElementById(jeu_id+'_critere4_description').innerHTML = '&nbsp;';				
				document.getElementById(jeu_id+'_total').innerHTML = 0;
				
			}


			// gel des votes si trop de consignes importantes non respectees
			if (id.includes('critere3') && document.getElementById(id).value == "0"){

				document.getElementById(jeu_id+"_critere2").value = 0;
				document.getElementById(jeu_id+"_critere2_note").innerHTML = 0;
				document.getElementById(jeu_id+"_critere2").disabled = true;
				document.getElementById(jeu_id+'_critere2_description').innerHTML = '&nbsp;';
				document.getElementById(jeu_id+"_critere1").value = 0;
				document.getElementById(jeu_id+"_critere1_note").innerHTML = 0;
				document.getElementById(jeu_id+"_critere1").disabled = true;
				document.getElementById(jeu_id+'_critere1_description').innerHTML = '&nbsp;';
				document.getElementById(jeu_id+"_critere4").value = 0;
				document.getElementById(jeu_id+"_critere4_note").innerHTML = 0;
				document.getElementById(jeu_id+"_critere4").disabled = true;
				document.getElementById(jeu_id+'_critere4_description').innerHTML = '&nbsp;';				
				document.getElementById(jeu_id+'_total').innerHTML = 0;
				
			}


			if ((id.includes('critere1') && document.getElementById(id).value != "0") || (id.includes('critere3') && document.getElementById(id).value != "0")){
			
				if (document.getElementById(jeu_id+"_critere1").disabled) {
					document.getElementById(jeu_id+"_critere1").value = critere1_prev;
					if (critere1_prev < 0) {
						document.getElementById(jeu_id+"_critere1_note").innerHTML = '<i class="fas fa-times text-danger">';
					} else {
						document.getElementById(jeu_id+"_critere1_description").innerHTML = critere_1[critere1_prev/2];
						document.getElementById(jeu_id+"_critere1_note").innerHTML = critere1_prev;
					}
					document.getElementById(jeu_id+"_critere1").disabled = false;
				}
				if (document.getElementById(jeu_id+"_critere2").disabled) {
					document.getElementById(jeu_id+"_critere2").value = critere2_prev;
					if (critere2_prev < 0) {
						document.getElementById(jeu_id+"_critere2_note").innerHTML = '<i class="fas fa-times text-danger">';
					} else {
						document.getElementById(jeu_id+"_critere2_description").innerHTML = critere_2[critere2_prev/2];
						document.getElementById(jeu_id+"_critere2_note").innerHTML = critere2_prev;
					}
					document.getElementById(jeu_id+"_critere2").disabled = false;
				}
				if (document.getElementById(jeu_id+"_critere3").disabled) {
					document.getElementById(jeu_id+"_critere3").value = critere3_prev;
					if (critere3_prev < 0) {
						document.getElementById(jeu_id+"_critere3_note").innerHTML = '<i class="fas fa-times text-danger">';
					} else {
						document.getElementById(jeu_id+"_critere3_description").innerHTML = critere_3[critere3_prev];
						document.getElementById(jeu_id+"_critere3_note").innerHTML = critere3_prev;
					}
					document.getElementById(jeu_id+"_critere3").disabled = false;
				}
				if (document.getElementById(jeu_id+"_critere4").disabled) {
					document.getElementById(jeu_id+"_critere4").value = critere4_prev;
					if (critere4_prev < 0) {
						document.getElementById(jeu_id+"_critere4_note").innerHTML = '<i class="fas fa-times text-danger">';
					} else {
						document.getElementById(jeu_id+"_critere4_description").innerHTML = critere_4[critere4_prev];
						document.getElementById(jeu_id+"_critere4_note").innerHTML = critere4_prev;
					}
					document.getElementById(jeu_id+"_critere4").disabled = false;
				}	
				
				critere1_prev = document.getElementById(jeu_id+"_critere1").value;
				critere2_prev = document.getElementById(jeu_id+"_critere2").value;
				critere3_prev = document.getElementById(jeu_id+"_critere3").value;
				critere4_prev = document.getElementById(jeu_id+"_critere4").value;		

			}
			
			if (id.includes('critere2') || id.includes('critere4')){
				critere1_prev = document.getElementById(jeu_id+"_critere1").value;
				critere2_prev = document.getElementById(jeu_id+"_critere2").value;
				critere3_prev = document.getElementById(jeu_id+"_critere3").value;
				critere4_prev = document.getElementById(jeu_id+"_critere4").value;	
			}
			
			
			// total
			var total = 0;
			if (document.getElementById(jeu_id+"_critere1").value != -1 && document.getElementById(jeu_id+"_critere1").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere1").value);
			}
			if (document.getElementById(jeu_id+"_critere2").value != -1 && document.getElementById(jeu_id+"_critere2").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere2").value);
			}
			if (document.getElementById(jeu_id+"_critere3").value != -1 && document.getElementById(jeu_id+"_critere3").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere3").value);
			}
			if (document.getElementById(jeu_id+"_critere4").value != -1 && document.getElementById(jeu_id+"_critere4").value != -2) {
				total = total + parseInt(document.getElementById(jeu_id+"_critere4").value);
			}			
			document.getElementById(jeu_id+'_total').innerHTML = total;			
            	
			var inputs, index, values;
			values = []
			inputs = document.getElementsByTagName('input');
			for (index = 0; index < inputs.length; ++index) {
				values.push(inputs[index].value);
			}
			if (values.includes("-1") || values.includes("-2")) {
				document.getElementById('protection_validation').innerHTML = "Il manque au moins un critère dans une évaluation";
				document.getElementById('submit_jeu').disabled = true;
			} else {
				document.getElementById('protection_validation').innerHTML = "&nbsp;";
				document.getElementById('submit_jeu').disabled = false;
			}
            
        }
    </script>

    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>

	@include('inc-bottom-js')
	
	@if (in_array($categorie, ['PI', 'POO', 'PB']))
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
	@endif

</body>
</html>
