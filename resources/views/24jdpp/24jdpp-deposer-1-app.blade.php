<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <link href="{{ asset('css/dropzone-basic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <title>24 jours de Python-Pyxel | Dépôt</title>
</head>
<body>

    @include('inc-nav')

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-8 offset-md-2">

                <div class="text-center"><img src="{{ url('/')}}/img/n-d-c.png" width="250" /></div>
                <div class="text-center text-monospace text-dark mt-1 font-weight-bold" style="font-size:110%;">~ 24 JOURS DE PYTHON-PYXEL ~</div>	
                <div class="text-center text-monospace text-danger mb-2 font-weight-bold" style="font-size:120%;">JOUR {{ $jour }}</div>
                <div class="text-center text-monospace text-success mb-4 font-weight-bold" style="font-size:100%;">Étape 1/3</div>	

                <form id="python_submit" method="POST" action="/24jdpp-deposer-app" enctype="multipart/form-data">

					@csrf        

                    <!-- dropzone field -->
                    <div class="text-info mt-2">FICHIERS PYXEL <sup class="text-danger">*</sup></div>
                    <div class="text-monospace text-muted small mb-1">Déposer ci-dessous le fichier <kbd>.py</kbd> et, s'il existe, le fichier <kbd>.pyxres</kbd></div>
                    <div id="formdropzone" class="dropzone"></div>
                    <div id="error_files" class="mt-1 text-danger text-monospace small">&nbsp;</div>

                    <!--
                    <div class="text-info mt-2">REMARQUES<span class="ml-2 small text-muted text-monospace font-italic">optionnel</span></div>
                    <textarea class="form-control" id="remarques" name="remarques" rows="5" required></textarea>
                    <div id="error_remarques" class="mt-1 text-danger text-monospace small" role="alert">&nbsp;</div>
                    -->

					<button type="submit" id="submit_request" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>

				</form>


			</div>

		</div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')
    <script src="{{ asset('js/dropzone.js') }}"></script>

    <script>
        // disable auto discover
        Dropzone.autoDiscover = false;
        // init dropzone on id (form or div)
        $(document).ready(function() {
            var formdropzone = new Dropzone("#formdropzone", {
                url: "/24jdpp-deposer-app",
                paramName: "fichiers_jeux",
                autoProcessQueue: false,
                uploadMultiple: true, // uplaod files in a single request
                parallelUploads: 2, // use it with uploadMultiple
                maxFilesize: 50, // MB
                maxFiles: 2,
                addRemoveLinks: true,
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                acceptedFiles: ".py, .pyxres",
                // Language Strings
                dictFileTooBig: "Ce fichier est trop lourd. 10 Mo max.",
                dictInvalidFileType: "format non valide",
                dictCancelUpload: "annuler",
                dictRemoveFile: "supprimer",
                dictMaxFilesExceeded: "deux documents au maximum",
                dictDefaultMessage: "glisser-déposer ici ou <span class='btn btn-outline-dark btn-sm'>parcourir</span>",
            });
        });
        Dropzone.options.formdropzone = {
            // The setting up of the dropzone
            init: function() {
                dz = this; // Makes sure that 'this' is understood inside the functions below.

                // for Dropzone to process the queue (instead of default form behavior):
                $("#submit_request").on("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();

                    var regex = /^[a-zA-Z0-9\-_ ]+$/;
                    document.getElementById('error_files').innerHTML = "&nbsp;";
                    document.getElementById('error_remarques').innerHTML = "&nbsp;";

                    var nb_py = 0
                    var nb_pyxres = 0
                    $.each(dz.files, function(key, value){
                        var fileExt = value.name.split('.').pop();
                        if (fileExt == "py") nb_py++;
                        if (fileExt == "pyxres") nb_pyxres++;
                    });

                    if (nb_py > 1) {
                        document.getElementById('error_files').innerHTML = "vous devez déposer un seul un fichier '.py'";
                    } else if (nb_pyxres > 1) {
                        document.getElementById('error_files').innerHTML = "vous devez déposer un seul un fichier '.pyxres'";
                    } else if (dz.files.length == 0) {
                        document.getElementById('error_files').innerHTML = "vous devez déposer un fichier '.py' et, s'il existe, un fichier '.pyxres'";
                    } else if (nb_py == 0) {
                        document.getElementById('error_files').innerHTML = "vous devez déposer au moins un fichier '.py'";
                    } else {
                        dz.processQueue();
                    }

                });

                this.on("removedfile", function(file) {
                    document.getElementById('error_files').innerHTML = '&nbsp;';
                });

                this.on("addedfile", function(file) {
                    document.getElementById('error_files').innerHTML = '&nbsp;';
                });

                //send all the form data along with the files:
                this.on("sendingmultiple", function(data, xhr, formData) {
                    formData.append("jour", {{ $jour }});
                    formData.append("remarques", jQuery("#remarques").val());
                });
                this.on("successmultiple", function(files, response) {
                    console.log('success sending');
                    console.log('response: '+JSON.stringify(response));
                    window.location = "/24jdpp-deposer-capture";
                });
                this.on("errormultiple", function(files, response) {
                    console.log('error sending');
                    console.log('error: '+JSON.stringify(response));
                    $("#error_files").text(response);
                });

            }
        };
    </script>

</body>
</html>
