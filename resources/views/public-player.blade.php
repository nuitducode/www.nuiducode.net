<?php
$project = App\Models\Project::where('token_public', $token_public)->first();
$code = Storage::get('/public/projects/'.$token_public.'/app.py');
?>

@include('inc-top')
<html lang="{{ app()->getLocale() }}">
<head>
	@include('inc-meta')
	<script src="{{ asset('wasm/pyxel.js') }}" type="text/javascript" charset="utf-8"></script>
    <title>PYXEL STUDIO | PLAYER</title>
	<style>
	.default-pyxel-screen {
	  width: 100%;
	  height: 50%;
	}
	</style>
</head>
<body>

	<div class="container">
		<div class="col-md-12">
			<h1 class="m-2"><a class="navbar-brand" href="/"><img src="{{ asset('img/pyxelstudio.png') }}" width="100" alt="Pyxel Studio" /></a></h1>
		</div>
	</div>

	<div>
		<pyxel-run
		root="/storage/projects/{{ $token_public }}"
		name="app.py"
		></pyxel-run>
	</div>

	<div class="container mt-2 mb-5">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="text-center mb-2">
					<button type="button" class="btn btn-secondary btn-lg ps-5 pe-5" onclick="fullscreen('pyxel-screen')" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="fullscreen mode"><i class="fa-solid fa-expand"></i></button>
				</div>
				<div class="font-monospace mb-3">
					@if ($project->description)
					<div>
						<b>Description</b>
						<div style="border:1px solid #ecf0f1;border-radius:4px;padding:15px;">{{nl2br($project->description)}}</div>
					</div>
					@endif
					@if ($project->documentation)
					<div>
						<b>Documentation</b>
						<div style="border:1px solid #ecf0f1;border-radius:4px;padding:15px;">{{nl2br($project->documentation)}}</div>
					</div>
					@endif
				</div>

				<ul class="list-group mt-3 mb-3 font-monospace small">
					<li class="list-group-item d-flex justify-content-between align-items-center pe-3">
						<span class="small">app.py</span>
						<span>
							<a href="{{Storage::url('projects/'.$token_public.'/app.py')}}" class="download_file" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="download" download><i class="fa-solid fa-circle-down"></i></a>
						</span>
					</li>
					@if (filesize(storage_path('app').'/public/projects/'.$token_public.'/res.pyxres') != 255)
					<li class="list-group-item d-flex justify-content-between align-items-center pe-3">
						<span class="small">res.pyxres</span>
						<span>
							<a href="{{Storage::url('projects/'.$token_public.'/res.pyxres')}}" class="download_file" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="download" download><i class="fa-solid fa-circle-down"></i></a>
							
						</span>
					</li>	
					@endif			
					<?php
					$dossier = storage_path('app').'/public/projects/'.$token_public.'/';
					$fichiers = array_diff(scandir($dossier), array('app.py', 'res.pyxres'));
					foreach ($fichiers as $fichier) {
						if (is_file($dossier.$fichier)) echo '
							<li class="list-group-item d-flex justify-content-between align-items-center pe-3">
							<span class="small">
							' . $fichier . '
							</span>
							<span><a href="'.Storage::url('projects/'.$token_public.'/'.$fichier).'" class="download_file" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="download" download><i class="fa-solid fa-circle-down"></i></a></span>
							</li>';
					}
					?>
				</ul>
				{{filesize(storage_path('app').'/public/projects/'.$token_public.'/res.pyxres');}}

				<!-- CODE EDITOR -->
				<div class="col font-monospace pt-2">app.py *</div>
				<div style="direction:ltr;height:100%;position:relative">
					<div>
						<div style="width:100%;margin:0px auto 0px auto;"><div id="editor_code" style="border-radius:5px;">{!! $code !!}</div></div>
					</div>
				</div>

			</div>
		</div>

	</div>


	<script src="{{ asset('js/ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
		editor_code = ace.edit(editor_code, {
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
    </script>

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

	@include('inc-bottom-js')

</body>
</html>
