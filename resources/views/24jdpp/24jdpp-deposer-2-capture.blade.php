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
    <script src="https://cdn.jsdelivr.net/npm/gif.js/dist/gif.js"></script>
    <title>24 jours de Python-Pyxel | Capture</title>
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
			<div class="col-md-10 offset-md-1">

                <div class="text-center"><img src="{{ url('/')}}/img/n-d-c.png" width="100" /></div>
                <div class="text-center text-monospace text-dark mt-1 font-weight-bold" style="font-size:110%;">~ 24 JOURS DE PYTHON-PYXEL ~</div>	
                <div class="text-center text-monospace text-danger mb-2 font-weight-bold" style="font-size:120%;">JOUR {{ session('depot_24_app_jour') }}</div>	
                <div class="text-center text-monospace text-success font-weight-bold" style="font-size:100%;">Étape 2/3</div>	
         
                <div class="text-left text-monospace mt-2 mb-3">
                    Lancer le programme puis faire une capture. Utiliser le chiffre du clavier, pas du pavé numérique.
                    <ul>
                        <li>
                            Pour capturer une seule image: faire la combinaison de touches <kbd>Alt</kbd>+<kbd>1</kbd>.
                        </li>
                        <li>
                            Pour capturer un gif animé: faire la combinaison de touches <kbd>Alt</kbd>+<kbd>2</kbd> pour démarrer la capture, puis <kbd>Alt</kbd>+<kbd>3</kbd> pour l'arrêter.
                        </li>
                    </ul>
                    Vous pouvez faire plusieurs tentatives avant de valider la capture.
                </div>

            </div>
        </div>

		<div class="row">
			<div class="col-md-6 text-right"> 
                <a class="btn btn-light btn-sm" href="{{ request()->fullUrl() }}" role="button" data-toggle="tooltip" data-placement="top" title="relancer le programme"><i class="fa-solid fa-rotate"></i></a>
            </div>
            <div class="col-md-6 text-left">

                <span id="confirmer_button">
                    <a  id="save-button" onclick="showConfirm('confirmer_button', 'confirmer_confirm')" class="btn btn-success btn-sm" style="padding-left:18px;padding-right:20px;display:none;" href="#" role="button" data-toggle="tooltip" data-placement="top" title="sauvegarder l'image"><i class="fa-solid fa-arrow-right-to-bracket fa-rotate-90"></i></a>
                </span>
                <span id="confirmer_confirm" style="display:none">
                    <a class="btn btn-danger btn-sm text-monospace" style="padding-left:18px;padding-right:20px;" href="/24jdpp-deposer-fin" role="button"><i class="fa-solid fa-arrow-right-to-bracket fa-rotate-90 mr-3"></i>confirmer</a>
                    <div onclick="hideConfirm('confirmer_button', 'confirmer_confirm')" class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-xmark"></i></div>
                </span>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

    <!-- Lancer Pyxel avec le script modifié -->
    <pyxel-run root="{{asset('storage/vingtquatre-apps/jour-'.session('depot_24_app_jour').'/'.Crypt::decryptString(session('depot_24_app_jeton')))}}" name="app.py"></pyxel-run>

    @include('inc-bottom-js')

    <script>
        document.addEventListener('click', (event) => {
            const target = event.target;

            if (target.tagName === 'A' && target.download) {
                // Empêche le téléchargement automatique
                event.preventDefault();

                // Récupérer l'URL de l'image
                const imageURL = target.href;

                // Télécharger le fichier sous forme de Blob
                fetch(imageURL)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.blob();
                    })
                    .then(blob => {
                        console.log("Blob téléchargé :", blob);

                        // Afficher l'image sur la page
                        displayImage(URL.createObjectURL(blob));

                        // Envoyer le fichier Blob au serveur
                        envoyerBlobAuServeur(blob);

                        console.log("Téléchargement intercepté et annulé.");
                    })
                    .catch(error => {
                        console.error("Erreur lors du téléchargement :", error);
                    });
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

        function envoyerBlobAuServeur(blob) {
            const formData = new FormData();
            formData.append("image", blob, "image_sauvegardee");

            fetch('/24jdpp-deposer-capture', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                },
                body: formData
            })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return response.text().then(errorText => {
                            console.error('Erreur lors de l\'envoi au serveur :', errorText);
                        });
                    }
                })
                .then(data => {
                    if (data && data.message) {
                        console.log("Fichier sauvegardé avec succès sur le serveur.");
                    }
                })
                .catch(error => {
                    console.error("Erreur réseau lors de l'envoi :", error);
                });
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
