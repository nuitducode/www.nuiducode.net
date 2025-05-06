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
    <title>{{ config('app.name', 'Laravel') }} | Dépôt jeu Scratch</title>
</head>
<body>

    @include('inc-nav')

    <?php
    $user = App\Models\User::where([['jeton', $etablissement_jeton]])->first(); 
    if ($user->depots_status == 0) {
        echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">Les dépôts sont fermés</div>';
        echo '</body>';
        echo '</html>';        
        exit;       
    };   
    ?>

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-8 offset-md-2">
			
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

                <div class="text-center"><img src="{{ url('/')}}/img/ndc.png" width="280" /></div>
                <div class="text-center text-monospace text-muted mt-1 mb-4"><b>~ SCRATCH ~</b></div>
				
				@if ($version == 'v2')
					<div class="p-3 text-danger text-monospace small" style="border:solid 1px #e3342f;border-radius:4px; ">
						<div class="font-weight-bold text-center"> JEU version 2</div>
						<div>IMPORTANT</div>
						<ul>
							<li>le jeu doit être une <u>version améliorée</u> du jeu qui a été déposé lors de la Nuit du Code</li>
							<li>le jeu <u>ne doit pas comporter de bogues</u></li>
							<li>le jeu doit <u>respecter toutes les consignes</u> de la Nuit du code (voir "<a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/" target="_blank">Règles et Conseils</a>")</li>
							<li>la <u>documentation</u> doit être <u>complète</u></li>
						</ul>
						<div>Si tous ces points ne sont pas validés, ne deposez pas de jeu.</div>
						<div class="font-weight-bold mt-2">Date limite: 6 septembre 2024</div>
					</div>
				@endif

                <form id="scratch_submit" method="POST" action="{{ route(request()->segment(1).'-jeu-deposer_post') }}" enctype="multipart/form-data">

					@csrf

                    <div class="form-group">
						<div for="nom_equipe" class="text-info mt-5">NOM DE L'ÉQUIPE <sup class="text-danger">*</sup></div>
						@if ($version == 'v1')
                        <div class="text-monospace text-muted small mb-1">Choisir un nom d'équipe de 20 caractères maximum et sans caractères spéciaux.</div>
						@endif
						@if ($version == 'v2')
                        <div class="text-monospace text-danger small mb-1">Vous devez saisir le même nom que lors du premier dépôt. Si le nom est différent, le jeu ne sera pas sauvegardé.</div>
						@endif
						<input id="nom_equipe" name="nom_equipe" type="text" class="form-control" autofocus>
                        <div id="error_nom_equipe" class="mt-1 text-danger text-monospace small" role="alert">&nbsp;</div>
					</div>

                    <div class="form-group">
                        <div for="categorie" class="text-info mt-2">CATÉGORIE <sup class="text-danger">*</sup></div>
                        <select id="categorie" name="categorie" class="custom-select">
                            <option selected disabled value="">choisir...</option>
                            <option value="C3">Cycle 3 : CM1 > 6e</option>
                            <option value="C4">Cycle 4 : 5e > 3e</option>
                            <option value="LY">Lycée</option>
                        </select>   
                        <div id="error_categorie" class="mt-1 text-danger text-monospace small" role="alert">&nbsp;</div>                     
					</div>

                    <!-- dropzone field -->
                    <div class="text-info mt-2">FICHIER SCRATCH <sup class="text-danger">*</sup></div>
                    <div class="text-monospace text-muted small mb-1">Déposer ci-dessous le fichier <kbd>.sb3</kbd> du jeu.</div>
                    <div id="formdropzone" class="dropzone"></div>
                    <div id="error_files" class="mt-1 text-danger text-monospace small">&nbsp;</div>

                    <div class="text-info mt-2">MODE D'EMPLOI / PRÉSENTATION <sup class="text-danger">*</sup></div>
                    <textarea class="form-control text-monospace" id="documentation" name="documentation" rows="10" required>
**UNIVERS CHOISI**:

**MODE D'EMPLOI**


**PRÉSENTATION / EXPLICATIONS**


                    </textarea>
                    <div id="error_documentation" class="mt-1 text-danger text-monospace small" role="alert">&nbsp;</div>

					<button type="submit" id="submit_request" class="btn btn-primary mt-3 pl-4 pr-4"><i class="fas fa-check"></i></button>

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
                url: "{{ route(request()->segment(1).'-jeu-deposer_post') }}",
                paramName: "fichiers_jeux",
                autoProcessQueue: false,
                uploadMultiple: true, // uplaod files in a single request
                parallelUploads: 2, // use it with uploadMultiple
                maxFilesize: 50, // MB
                maxFiles: 1,
                addRemoveLinks: true,
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                acceptedFiles: ".sb3",
                // Language Strings
                dictFileTooBig: "ce fichier est trop lourd (50 Mo maximum)",
                dictInvalidFileType: "format non valide",
                dictCancelUpload: "annuler",
                dictRemoveFile: "supprimer",
                dictMaxFilesExceeded: "un seul document autorisé",
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
                    document.getElementById('error_nom_equipe').innerHTML = "&nbsp;";
                    document.getElementById('error_categorie').innerHTML = "&nbsp;";
                    document.getElementById('error_files').innerHTML = "&nbsp;";
                    document.getElementById('error_documentation').innerHTML = "&nbsp;";
                    
                    if (document.getElementById('nom_equipe').value.length < 3) {
                        document.getElementById('error_nom_equipe').innerHTML = "trois caratères minimum";
                    } else if (document.getElementById('nom_equipe').value.length > 20) {
                        document.getElementById('error_nom_equipe').innerHTML = "pas plus de 20 caratères";
                    } else if (regex.test(document.getElementById('nom_equipe').value) == false) {
                        document.getElementById('error_nom_equipe').innerHTML = "caratères autorisés: lettres, chiffres, -, _ et espaces";
                    } else if (document.getElementById('categorie').selectedIndex == 0) {
                        document.getElementById('error_categorie').innerHTML = "une catégorie doit être choisie";
                    } else if (document.getElementById('documentation').value.length < 200) {
                        document.getElementById('error_documentation').innerHTML = "champ obligatoire (200 caractères minimum)";
                    } else if (dz.files.length !== 1) {
                        document.getElementById('error_files').innerHTML = "vous devez déposer un fichier '.sb3'";
                    } else {
                        dz.processQueue();
                    }
                })

                this.on("removedfile", function(file) {
                    document.getElementById('error_files').innerHTML = '&nbsp;';
                });

                this.on("addedfile", function(file) {
                    document.getElementById('error_files').innerHTML = '&nbsp;';
                });

                this.on("sendingmultiple", function(data, xhr, formData) {
                    formData.append("nom_equipe", jQuery("#nom_equipe").val());
                    formData.append("documentation", jQuery("#documentation").val());
                    formData.append("categorie", jQuery("#categorie").val());
                    formData.append("etablissement_jeton", "{{$etablissement_jeton}}");
                    formData.append("langage", "scratch");
                    formData.append("version", "{{$version}}");
                });
                this.on("successmultiple", function(files, response) {
                    console.log('success sending');
                    console.log('response: '+JSON.stringify(response));
                    window.location = "/jeu-depot-confirmation";
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
