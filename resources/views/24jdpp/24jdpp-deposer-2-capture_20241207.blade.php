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
    <script src="https://cdn.jsdelivr.net/gh/kitao/pyxel/wasm/pyxel.js"></script>
    <title>24 jours de Python-Pyxel | Capture d'écran</title>
    <style>
        .default-pyxel-screen {
            position:relative;
            width: calc(50vw - 21px);
            margin-left:6px;
            height:400px;
            float:left;
            border-radius:5px;
            box-sizing:border-box;
        }
        canvas#canvas {
            position: relative !important;
            left: 0%;
            top: 0%;
            padding:8px;
            width: 100%;
            height: 100%;
            border-radius:5px;
            image-rendering: pixelated;
        }
    </style>
</head>
<body>

	<div class="container mt-2 mb-2">
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

                <div class="text-center"><img src="{{ url('/')}}/img/n-d-c.png" width="250" /></div>
                <div class="text-center text-monospace text-dark mt-1 font-weight-bold" style="font-size:110%;">~ 24 JOURS DE PYTHON-PYXEL ~</div>	
                <div class="text-center text-monospace text-danger mb-2 font-weight-bold" style="font-size:120%;">JOUR 1</div>	
                <div class="text-center text-monospace text-success font-weight-bold" style="font-size:100%;">Étape 2/2</div>	
         
{{ Crypt::decryptString(session('depot_24_app_id')) }} </br> 
{{ Crypt::decryptString(session('depot_24_app_jeton')) }} </br> 
{{ session('depot_24_app_id') }} </br> 
{{ session('depot_24_app_jeton') }}





                <div class="text-center text-monospace mt-2 mb-3">
                    Lancer le programme puis faire une capture avec la combinaison de touches <kbd>Ctrl</kbd>+<kbd>Alt</kbd>+<kbd>C</kbd>. Vous pouvez faire plusieurs tentatives avant de valider l'image.
                </div>

            </div>
        </div>

		<div class="row">
			<div class="col-md-6 text-right"> 
                <a class="btn btn-light btn-sm" href="{{ request()->fullUrl() }}" role="button" data-toggle="tooltip" data-placement="top" title="relancer le programme"><i class="fa-solid fa-rotate"></i></a>
            </div>
            <div class="col-md-6 text-left">

                <span id="supprimer_button">
                    <a  id="save-button" onclick="showConfirm('supprimer_button', 'supprimer_confirm')" class="btn btn-success btn-sm" style="padding-left:18px;padding-right:20px;display:none;" href="#" role="button" data-toggle="tooltip" data-placement="top" title="sauvegarder l'image"><i class="fa-solid fa-arrow-right-to-bracket fa-rotate-90"></i></a>
                </span>
                <span id="supprimer_confirm" style="display:none">
                    <a onclick="saveImage()" class="btn btn-danger btn-sm text-monospace" style="padding-left:18px;padding-right:20px;" href="#" role="button"><i class="fa-solid fa-arrow-right-to-bracket fa-rotate-90 mr-3"></i>confirmer</a>
                    <div onclick="hideConfirm('supprimer_button', 'supprimer_confirm')" class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-xmark"></i></div>
                </span>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

    <?php
    $appFile = storage_path('app').'/public/depot-jeux/python/2guy/njymd/app.py';
    $appContent = file_get_contents($appFile);
    $newLine  = "    if (pyxel.btn(pyxel.KEY_CTRL) and pyxel.btn(pyxel.KEY_ALT) and pyxel.btnp(pyxel.KEY_C)):pyxel.screenshot()\n";

    // Rechercher "def update(" et insérer la nouvelle ligne juste après
    $updatedContent = preg_replace(
        "/^(def update.*)$/m",
        "$1\n$newLine",
        $appContent
    );
    $escapedScript = htmlspecialchars($updatedContent, ENT_QUOTES);
    ?>

    <!-- Lancer Pyxel avec le script modifié -->
    <pyxel-run script="<?php echo $escapedScript; ?>"></pyxel-run>  

    @include('inc-bottom-js')

    <script>
        document.addEventListener('click', (event) => {
            const target = event.target;
            if (target.tagName === 'A' && target.download) {
                // Empêche le téléchargement automatique
                event.preventDefault();

                // Récupérer l'URL de l'image
                const imageURL = target.href;

                // Afficher l'image sur la page
                displayImage(imageURL);

                console.log("Téléchargement intercepté et annulé.");
            }
        });
    </script>

    <script>

        // Créer le conteneur si ce n'est pas déjà fait
        container = document.createElement('div');
        container.id = 'image-container';
        container.style.textAlign = 'center';
        container.style.position = 'relative';
        container.style.margin = '0px';
        container.style.height = '400px';
        container.style.width = 'calc(50vw - 21px)';
        container.style.float = 'right';
        container.style.marginRight = '6px';
        container.style.border = '3px dashed silver';
        container.style.borderRadius = '5px';
        document.body.appendChild(container);


        function displayImage(imageURL) {
            // Afficher le bouton de sauvegarde
            saveButton = document.getElementById('save-button');
            saveButton.style.display = 'inline-block';
            //saveButton.onclick = () => saveImage();

            // Supprimer l'image précédente
            let img = document.getElementById('current-image');
            if (img) {
                img.remove();
            }

            // Ajouter la nouvelle image
            img = document.createElement('img');
            img.id = 'current-image';
            img.src = imageURL;
            img.alt = 'Capture Pyxel';
            img.style.margin = '6px';
            img.style.height = '380px';
            img.style.borderRadius = '4px';
            container.appendChild(img);
        }

        function saveImage() {
            // Récupérer l'image actuelle
            const img = document.getElementById('current-image');
            if (!img) {
                alert("Aucune image à sauvegarder !");
                return;
            }

            const imageURL = img.src;

            // Envoyer l'image au serveur
            fetch('/24jdpp-deposer-capture', {
                method: 'POST',
				mode: "cors",
                headers: {"Content-Type": "application/json; charset=UTF-8", "X-CSRF-Token": "{{ csrf_token() }}"},
                body: JSON.stringify({ image: imageURL }),
            })
            .then(response => {
                if (response.ok) {
                    console.log('Image sauvegardée avec succès.');
                    console.log(response.text());
                    //window.location.replace("/");
                } else {
                    console.log('Erreur lors de la sauvegarde de l\'image.');
                    return response.text().then(errorText => {
                        console.log('Erreur: ' + errorText);
                    });
                }
            })
            .catch(error => console.error('Erreur:', error));

        }

    </script>

    {{-- == Mécanisme confirmation suppression cellule ======================= --}}
    <script>
        function showConfirm(buttonId, confirmId) {
            // Cacher le bouton delete_button et afficher delete_confirm
            document.getElementById(buttonId).style.display = 'none';
            document.getElementById(confirmId).style.display = 'inline';
        }

        function hideConfirm(buttonId, confirmId) {
            // Cacher delete_confirm et réafficher delete_button
            document.getElementById(confirmId).style.display = 'none';
            document.getElementById(buttonId).style.display = 'inline';
        }
    </script>
    {{-- == /Mécanisme bouton confirmation =================================== --}}    

</body>
</html>
