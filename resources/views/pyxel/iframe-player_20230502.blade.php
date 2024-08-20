<?php
$project = App\Models\Pyxel::where('token_public', $token_public)->first();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />  
    <link href="{{ asset('public-pyxel/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('public-pyxel/css/custom.css') }}" rel="stylesheet">
    <style>
        html,body {
            height: 100%;
        }
        .btn-secondary {
            /* trick to activate the mouse */
            --bs-btn-focus-shadow-rgb: 248,250,252;
        }             
    </style>
    <script src="{{ asset('public-pyxel/wasm/pyxel.js') }}" type="text/javascript" charset="utf-8"></script>
    <!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/cc5dff2db9.js" crossorigin="anonymous"></script>
    <title>Pyxel Player</title>
</head>

<body>
    <div id="header">

        <div class="text-center pt-2 pb-2 font-monospace text-muted">
            <button id="mouse_activator" tabindex="1" type="button" class="btn btn-secondary btn-sm ms-5 ps-3 pe-3" onclick="fullscreen('pyxel-screen')" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="mode plein écran"><i class="fa-solid fa-expand"></i></button>
        </div>

        <div>
        @if ($file_to_exe == 'app.py')
            <pyxel-run
            root="/storage/pyxel/projects/{{ $token_public }}"
            name="app.py"
            packages="{{$project->packages}}"
            ></pyxel-run>
        @else
            <pyxel-play
            root="/storage/pyxel/projects/{{ $token_public }}"
            name="{{$file_to_exe}}"
            packages="{{$project->packages}}"
            ></pyxel-play>
        @endif
        </div>

    </div>

    <script>
        // trick to activate the mouse
        document.getElementById("mouse_activator").focus();

        var body_h = document.body.offsetHeight;
        var header_h = document.getElementById('header').offsetHeight;
        var content_h = body_h - header_h;
        document.getElementById('pyxel-screen').setAttribute("style","overflow-y:hidden;height:"+content_h+"px");
        window.addEventListener("resize", (event) => {
            var body_h = document.body.offsetHeight;
            var header_h = document.getElementById('header').offsetHeight;
            var content_h = body_h - header_h;
            document.getElementById('pyxel-screen').setAttribute("style","overflow-y:hidden;height:"+content_h+"px");
        });
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

 	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>   
	
    <script>
	    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
		const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
		const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
	</script>    

</body>
</html>
