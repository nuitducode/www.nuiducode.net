@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Nuit du Code | Évaluation - étape 2</title>
</head>
<body>

    @include('inc-nav')

    <?php
    $user = App\Models\User::where([['jeton', $token[6].$token[4].$token[2].$token[0]]])->first();
    if ($user == null) {
        echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">Adresse incorrecte</div>';
        echo '</body>';
        echo '</html>';        
        exit;       
    };
    if ($user->fin_evaluations == 1) {
        echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">Les évaluations sont terminées</div>';
        echo '</body>';
        echo '</html>';        
        exit;       
    };    
    ?>

	<div class="container mt-4 mb-5">
		<div class="row pt-3">
		
			<div class="col-md-12">

                @if (session('message'))
                    <div class="text-success text-monospace text-center mt-5 pb-4" role="alert">
                        {{ session('message') }}
                        <br />
                        <a class="btn btn-light btn-sm mt-3" href="/" role="button"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    @php
                    exit;
                    @endphp
                @endif

                <?php
                $etablissement_jeton = $token[6].$token[4].$token[2].$token[0];
                $jeux = App\Models\Game::where([['etablissement_jeton', $etablissement_jeton], ['type', request()->segment(1)], ['categorie', $categorie]])->get();
                if (count($jeux) !== 0) {

                    // SCRATCH
                    $critere1_scratch_titre = "Jouabilité";
                    $critere1_scratch_description = "Facilité de prise en main, absence de bogues, clarté des objectifs, environnement intuitif, plaisir...";
                    //$critere2_scratch_titre = "Richesse / Complexité";
                    //$critere2_scratch_description = "Nombre de lutins et décors, niveaux / scènes multiples, variété des actions, défilements, effets...";
                    $critere2_scratch_titre = "Originalité / Créativité";
                    $critere2_scratch_description = "Utilisation originale des lutins et des décors, orginalité du scénario, lutins à contre emploi...";
                    $critere3_scratch_titre = "Respect des consignes";
                    $critere3_scratch_description = "Absence d'éléments extérieurs, intégrité des lutins...";
                    $critere4_scratch_titre = "Présentation / mode d'emploi";
                    $critere4_scratch_description = "";

                    if (in_array($categorie, ['C3', 'C4', 'LY'])) {
                        ?>

                        <form method="POST" action="{{ route(request()->segment(1).'-evaluation-etape-2_post') }}">
                            @csrf

                            <?php
                            foreach ($jeux AS $jeu) {
                                ?>
                                <div class="row">

                                    <div class="col-md-7 text-center">
                                        <div>
                                            <img src="" class="img-fluid" style="border-radius:4px;" width="100%" />
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm mt-3" onClick="this.previousElementSibling.innerHTML='<iframe src=\'https://turbowarp.org/embed?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{strtolower($etablissement_jeton)}}/{{$jeu->scratch_id}}.sb3\' width=\'100%\' height=\'402\' allowtransparency=\'true\' frameborder=\'0\' scrolling=\'no\'></iframe>'">lancer / recharger le jeu</button>

                                        <div class="mt-4 mb-2 text-monospace small" style="color:silver">Si le jeu ne s'affiche pas correctement, vous pouvez l'ouvrir dans un autre onglet en cliquant <a href="https://turbowarp.org/embed?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{strtolower($etablissement_jeton)}}/{{$jeu->scratch_id}}.sb3" target="_blank">ici</a>.</div>

                                        <div class="mt-4 small text-monospace text-left" style="border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
                                        {{$jeu->documentation}}
                                        </div>
                                    </div>

                                    <div class="col-md-5">

                                        <div style="background-color:white;margin-bottom:2px;padding:4px 8px 0px 8px;border:solid silver 1px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere1_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-html="true" data-placement="auto" title="{{$critere1_scratch_description}}"></i></sup></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere1_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere1" name="evaluation[{{$jeu->scratch_id}}]['critere1']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
                                                    
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->scratch_id}}_critere1_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="background-color:white;margin-bottom:2px;padding:4px 8px 0px 8px;border:solid silver 1px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere2_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-html="true" data-placement="auto" title="{{$critere2_scratch_description}}"></i></sup></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere2_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere2" name="evaluation[{{$jeu->scratch_id}}]['critere2']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->scratch_id}}_critere2_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="background-color:white;margin-bottom:2px;padding:4px 8px 0px 8px;border:solid silver 1px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere3_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-html="true" data-placement="auto" title="{{$critere3_scratch_description}}"></i></sup></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere3_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere3" name="evaluation[{{$jeu->scratch_id}}]['critere3']" class="custom-range" value="-1" min="-1" max="2" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->scratch_id}}_critere3_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="background-color:white;margin-bottom:2px;padding:4px 8px 0px 8px;border:solid silver 1px;border-radius:4px">
                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere4_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-html="true" data-placement="auto" title="{{$critere4_scratch_description}}"></i></sup></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div id="{{$jeu->scratch_id}}_critere4_description" class="text-monospace text-muted small">&nbsp;</div>
                                                    <input type="range" id="{{$jeu->scratch_id}}_critere4" name="evaluation[{{$jeu->scratch_id}}]['critere4']" class="custom-range" value="-1" min="-1" max="2" step="1" oninput="curseur(this.id, this.value);">
                                                    
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->scratch_id}}_critere4_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <br />
                                <br />
                                <?php
                            }
                            ?>
                            <input id="etablissement_jeton" name="etablissement_jeton" type="hidden" value="{{$etablissement_jeton}}" />
                            <input id="categorie" name="categorie" type="hidden" value="{{$categorie}}" />
                            <input id="jury_nom" name="jury_nom" type="hidden" value="{{$jury_nom}}" />
                            <input id="jury_type" name="jury_type" type="hidden" value="{{$jury_type}}" />
                            <input id="langage" name="langage" type="hidden" value="scratch" />
                            <button type="submit" id="submit_jeu" class="btn btn-primary" disabled><i class="fas fa-check"></i> valider</button>
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

                        <form method="POST" action="{{ route(request()->segment(1).'-evaluation-etape-2_post') }}">
                            @csrf

                            <?php
                            $n = 0;
                            foreach ($jeux AS $jeu) {
                                $n++;
                                if(File::exists(storage_path("app/public/fichiers_pyxel/".$jeu->etablissement_jeton.'-'.$jeu->python_id))) {
                                    $files = File::files(storage_path("app/public/fichiers_pyxel/".$jeu->etablissement_jeton.'-'.$jeu->python_id));
                                    ?>
                                    @if($jury_type != 'eleve')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="mb-1" style="color:#4cbf56">{{$jeu->nom_equipe}}</h2>
                                        </div>
                                    </div>
                                    @endif

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
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere2_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->python_id}}_critere1" name="evaluation[{{$jeu->python_id}}]['critere1']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->python_id}}_critere1_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere2_python_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere2_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->python_id}}_critere2" name="evaluation[{{$jeu->python_id}}]['critere2']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->python_id}}_critere2_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere3_python_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere3_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->python_id}}_critere3" name="evaluation[{{$jeu->python_id}}]['critere3']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->python_id}}_critere3_note" style="width:40px;">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="text-uppercase" style="color:#cf63cf">{{$critere4_python_titre}}</div>
                                            <div class="text-monospace" style="color:silver;font-size:70%;">{{$critere4_python_description}}</div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <input type="range" id="{{$jeu->python_id}}_critere4" name="evaluation[{{$jeu->python_id}}]['critere4']" class="custom-range" value="-1" min="-1" max="5" step="1" oninput="curseur(this.id, this.value);">
                                                </div>
                                                <div class="col-auto text-secondary text-center font-weight-bold" id="{{$jeu->python_id}}_critere4_note" style="width:40px;">
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
                            <input id="etablissement_jeton" name="etablissement_jeton" type="hidden" value="{{$etablissement_jeton}}" />
                            <input id="categorie" name="categorie" type="hidden" value="{{$categorie}}" />
                            <input id="jury_nom" name="jury_nom" type="hidden" value="{{$jury_nom}}" />
                            <input id="jury_type" name="jury_type" type="hidden" value="{{$jury_type}}" />
                            <input id="langage" name="langage" type="hidden" value="python" />
                            <button type="submit" id="submit_jeu" class="btn btn-primary" disabled><i class="fas fa-check"></i> valider</button>
                        </form>
                        <?php
                    }
                } else {
                    ?>
                    <div class="text-success text-monospace text-center mt-5 pb-4" role="alert">
                        Pas de jeu à évaluer.
                        <br />
                        <a class="btn btn-light btn-sm mt-3" href="{{ URL::previous() }}" role="button"><i class="fas fa-arrow-left"></i></a>
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
        function curseur(id, note) {

            let critere_1 = ['injouable', 'bonne mais quelques bogues non bloquants', 'bonne et sans bogues', 'grande et sans bogues'];
            let critere_2 = ['très classique', 'classique', 'original', 'très original'];
            let critere_3 = ['plusieurs consignes ne sont pas respectées', 'une consigne n\'est pas respectée', 'toutes les consignes sont respectées'];
            let critere_4 = ['insuffisant', 'minimal', 'complet'];

            if (note == "-1") {
                document.getElementById(id+"_note").innerHTML = '<i class="fas fa-times text-danger">';
            } else {
                if (id.includes('critere1')) document.getElementById(id+'_description').innerHTML = critere_1[note];
                if (id.includes('critere2')) document.getElementById(id+'_description').innerHTML = critere_2[note];
                if (id.includes('critere3')) document.getElementById(id+'_description').innerHTML = critere_3[note];
                if (id.includes('critere4')) document.getElementById(id+'_description').innerHTML = critere_4[note];
                document.getElementById(id+"_note").innerHTML = note;
            }
            
            var inputs, index, values;
            values = []
            inputs = document.getElementsByTagName('input');
            for (index = 0; index < inputs.length; ++index) {
                values.push(inputs[index].value);
            }
            document.getElementById('submit_jeu').disabled = values.includes("-1");
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
