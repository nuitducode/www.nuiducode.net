<?php
$project = App\Models\Pyxel::where('token_private', $token_private)->first();
?>
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />    

    <link href="{{ asset('public-pyxel/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public-pyxel/css/custom.css') }}" rel="stylesheet">
    <script src="{{ asset('public-pyxel/wasm/pyxel.js') }}" type="text/javascript" charset="utf-8"></script>

    <style>
        html,body {
            height: 100%;
        }
        #mouse_activator:focus{
            /* trick to activate the mouse */
            outline: none;
        }        
    </style>
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <title>Pyxel Resources Editor</title>

</head>

<body>

    <script>
        let csrftoken = "{{ csrf_token() }}";
        let token_private = "{{ $project->token_private }}"
        let res_file = atob("{{$res_file}}")
        console.log(res_file)
    </script>

    <div id="header" class="mt-2 pe-1 pb-1 font-monospace">
        <div class="row">
            <div class="col text-start">
            <span id="mouse_activator" tabindex="1">{{base64_decode($res_file)}}</span><span id="saved" class="text-success" style="font-size:160%;vertical-align:5px;"></span>
            </div>   
            <div class="col text-center">
                <button type="button" class="btn btn-secondary btn-sm ms-5 ps-3 pe-3" onclick="fullscreen('pyxel-screen')" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="mode plein écran"><i class="fa-solid fa-expand"></i></button> 
            </div>    
            <div class="col text-end text-dark pt-2">
                <div style="font-size:70%">cliquer ci-dessous sur <img src="{{ asset('public-pyxel/img/save_button.png') }}" /> pour sauvegarder les modifications</div>
            </div>
        </div>
    </div>    

    <pyxel-edit
        root="/storage/pyxel/projects/{{ $project->token_public }}"
        name={{base64_decode($res_file)}}
    ></pyxel-edit>   

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
            console.log(content_h)
            document.getElementById('pyxel-screen').setAttribute("style","overflow-y:hidden;height:"+content_h+"px");
        });
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
