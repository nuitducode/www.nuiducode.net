@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('inc-meta')
    <title>{{ config('app.name', 'Laravel') }} | console</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-4 mb-5">
        <div class="row">

            <div class="col-md-2">
                <a class="btn btn-light btn-sm mb-4" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

            <div class="col-md-10">

                <?php
                $display_enregistrement = "block";
                $display_evaluation = "block";
                if (request()->get('p') == 'enregistrement'){
                    $display_evaluation = "none";
                }
                if (request()->get('p') == 'evaluation'){
                    $display_enregistrement = "none";
                }

                if(request()->segment(2) == 'ndc') $type='Nuit du Code';
                if(request()->segment(2) == 'sltn') $type='Sélections';
                if(request()->segment(2) == 'bas') $type='Bas à sable';

                $jeton = Auth::user()->jeton;
                // salt eleve : 'hez'
                // salt enseignant : 'jwa'
                $token_eleve = $jeton[3].'h'.$jeton[2].'e'.$jeton[1].'z'.$jeton[0];
                $token_enseignant = $jeton[3].'j'.$jeton[2].'w'.$jeton[1].'a'.$jeton[0];
                ?>

                <h1 class="m-0 p-0 pb-1">{{$type}}</h1>
				
                @if (request()->segment(2) == 'ndc')
                <div class="text-danger text-monospace small">Pour vous familiariser avec l'interface vous pouvez faire des tests. Mais avant la Nuit du Code, pensez cependant à effacer tous vos tests en vidant la liste des <a href="/console/ndc/liste-jeux">jeux</a> et des <a href="/console/ndc/liste-evaluations">évaluations</a>.</div>
                @endif
                @if (request()->segment(2) == 'sltn')
                <div class="text-info text-monospace small">Cette section peut être utilisée pour organiser des sélections.</div>
                @endif
                @if (request()->segment(2) == 'bas')
                <div class="text-danger text-monospace small">Cette section peut être utilisée pour se familiariser avec les outils ou faire des tests.</div>
                @endif

                <!-- ============ -->
                <!-- LIENS DEPOTS -->
                <!-- ============ -->
                <div id="enregistrement" style="display:{{$display_enregistrement}}">
                    <h2>Dépôt des jeux</h2>
                    Lien à fournir aux équipes pour qu'elles déposent leurs jeux sur le site:
                    <div class="mt-1 text-center">
					
						<div style="display:inline-block;">
							<div style="background-color:white;border:solid 1px #e2e6ea;border-radius:3px;padding:8px 16px 8px 16px;">
								<span>
									<a id='lien_depot_jeu' href="/{{request()->segment(2)}}/{{strtoupper(Auth::user()->jeton)}}" class="text-monospace text-success" target="_blank">https://www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper(Auth::user()->jeton)}}</a>
								</span>

                                <div id="lien_depot_jeu_fullscreen" class="bg-white pt-4 text-center" style="display:none">
                                    <img src="{{ asset('img/ndc.png') }}" width="400" />
                                    <div class="text-monospace text-success font-weight-bold mt-4" style="font-size:2vw;">Dépôt Jeux</div>
                                    <div class="text-monospace text-dark font-weight-bold mt-5" style="font-size:5vw;">www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper(Auth::user()->jeton)}}</div>
                                </div>

                                <span class="pl-3" onclick="fullscreen('lien_depot_jeu_fullscreen')" style="cursor:pointer;"><i class="fas fa-expand"></i></span>
								<span class="pl-3" onclick="copier('lien_depot_jeu')" style="cursor:pointer;"><i class="fa-regular fa-copy"></i></span>
							</div>
							<div id="lien_depot_jeu_copie_confirmation" class="text-right small text-monospace text muted">&nbsp;</div>
						</div>
						
                    </div>
                </div>


                <!-- ================= -->
                <!-- LIENS EVALUATIONS -->
                <!-- ================= -->
                <div id="evaluation" style="display:{{$display_evaluation}}">
                    <h2>Évaluation par les élèves</h2>
                    Lien à fournir aux élèves pour l'évaluation des jeux:
                    <div class="mt-1 text-center">
					
						<div style="display:inline-block;">
							<div style="background-color:white;border:solid 1px #e2e6ea;border-radius:3px;padding:8px 16px 8px 16px;">
								<span>
									<a id="lien_evaluation_eleves" href="/{{request()->segment(2)}}/{{strtoupper($token_eleve)}}" class="text-monospace  text-success" target="_blank">https://www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper($token_eleve)}}</a>
								</span>

                                <div id="lien_evaluation_eleves_fullscreen" class="bg-white pt-4 text-center" style="display:none">
                                    <img src="{{ asset('img/ndc.png') }}" width="400" />
                                    <div class="text-monospace text-success font-weight-bold mt-4" style="font-size:2vw;">Évaluation élèves</div>
                                    <div class="text-monospace text-dark font-weight-bold mt-5" style="font-size:5vw;">www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper($token_eleve)}}</div>
                                </div>

								<span class="pl-3" onclick="fullscreen('lien_evaluation_eleves_fullscreen')" style="cursor:pointer;"><i class="fas fa-expand"></i></span>
								<span class="pl-3" onclick="copier('lien_evaluation_eleves')" style="cursor:pointer;"><i class="fa-regular fa-copy"></i></span>
							</div>
							<div id="lien_evaluation_eleves_copie_confirmation" class="text-right small text-monospace text muted">&nbsp;</div>
						</div>
				
                    </div>
                    <div  class="text-justify mt-2">
                        Par équipe, les élèves évaluent les jeux des équipes appartenant à une catégorie différente de la leur. Le croisement des catégories sera défini par les organisateurs et communiqué aux élèves. Il est préférable que cette évaluation soit faite sous la surveillance des organisateurs pour éviter toute erreur de manipulation (évaluations multiples, équipes qui évaluent leurs propres jeux...). Les évaluations peuvent être organisées juste après la fin de l'événement ou un autre jour.
                    </div>

                    <h2 class="mt-4">Évaluation par les enseignants</h2>
                    Lien à fournir aux enseignants pour l'évaluation des jeux:
                    <div class="mt-1 text-center">
					
						<div style="display:inline-block;">
							<div style="background-color:white;border:solid 1px #e2e6ea;border-radius:3px;padding:8px 16px 8px 16px;">
								<span>
									<a id="lien_evaluation_enseignants" href="/{{request()->segment(2)}}/{{strtoupper($token_enseignant)}}" class="text-monospace text-success" target="_blank">https://www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper($token_enseignant)}}</a>
								</span>

                                <div id="lien_evaluation_enseignants_fullscreen" class="bg-white pt-4 text-center" style="display:none">
                                    <img src="{{ asset('img/ndc.png') }}" width="400" />
                                    <div class="text-monospace text-success font-weight-bold mt-4" style="font-size:2vw;">Évaluation enseignants</div>
                                    <div class="text-monospace text-dark font-weight-bold mt-5" style="font-size:5vw;">www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper($token_enseignant)}}</div>
                                </div>

                                <span class="pl-3" onclick="fullscreen('lien_evaluation_enseignants_fullscreen')" style="cursor:pointer;"><i class="fas fa-expand"></i></span>
								<span class="pl-3" onclick="copier('lien_evaluation_enseignants')" style="cursor:pointer;"><i class="fa-regular fa-copy"></i></span>
							</div>
							<div id="lien_evaluation_enseignants_copie_confirmation" class="text-right small text-monospace text muted">&nbsp;</div>
						</div>
		
                    </div>
                </div>

            </div>

        </div><!-- /row -->
	</div><!-- /container -->
	
	<script>
	function copier(id) {
		var texte = document.getElementById(id).textContent;
		if (!navigator.clipboard) {
			// Alternative pour les navigateurs ne prenant pas en charge navigator.clipboard
			var zoneDeCopie = document.createElement("textarea");
			zoneDeCopie.value = texte;
			document.body.appendChild(zoneDeCopie);
			zoneDeCopie.select();
			document.execCommand("copy");
			document.body.removeChild(zoneDeCopie);
			return;
		}

		navigator.clipboard.writeText(texte).then(function() {
			//alert("Le texte a été copié dans le presse-papiers.");
		}, function() {
			// Gérer les erreurs éventuelles
			//alert("Impossible de copier le texte dans le presse-papiers. Veuillez le faire manuellement.");
		});
		
		var status = document.getElementById(id+'_copie_confirmation');
        status.innerText = "copié";
		
		status.style.opacity = '1';
		var fadeOutInterval = setInterval(function() {
			var opacity = parseFloat(status.style.opacity);
			if (opacity <= 0) {
				clearInterval(fadeOutInterval);
				status.innerHTML = "&nbsp;"; // Effacer le texte après l'animation
			} else {
				status.style.opacity = (opacity - 0.1).toString();
			}
		}, 150);
	}
	</script>

    <script>
        function fullscreen(id) {
            var el = document.getElementById(id);
            var isFullscreen = document.fullscreenElement || document.webkitFullscreenElement || document.msFullscreenElement || document.mozFullScreenElement;

            if (isFullscreen) {
                // Quitter le plein écran
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { /* Safari */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { /* IE11 */
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) { /* Firefox */
                    document.mozCancelFullScreen();
                }
            } else {
                // Afficher l'élément et entrer en plein écran
                el.style.display = 'block';
                if (el.requestFullscreen) {
                    el.requestFullscreen();
                } else if (el.webkitRequestFullscreen) { /* Safari */
                    el.webkitRequestFullscreen();
                } else if (el.msRequestFullscreen) { /* IE11 */
                    el.msRequestFullscreen();
                } else if (el.mozRequestFullScreen) { /* Firefox */
                    el.mozRequestFullScreen();
                }
            }
        }

        function updateFsButton() {
            if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement && !document.mozFullScreenElement) {
                // L'élément n'est plus en plein écran
                document.getElementById('lien_depot_jeu_fullscreen').style.display = 'none';
                document.getElementById('lien_evaluation_eleves_fullscreen').style.display = 'none';
                document.getElementById('lien_evaluation_enseignants_fullscreen').style.display = 'none';
            }
            console.log("État du plein écran changé");
        }

        document.addEventListener("fullscreenchange", updateFsButton, false);
        document.addEventListener("webkitfullscreenchange", updateFsButton, false);
        document.addEventListener("mozfullscreenchange", updateFsButton, false);
        document.addEventListener("MSFullscreenChange", updateFsButton, false);
    </script>

	@include('inc-bottom-js')

</body>
</html>
