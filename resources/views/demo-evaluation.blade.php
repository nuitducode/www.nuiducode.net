@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Nuit du Code | Démo évaluation</title>
</head>
<body>

	<div class="container mt-4 mb-5">
	
		<div class="row">
		
			<div class="col-md-6">

                <?php	
				// SCRATCH
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
					<li>Ne pas aller chercher des informations ou de l’aide sur internet ou sur l'ordinateur.</li>
					<li>Ne pas utiliser des notes personnelles ou de la documentation papier.</li>
				</ul>
				</div>
				";
				$critere4_scratch_titre = "Présentation / mode d'emploi";						
				?>
				
				SCRATCH
				<br />
				<br />
				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere1_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere1_scratch_description}}"></i></sup></div>
					<div class="row">
						<div class="col">
							<div id="scratch_critere1_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="scratch_critere1" name="evaluation[scratch]['critere1']" class="custom-range" value="-2" min="-2" max="8" step="2" oninput="curseur(this.id, this.value);">
							
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="scratch_critere1_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>

				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere2_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere2_scratch_description}}"></i></sup></div>
					<div class="row">
						<div class="col">
							<div id="scratch_critere2_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="scratch_critere2" name="evaluation[scratch]['critere2']" class="custom-range" value="-2" min="-2" max="6" step="2" oninput="curseur(this.id, this.value);">
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="scratch_critere2_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>

				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere3_scratch_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere3_scratch_description}}"></i></sup></div>
					<div class="row">
						<div class="col">
							<div id="scratch_critere3_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="scratch_critere3" name="evaluation[scratch]['critere3']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="scratch_critere3_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>

				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere4_scratch_titre}}</div>
					<div class="row">
						<div class="col">
							<div id="scratch_critere4_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="scratch_critere4" name="evaluation[scratch]['critere4']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="scratch_critere4_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>
				
				<div id="scratch_total" class="text-monospace text-right font-weight-bold text-primary" style="padding-right:12px;">0</div>

			</div>
			
			
			<div class="col-md-6">

				<?php
				// PYTHON
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
						<li>Ne pas aller chercher des informations ou de l’aide sur internet ou sur l'ordinateur.</li>
						<li>Ne pas utiliser des notes personnelles ou de la documentation papier (autre que celle fournie).</li>
						<li>Si le thème a été choisi, ne pas sortir du cadre du thème.</li>
					</ul>
				</div>
				";
				$critere4_python_titre = "Présentation / mode d'emploi";						
				?>

				PYTHON
				<br />
				<br />
				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere1_python_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere1_python_description}}"></i></sup></div>
					<div class="row">
						<div class="col">
							<div id="python_critere1_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="python_critere1" name="evaluation[python]['critere1']" class="custom-range" value="-2" min="-2" max="8" step="2" oninput="curseur(this.id, this.value);">
							
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="python_critere1_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>

				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere2_python_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere2_python_description}}"></i></sup></div>
					<div class="row">
						<div class="col">
							<div id="python_critere2_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="python_critere2" name="evaluation[python]['critere2']" class="custom-range" value="-2" min="-2" max="6" step="2" oninput="curseur(this.id, this.value);">
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="python_critere2_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>

				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere3_python_titre}} <sup><i class="fas fa-question-circle text-muted" data-container="body" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="auto" data-content="{{$critere3_python_description}}"></i></sup></div>
					<div class="row">
						<div class="col">
							<div id="python_critere3_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="python_critere3" name="evaluation[python]['critere3']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="python_critere3_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>

				<div style="background-color:#f3f5f7;margin-bottom:5px;padding:4px 10px 0px 10px;border-radius:4px">
					<div class="text-uppercase" style="color:#cf63cf">{{$critere4_python_titre}}</div>
					<div class="row">
						<div class="col">
							<div id="python_critere4_description" class="text-monospace text-muted small">&nbsp;</div>
							<input type="range" id="python_critere4" name="evaluation[python]['critere4']" class="custom-range" value="-1" min="-1" max="3" step="1" oninput="curseur(this.id, this.value);">
						</div>
						<div class="col-auto text-muted text-center text-monospace font-weight-bold" id="python_critere4_note" style="width:40px;">
							<i class="fas fa-times text-danger"></i>
						</div>
					</div>
				</div>
				
				<div id="python_total" class="text-monospace text-right font-weight-bold text-primary" style="padding-right:12px;">0</div>

			</div>

        </div><!-- /row -->
		
	</div><!-- /container -->
   

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
            
        }
    </script>

	@include('inc-bottom-js')

</body>
</html>
