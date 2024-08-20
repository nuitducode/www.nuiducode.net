<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Nuit du Code | Jeu Pyxel</title>
</head>
<body>

	<?php
	try { 
		$jeu_data = unserialize(Crypt::decryptString($jeu_data));    
	} catch (Exception $e) {
		echo '<div class="p-4 text-monospace small text-danger">adresse incorrecte</div></body></html>';
		exit;
	}
	$jeu_dossier 			= $jeu_data['jeu_dossier'];
	$modele_jeu 			= $jeu_data['modele_jeu'];
	$modele_etablissement 	= $jeu_data['modele_etablissement'];
	$etablissement_jeton 	= $jeu_data['etablissement_jeton'];
	$python_id 				= $jeu_data['python_id'];
	?>

    <div class="container mt-4 mb-5">
        <div class="row">

            <div class="col-md-2">
                <a class="btn btn-light mb-4" href="javascript:window.open('','_self').close();" role="button" data-boundary="window" data-toggle="tooltip" data-placement="right" title="fermer cette page"><i class="fas fa-times"></i></a>
            </div>

            <div class="col-md-8">


                <?php
                if(File::exists(storage_path("app/public/".$jeu_dossier))) {
                    $files = File::files(storage_path("app/public/".$jeu_dossier));
                    $jeu = app('App\Models\\'.$modele_jeu)::where([['etablissement_jeton', $etablissement_jeton], ['python_id', $python_id]])->first();
					$etablissement = app('App\Models\\'.$modele_etablissement)::where('id', $jeu->etablissement_id)->first();
                    ?>
                
                    <div class="text-center">
					
						@if (isset($jeu_data['nom_equipe']) AND $jeu_data['nom_equipe'] == True)
						<h2 class="mb-1 p-0 text-left" style="color:#4cbf56">{{$jeu->nom_equipe}}</h2>
						@endif
						
						@if (isset($jeu_data['etablissement']) AND $jeu_data['etablissement'] == True)
						<div class="mb-1 text-monospace text-muted small text-left" style="color:silver;">
							{{$etablissement->etablissement}} - {{$etablissement->ville}} - {{$etablissement->pays}}
						</div>
						@endif
											
						<div id="player" class="rounded pt-1 mb-1" style="aspect-ratio:1/1;background-color:#202224;">
							<img src="{{ asset('img/pyxel_evaluation.png') }}" style="position:relative;top:40%" />    
						</div>
							
						<div id="warning" class="pl-4 pr-1 mb-1 text-monospace text-danger text-left" style="font-size:75%;display:none;">
							<ul class="m-0 p-0">
								<li>ne pas cliquer en dehors du cadre du jeu après avoir cliqué sur "click to start" afin de ne pas perdre les commandes (souris / clavier).</li>
								<li>ne pas cliquer sur le mode plein écran après avoir cliqué sur "click to start".</li>
							</ul>
						</div>

						<button type="button" class="mt-3 btn btn-success btn-sm" onClick="this.previousElementSibling.previousElementSibling.innerHTML='<iframe src=\'/jouer-pyxel-iframe/{{ Crypt::encryptString($jeu_dossier) }}\' width=\'100%\' height=\'100%\' frameborder=\'0\' scrolling=\'no\'></iframe>';document.getElementById('warning').style.display='block';">lancer / recharger le jeu</button>  

						<button type="button" class="mt-3 btn btn-light btn-sm ml-3 pl-3 pr-3" onclick="fullscreen('player')" data-toggle="tooltip" data-placement="right" data-title="mode plein écran"><i class="fas fa-expand"></i></button> 
					
					</div>
								
					<div class="mt-4 mb-2 text-left text-monospace small" style="color:silver">
						Si le jeu ne se lance pas correctement, vous pouvez utiliser ce <a data-toggle="collapse" href="#code_run" role="button" aria-expanded="false" aria-controls="code_run">code Python</a>.
					</div>

					<div class="collapse" id="code_run">

<pre class="m-0 text-left"><code id="htmlViewer" style="color:rgb(216, 222, 233); font-weight:400;background-color:rgb(46, 52, 64);background:rgb(46, 52, 64);display:block;padding: 1.5em;border-radius:5px;"><span style="color:rgb(129, 161, 193); font-weight:400;">import</span> requests, os
site = <span style="color:rgb(163, 190, 140); font-weight:400;">'https://www.nuitducode.net'</span>
url = site + <span style="color:rgb(163, 190, 140); font-weight:400;">'/storage/{{$jeu_dossier}}'</span>
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
							Pour installer un environnement Python + Pyxel, voir la <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/05-materiel-logiciels/" target="_blank">documentation</a>.
						</div>

                    </div><!-- /collapse -->

                    <div class="mt-3 mb-2 text-left text-monospace small" style="color:silver">
						Afficher les <a data-toggle="collapse" href="#fichiers" role="button" aria-expanded="false" aria-controls="fichiers">fichiers</a>.
					</div>

					<div class="collapse" id="fichiers">
						<ul class="list-group text-left small text-monospace">
						@foreach($files as $file)
							<?php
							if(pathinfo($file, PATHINFO_EXTENSION) == 'py') {
								$fichier_py = $file;
							}
							?>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2 pl-3 pr-3">
								{{basename($file)}}
								<a href="/storage/{{$jeu_dossier}}/{{basename($file)}}" class="text-secondary" download><i class="fa-solid fa-circle-arrow-down"></i></a>
							</li>
						@endforeach
						</ul>

						@if($fichier_py)
						<div class="text-monospace text-left pt-3 ml-1">{{basename($fichier_py)}}</div>
						<div style="width:100%;margin:0px auto 0px auto;">
							<div id="editor_code" style="border-radius:5px;">{{ Storage::disk('local')->get('/public/'.$jeu_dossier.'/'.basename($fichier_py)) }}</div>
						</div>
						@endif
						
					</div><!-- /collapse -->

					<div class="mt-4 small text-monospace text-left mb-2" style="overflow-wrap: break-word;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
						{!! nl2br(e($jeu->documentation)) !!}
					</div>

                    <?php
                } else {
                    echo "<div class='text-monospace small text-danger'>Ce jeu n'existe pas!</div>";
                }
                ?>

            </div>

        </div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

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

    <script src="{{ asset('js/ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>
	<script>

        editor_code = 'editor_code';
        var editor_code = ace.edit(editor_code, {
            theme: "ace/theme/puzzle_code",
            mode: "ace/mode/python",
            maxLines: 500,
            fontSize: 12,
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
        editor_fakecode.container.style.lineHeight = 1.5;

	</script>    

</body>
</html>
