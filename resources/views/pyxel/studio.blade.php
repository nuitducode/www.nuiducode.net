<?php
$project = App\Models\Pyxel::where('token_private', $token_private)->first();
$token_private = $project->token_private;
$token_public = $project->token_public;
if (!Storage::exists('public/pyxel/projects/'.$token_public)){
	Storage::makeDirectory('public/pyxel/projects/'.$token_public);
	Storage::copy('public/pyxel/init/init.py', 'public/pyxel/projects/'.$token_public.'/ndc.py');
	//Storage::copy('public/pyxel/init/init.pyxres', 'public/pyxel/projects/'.$token_public.'/res.pyxres');
	//Storage::copy('public/pyxel/init/univers_2022_1.pyxres', 'public/pyxel/projects/'.$token_public.'/univers_2022_1.pyxres');
	//Storage::copy('public/pyxel/init/univers_2022_2.pyxres', 'public/pyxel/projects/'.$token_public.'/univers_2022_2.pyxres');
	//Storage::copy('public/pyxel/init/univers_2022_3.pyxres', 'public/pyxel/projects/'.$token_public.'/univers_2022_3.pyxres');
}
$py_file = (isset($code_file)) ? Crypt::decryptString($code_file) : "ndc.py";
$code_init = Storage::get('public/pyxel/projects/'.$token_public.'/'.$py_file);

$tab_files = '';
$tab_content_files = '';

$tab_code_editor = 'active';
$tab_content_code_editor = 'active show';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STUDIO PYXEL</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('img/favicon.svg') }}">

    <!-- Font Awesome -->
	<link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Styles -->
	<link href="{{ asset('public-pyxel/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('public-pyxel/css/custom.css') }}" rel="stylesheet">

    <style>
        html,body {
          	height: 100%;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 10px 1fr;
            height:100%;
        }
        .gutter-col {
            grid-row: 1/-1;
            cursor: col-resize;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAeCAYAAADkftS9AAAAIklEQVQoU2M4c+bMfxAGAgYYmwGrIIiDjrELjpo5aiZeMwF+yNnOs5KSvgAAAABJRU5ErkJggg==');
            background-color: rgb(229, 231, 235);
            background-repeat: no-repeat;
            background-position: 50%;
        }
        .gutter-col-1 {
            grid-column: 2;
        }
    </style>

	<meta http-equiv="cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />   

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
</head>

