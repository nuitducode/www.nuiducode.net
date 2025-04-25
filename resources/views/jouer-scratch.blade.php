<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Nuit du Code | Jeu Scratch</title>
</head>
<body>

	<?php
	try { 
		$jeu_data = unserialize(Crypt::decryptString($jeu_data));    
	} catch (Exception $e) {
		echo '<div class="p-4 text-monospace small text-danger">adresse incorrecte</div></body></html>';
		exit;
	}
	//print_r($jeu_data);
	$jeu_dossier 			= $jeu_data['jeu_dossier'];
	$modele_jeu 			= $jeu_data['modele_jeu'];
	$modele_etablissement 	= $jeu_data['modele_etablissement'];
	$etablissement_jeton 	= $jeu_data['etablissement_jeton'];
	$scratch_id 			= $jeu_data['scratch_id'];
	?>

    <div class="container mt-4 mb-5">
        <div class="row">

            <div class="col-md-2">
                <a class="btn btn-light mb-4" href="javascript:window.open('','_self').close();" role="button" data-boundary="window" data-toggle="tooltip" data-placement="right" title="fermer cette page"><i class="fas fa-times"></i></a>
            </div>

            <div class="col-md-8">

                <?php
                if(File::exists(storage_path("app/public/".$jeu_dossier))) {
                    $jeu = app('App\Models\\'.$modele_jeu)::where([['etablissement_jeton', $etablissement_jeton], ['scratch_id', $scratch_id]])->first();
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
						
						<div id="player_{{$jeu->id}}" class="rounded pt-1 mb-1" style="height:420px;background-color:#f3f5f7;">
							<img src="{{ asset('img/scratch_evaluation.png') }}" style="position:relative;top:40%" />    
						</div>	

						<button type="button" class="btn btn-success btn-sm mt-3" onClick="this.previousElementSibling.innerHTML='<iframe id=\'iframe_{{$jeu->id}}\'  src=\'https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/{{$jeu_dossier}}\' width=\'100%\' height=\'402\' allowtransparency=\'true\' frameborder=\'0\' scrolling=\'no\'></iframe>'">lancer / recharger le jeu</button>

						<button type="button" class="mt-3 btn btn-light btn-sm ml-3 pl-3 pr-3" onclick="fullscreen('iframe_{{$jeu->id}}')" data-toggle="tooltip" data-placement="right" data-title="mode plein écran"><i class="fas fa-expand"></i></button> 

						<div class="mt-4 mb-2 text-monospace text-left small" style="color:silver">Si vous voulez voir le code ou si le jeu ne s'affiche pas correctement, vous pouvez l'ouvrir dans un autre onglet en cliquant sur <a href="https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/{{$jeu_dossier}}" target="_blank">ici</a>.</div>

						<div class="mt-2 mb-2 text-monospace text-left small" style="color:silver">Télécharger le fichier <a href="https://www.nuitducode.net/storage/{{$jeu_dossier}}" download>sb3</a></div>

						<div class="mt-4 small text-monospace text-left mb-2" style="overflow-wrap: break-word;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
							{!! nl2br(e($jeu->documentation)) !!}
						</div>
						
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

</body>
</html>