<body>

    <div class="grid">

        <div style="overflow-y:scroll;direction:rtl;padding:0px 20px 20px 20px;">

            <div style="direction:ltr;top:0px;z-index:1000;width:100%;height:100%">

				<table class="h-100" style="width:100%">
					<tr>
						<td>

							<div class="mt-3 row">

								<div class="col-auto mb-3">
									<img src="{{ asset('public-pyxel/img/ndc-pyxel.png') }}" width="124" alt="PYXEL STUDIO" />
								</div>


								<div class="col text-end font-monospace">
									<kbd style="background-color:#FF4136"><b>lien à conserver:</b></kbd>
									www.nuitducode.net/pyxel/studio/{{ $token_private}}
								</div>
							</div>

							<?php
							/*
							<div class="row g-2 align-items-center font-monospace small mt-2">
								<div class="col-auto">
									<input id="form_project_name" type="text" class="form-control form-control-sm" name="project_name" value="{{$project->name}}" aria-label="nom du jeu" aria-describedby="form-project-name" placeholder="nom du jeu" size="30" disabled />
								</div>
								<div class="col">
									<button id="edit_project_name" class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-pen"></i></button>
									<span id="actions_project_name" style="display:none">
										<button id="cancel_project_name" class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-xmark"></i></button>
										<button id="submit_project_name" class="btn btn-light btn-sm text-primary" type="submit"><i class="fa-solid fa-check"></i></button>
									</span>
								</div>							
							</div>
							*/
							?>

							<div class="row mt-4">
								<div class="col">

									<!-- TABS -->
									<ul id="pills-tab" class="nav nav-pills mb-3" role="tablist">
										<?php
										/*
										<li class="nav-item me-1 mb-1" role="presentation">
											<button id="pills-consignes-tab" class="btn btn-danger btn-sm" style="width:40px" data-bs-toggle="pill" data-bs-target="#pills-consignes" type="button" role="tab" aria-controls="pills-consignes" aria-selected="false"><i class="fa-solid fa-triangle-exclamation"></i></button>
										</li>
										*/
										?>
										<li class="nav-item me-1 mb-1" role="presentation">
											<button id="pills-files-tab" class="btn btn-primary btn-sm {{$tab_files}}" style="width:40px" data-bs-toggle="pill" data-bs-target="#pills-files" type="button" role="tab" aria-controls="pills-files" aria-selected="true"><i class="fa-solid fa-list-ul"></i></button>
										</li>
										<li class="nav-item me-1 mb-1" role="presentation">
											<button id="pills-code_editor-tab" class="btn btn-primary btn-sm {{$tab_code_editor}}" style="width:40px" data-bs-toggle="pill" data-bs-target="#pills-code_editor" type="button" role="tab" aria-controls="pills-code_editor" aria-selected="false"><i class="fa-solid fa-code"></i></button>
										</li>
										<li class="nav-item me-1 mb-1" role="presentation" style="display:none">
											<button id="pills-resources_editor-tab" class="btn btn-primary btn-sm" style="width:40px" data-bs-toggle="pill" data-bs-target="#pills-resources_editor" type="button" role="tab" aria-controls="pills-resources_editor" aria-selected="false" onClick="open_resources_tab()"><i class="fa-solid fa-paintbrush"></i></button>
										</li>
										<li class="nav-item me-1 mb-1" role="presentation">
											<button id="pills-docs-tab" class="btn btn-primary btn-sm" style="width:40px" data-bs-toggle="pill" data-bs-target="#pills-docs" type="button" role="tab" aria-controls="pills-docs" aria-selected="false"><i class="fa-solid fa-circle-question"></i></button>
										</li>										
										<li class="nav-item me-1 mb-1" role="presentation">
											<button id="pills-packages-tab" class="btn btn-primary btn-sm" style="width:40px" data-bs-toggle="pill" data-bs-target="#pills-packages" type="button" role="tab" aria-controls="pills-packages" aria-selected="false"><i class="fa-solid fa-box"></i></button>
										</li>		
										<li class="nav-item me-1 mb-1" role="presentation">
											<button id="pills-documentation-tab" class="btn btn-primary btn-sm" style="width:40px" data-bs-toggle="pill" data-bs-target="#pills-documentation" type="button" role="tab" aria-controls="pills-documentation" aria-selected="false"><i class="fa-solid fa-book"></i></button>
										</li>																									
									</ul>
									<!-- /TABS -->

								</div>
								<div class="col text-end">
									<button type="button" class="btn btn-warning btn-sm ps-3 pe-3" onClick="run(this)" data-pyfile="{{$py_file}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lancer le jeu"><i class="fas fa-play"></i></button>
								</div>
							</div>

						</td>
					</tr>
					<tr style="height:100%">
						<td style="height:100%">

							<div class="tab-content h-100" id="pills-tabContent">

								<!-- TAB - CONSIGNES -->
								<div class="tab-pane fade h-100" id="pills-consignes" role="tabpanel" aria-labelledby="pills-consignes-tab" tabindex="0">							
									@include('pyxel/inc-consignes')
								</div>
								<!-- /TAB - CONSIGNES -->			

								<!-- TAB - FICHIERS -->
								<div class="tab-pane fade {{$tab_content_files}}" id="pills-files" role="tabpanel" aria-labelledby="pills-files-tab" tabindex="0">

									<div class="pt-5">
										<span class="ms-2"><a href="/studio/{{$token_private}}/file-upload" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="importer un fichier .pyxres"><i class="fa-solid fa-arrow-up-from-bracket"></i></a></span>
									</div>

									<ul class="list-group mt-2 font-monospace small mb-5">

										<li class="list-group-item d-flex justify-content-between align-items-center p-1 pe-3">
											<span class="small">
												<a href="/pyxel/studio/{{$token_private}}/{{Crypt::encryptString('ndc.py')}}" class="btn btn-light btn-sm" role="button" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="ouvrir" style="width:35px"><i class="fa-solid fa-bars-staggered"></i></a>
												ndc.py
											</span>
											<span>
												<a href="{{Storage::url('pyxel/projects/'.$token_public.'/ndc.py')}}" class="download_file" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="télécharger" download><i class="fa-solid fa-circle-down"></i></a>
											</span>
										</li>

										<?php
										/*
										<li class="list-group-item d-flex justify-content-between align-items-center p-1 pe-3">
											<span class="small">
												<button type="button" class="btn btn-light btn-sm" type="button" onClick="open_pyxres(this)" data-pyxresfile="res.pyxres" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="ouvrir" style="width:35px"><i class="fa-solid fa-paintbrush"></i></button>
												res.pyxres
											</span>
											<?php
											<span>
												<a href="{{Storage::url('pyxel/projects/'.$token_public.'/res.pyxres')}}" class="download_file" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="télécharger" download><i class="fa-solid fa-circle-down"></i></a>
											</span>
											?>
										</li>
										*/
										?>

										<?php
										$dossier = storage_path('app').'/public/pyxel/projects/'.$token_public.'/';
										$fichiers = array_diff(scandir($dossier), array('ndc.py', 'res.pyxres', 'univers_2022_1.pyxres', 'univers_2022_2.pyxres', 'univers_2022_3.pyxres'));
										foreach ($fichiers as $fichier) {

											// trash
											$trash = (in_array($fichier, ['ndc.py', 'res.pyxres'])) ? '' : '<a tabindex="0" style="cursor:pointer" class="delete_file" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="left" data-bs-html="true" data-bs-content="<a href=\'/studio/'.$token_private.'/remove-file/'.Crypt::encryptString($fichier).'\' class=\'btn btn-danger btn-sm text-light\' role=\'button\'>confirm</a><a class=\'btn btn-light btn-sm ms-2\' href=\'#\' role=\'button\'>cancel</a>"><i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="delete" style="font-size:90%"></i></a>';
											
											// py file
											$edit = '<a href="/studio/'.$token_private.'/'.Crypt::encryptString($fichier).'" class="btn btn-light btn-sm" role="button" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="ouvrir" style="width:35px"><i class="fa-solid fa-bars-staggered"></i></a>';

											// pyxres file
											if (pathinfo($fichier, PATHINFO_EXTENSION) == "pyxres") {
												$edit = '<button type="button" class="btn btn-light btn-sm" type="button" onClick="open_pyxres(this)" data-pyxresfile="'.$fichier.'" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="ouvrir" style="width:35px"><i class="fa-solid fa-paintbrush"></i></button>';
											}

											// pyxapp file
											if (pathinfo($fichier, PATHINFO_EXTENSION) == "pyxapp") {
												$edit = '<button type="button" class="btn btn-light btn-sm" onClick="run_pyxapp(this)" data-pyxappfile="'.$fichier.'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lancer le jeu" style="width:35px"><i class="fas fa-play"></i></button>';
											}	
											
											if (is_file($dossier.$fichier)) {
												echo '
												<li class="list-group-item d-flex justify-content-between align-items-center p-1 pe-3">
													<span class="small">
													' . $edit . ' ' . $fichier . '
													</span>
													<span><a href="'.Storage::url('pyxel/projects/'.$token_public.'/'.$fichier).'" class="download_file me-2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="télécharger" download>
													<i class="fa-solid fa-circle-down"></i></a>'.$trash.'</span>
												</li>';
											}
										}
										?>
									</ul>
								</div>
								<!-- /TAB - FICHIERS -->
								
								<!-- TAB - CODE EDITOR -->
								<div class="tab-pane fade {{$tab_content_code_editor}}" id="pills-code_editor" role="tabpanel" aria-labelledby="pills-code_editor-tab" tabindex="0">
									<div class="row mb-1">
										<div id="code_editor_filename" class="col font-monospace pt-1">
											{{$py_file}}<span id="saved" class="text-success" style="font-size:160%;vertical-align:5px;"></span>
										</div>
										<div class="col-auto text-end pt-2">
											<button type="button" class="btn btn-primary btn-sm ps-3 pe-3" onClick="save(this)" data-pyfile="{{$py_file}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="enregistrer"><i class="fa-solid fa-floppy-disk"></i></button>
										</div>
									</div>
									<div style="direction:ltr;position:relative;margin-bottom:20px;">
										<div>
											<div style="width:100%;margin:0px auto 0px auto;"><div id="code_editor_code" style="border-radius:5px;">{!! $code_init !!}</div></div>
										</div>
									</div>
								</div>
								<!-- /TAB - CODE EDITOR -->

								<!-- TAB - RESOURCES EDITOR -->
								<div id="pills-resources_editor" class="tab-pane fade h-100" role="tabpanel" aria-labelledby="pills-resources_editor-tab" tabindex="0">
									<div id="res_editor" style="height:100%"></div>
								</div>
								<!-- /TAB - RESOURCES EDITOR -->

								<!-- TAB - DESCRIPTION & DOCUMENTATION -->
								<div class="tab-pane fade" id="pills-docs" role="tabpanel" aria-labelledby="pills-docs-tab" tabindex="0">
									<div>
										<!--
										<b>Description</b>
										<textarea id="form_project_description" class="form-control" rows="4">{{$project->description}}</textarea>
										<br />
										-->
										<b>Documentation</b>
										<textarea id="form_project_documentation" class="form-control" rows="10">{{$project->documentation}}</textarea>
									</div>
									<div class="mt-2 text-end">
										<span id="project_doc_saved" class="me-2 text-danger small"></span>
										<button id="submit_project_doc" type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-check"></i></button>
									</div>
								</div>
								<!-- /TAB - DESCRIPTION & DOCUMENTATION -->									

								<!-- TAB - PACKAGES -->
								<div id="pills-packages" class="tab-pane fade h-100" role="tabpanel" aria-labelledby="pills-packages-tab" tabindex="0">
									<div class="mt-2">
										<b>BIBLIOTHÈQUES</b>
										<p>
										Si vous utilisez des bibliothèques tierces pour votre projet (c'est-à-dire de bibliothèques qui ne sont pas des bibliothèques standard de Python), indiquez-les ci-dessous (noms séparés par des virgules).<br />
										Voir la <a href="https://pyodide.org/en/stable/usage/packages-in-pyodide.html" target="_blank">liste des bibliothèques tierces disponibles</a>.</p>
									</div>
									<div class="row g-2 align-items-center font-monospace small mt-1">
										<div class="col-auto">
											<input id="form_project_packages" type="text" class="form-control form-control-sm" name="project_packages" value="{{$project->packages}}" aria-label="project name" aria-describedby="form-project-name" placeholder="" size="60" disabled />
										</div> 
										<div class="col">
											<button id="edit_project_packages" class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-pen"></i></button>
											<span id="actions_project_packages" style="display:none">
												<button id="cancel_project_packages" class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-xmark"></i></button>
												<button id="submit_project_packages" class="btn btn-light btn-sm text-primary" type="submit"><i class="fa-solid fa-check"></i></button>
											</span>
										</div>							
									</div>
									<div class="mt-2">
										<p>Exemple: <span class="font-monospace">numpy,pandas</span></p>
										<p>Remarque: ne déclarer que des bibliothèques tierces, pas des bibliothèques standard de Python. Par exemple, <span class="font-monospace">random</span> est une bibliothèque standard, pas une bibliothèque tierce.</p>
									</div>									
								</div>
								<!-- /TAB - PACKAGES -->

								<!-- TAB - DOCUMENTATION -->
								<div id="pills-documentation" class="tab-pane fade h-100" role="tabpanel" aria-labelledby="pills-documentation-tab" tabindex="0">
									<div class="mt-2 mb-5">
										<?php
										/*
										<div class="fw-bold">TUTORIELS PYXEL POUR LA NUIT DU CODE</div>
										<ul>
											<li><a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/TUTORIELS/1-premiers-pas-avec-pyxel-premiere/" target="_blank">Premiers pas avec Pyxel - Première</a></li>
											<li><a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/TUTORIELS/2-premiers-pas-avec-pyxel-terminale/" target="_blank">Premiers pas avec Pyxel - Terminale</a></li>
											<li><a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/TUTORIELS/3-tutoriel-detaille-terminale/" target="_blank">Tutoriel détaillé - Terminale</a></li>
										</ul>
										*/
										?>
										<div class="fw-bold">DOCUMENTATION PYXEL</div>
										<?php
										/*
										<ul class="mt-2">
											<li>Version: <span class="font-monospace text-success fw-bold">1.9.12</span></li>
											<li>Documentation officielle: <a href="https://github.com/kitao/pyxel/blob/main/docs/README.fr.md" class="btn btn-light btn-sm mb-1" role="button" target="_blank"><i class="fa-solid fa-book"></i></a></li>											
										</ul>
										*/
										?>
										<div class="text-center font-monospace">
											<div><img src="{{ asset('public-pyxel/img/pyxel-palette.png') }}" class="img-fluid" /></div>
											<div style="font-size:70%;color:silver;">source: <a href="https://github.com/kitao/pyxel">github.com/kitao/pyxel</a></div>
											<div><img src="{{ asset('public-pyxel/img/pyxel-screen-tilemap.png') }}" class="mt-3 img-fluid" /></div>
											<div style="font-size:70%;color:silver;">source: <a href="https://github.com/kitao/pyxel">github.com/kitao/pyxel</a></div>
											<div><img src="{{ asset('public-pyxel/img/pyxel-cheatsheet.png') }}" class="mt-3 img-fluid" /></div>
											<div style="font-size:70%;color:silver;">source: <a href="https://github.com/godangdo-watermelon/pyxel-cheat-sheet">github.com/godangdo-watermelon/pyxel-cheat-sheet</a></div>
										</div>
									</div>
								</div>
								<!-- /TAB - DOCUMENTATION -->

							</div>

						</td>
					</tr>
				</table>

            </div>

        </div>

        <div class="gutter-col gutter-col-1"></div>

        <div style="overflow-y: scroll;padding:0px;">
            <div id="pyxel_wasm" class="text-center" style="height:100%;position:relative;">
				<div class="font-monospace mt-5">cliquer sur <button type="button" data-codefile="" onClick="run(this)" data-pyfile="{{$py_file}}" class="btn btn-warning btn-sm mt-3 ps-3 pe-3 mb-3"><i class="fas fa-play"></i></button> pour lancer le jeu</div>
			</div>
        </div>
    </div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

	<script src="{{ asset('js/ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
		code_editor_code = ace.edit(code_editor_code, {
			theme: "ace/theme/puzzle_code",
			mode: "ace/mode/python",
			maxLines: Infinity,
			minLines: 10,
			fontSize: 14,
			wrap: true,
			useWorker: false,
			readOnly: false,
			autoScrollEditorIntoView: true,
			highlightActiveLine: false,
			highlightSelectedWord: false,
			highlightGutterLine: true,
			showPrintMargin: false,
			displayIndentGuides: true,
			showLineNumbers: true,
			showGutter: true,
			showFoldWidgets: false,
			useSoftTabs: true,
			navigateWithinSoftTabs: false,
			tabSize: 4
		});
		code_editor_code.container.style.lineHeight = 1.5;
    </script>

	<script>
        function public_exe(el) {
            var div = document.getElementById(el.name+"_exe");
            if(el.value == 1 && el.checked) {
                div.style.display = "block";
            } else {
                div.style.display = "none";
            }
        }
    </script> 	

	<script>
		function save_code(el) {
			var json = JSON.stringify({token_private: "{{ $token_private }}", code: code_editor_code.getSession().getValue(), file: el.dataset.pyfile});
			fetch("/save-code", {
				method: "POST",
				mode: "cors",
				body: json,
				headers: {"Content-Type": "application/json; charset=UTF-8", "X-CSRF-Token": "{{ csrf_token() }}"}
			})
				.then(response => {
					console.log('response');
					return response.text().then(data =>{console.log(data)});
				})
				.catch(error => {
					console.log('error');
					console.log(error);
				});
		}
	</script>

	<script>
		function fadeOutEffect(target) {
			var fadeTarget = document.getElementById(target);
			var fadeEffect = setInterval(function () {
				if (!fadeTarget.style.opacity) {
					fadeTarget.style.opacity = 1;
				}
				if (fadeTarget.style.opacity > 0) {
					fadeTarget.style.opacity -= 0.1;
				} else {
					clearInterval(fadeEffect);
					fadeTarget.innerHTML = '';
					fadeTarget.style.opacity = 1;
				}
			}, 200);
		}
	</script>

	<script>
		function save(el) {
			el.blur();
			save_code(el);
			document.getElementById('saved').innerHTML = '&#8226;';
			fadeOutEffect('saved');
		}
	</script>

	<script>
		function run(el) {
			el.blur();
			save_code(el);
			document.getElementById('saved').innerHTML = '&#8226;';
			fadeOutEffect('saved');
			document.getElementById('pyxel_wasm').innerHTML="<iframe src='/pyxel/iframe-player/{{$token_public}}/ndc.py' width='100%' frameborder='0' scrolling='no' style='height:99%'></iframe>";
		}
    </script>

	<script>
		function run_pyxapp(el) {
			document.getElementById('pyxel_wasm').innerHTML="<iframe src='/pyxel/iframe-player/{{$token_public}}/"+el.dataset.pyxappfile+"' width='100%' frameborder='0' scrolling='no' style='height:99%'></iframe>";
		}
    </script>

	<script>
		function open_resources_tab() {
			if (!document.getElementById('res_editor').innerHTML) {
				document.getElementById('res_editor').innerHTML = "<iframe src='/pyxel/iframe-resources-editor/{{$token_private}}/"+btoa("res.pyxres")+"' frameborder='0' scrolling='no' style='width:100%;height:100%'></iframe>";
			}
		}
	</script>	

	<script>
		function open_pyxres(el) {
  			var tab = new bootstrap.Tab(document.querySelector('#pills-resources_editor-tab'))
  			tab.show()
			document.getElementById('res_editor').innerHTML="<iframe src='/pyxel/iframe-resources-editor/{{$token_private}}/"+btoa(el.dataset.pyxresfile)+"' width='100%' frameborder='0' scrolling='no' style='height:99%'></iframe>";
		}
	</script>

	<script>

		// PROJECT NAME
		document.getElementById("edit_project_name").addEventListener("click", function(){
			document.getElementById('edit_project_name').style.display = "none";
			document.getElementById('actions_project_name').style.display = "inline";
			document.getElementById("form_project_name").disabled = false;

		});

		document.getElementById("cancel_project_name").addEventListener("click", function(){
			document.getElementById('edit_project_name').style.display = "inline";
			document.getElementById('actions_project_name').style.display = "none";
			document.getElementById("form_project_name").disabled = true;
		});

		document.getElementById("submit_project_name").addEventListener("click", function(){
			document.getElementById('edit_project_name').style.display = "inline";
			document.getElementById('actions_project_name').style.display = "none";
			document.getElementById("form_project_name").disabled = true;
			var form_data = new FormData();
			form_data.append("to_update", "project_name");
			form_data.append("project_name", document.getElementById("form_project_name").value);
  			form_data.append("token_private", "{{ $token_private }}");
			fetch("/update-project-infos", {
				method: "POST",
				mode: "cors",
				body: form_data,
				headers: {"X-CSRF-Token": "{{ csrf_token() }}"}
			})
				.then(response => {
					console.log('response');
					return response.text().then(data =>{console.log(data)});
				})
				.catch(error => {
					console.log('error');
					console.log(error);
				});
		});

		// DESCRIPTION & DOCUMENTATION
		document.getElementById("submit_project_doc").addEventListener("click", function(){
			document.getElementById('project_doc_saved').innerHTML = 'enregistré';
            fadeOutEffect('project_doc_saved');
			var form_data = new FormData();
			form_data.append("to_update", "project_doc");
			//form_data.append("project_description", document.getElementById("form_project_description").value);
			form_data.append("project_documentation", document.getElementById("form_project_documentation").value);
  			form_data.append("token_private", "{{ $token_private }}");
			fetch("/update-project-infos", {
				method: "POST",
				mode: "cors",
				body: form_data,
				headers: {"X-CSRF-Token": "{{ csrf_token() }}"}
			})
				.then(response => {
					console.log('response');
					return response.text().then(data =>{console.log(data)});
				})
				.catch(error => {
					console.log('error');
					console.log(error);
				});
		});


		// PROJECT PACKAGES
		document.getElementById("edit_project_packages").addEventListener("click", function(){
			document.getElementById('edit_project_packages').style.display = "none";
			document.getElementById('actions_project_packages').style.display = "inline";
			document.getElementById("form_project_packages").disabled = false;

		});

		document.getElementById("cancel_project_packages").addEventListener("click", function(){
			document.getElementById('edit_project_packages').style.display = "inline";
			document.getElementById('actions_project_packages').style.display = "none";
			document.getElementById("form_project_packages").disabled = true;
		});

		document.getElementById("submit_project_packages").addEventListener("click", function(){
			document.getElementById('edit_project_packages').style.display = "inline";
			document.getElementById('actions_project_packages').style.display = "none";
			document.getElementById("form_project_packages").disabled = true;
			var form_data = new FormData();
			form_data.append("to_update", "project_packages");
			form_data.append("project_packages", document.getElementById("form_project_packages").value);
  			form_data.append("token_private", "{{ $token_private }}");
			fetch("/update-project-infos", {
				method: "POST",
				mode: "cors",
				body: form_data,
				headers: {"X-CSRF-Token": "{{ csrf_token() }}"}
			})
				.then(response => {
					console.log('response');
					return response.text().then(data =>{console.log(data)});
				})
				.catch(error => {
					console.log('error');
					console.log(error);
				});
		});

    </script>

    <script src="https://unpkg.com/split-grid/dist/split-grid.js"></script>
    <script>
	    Split({
	        minSize: 400,
	        columnGutters: [{
	            track: 1,
	            element: document.querySelector('.gutter-col-1'),
	        }],
	    })
    </script>

	<script>
	    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
		const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
		const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
	</script>

</body>
</html>
