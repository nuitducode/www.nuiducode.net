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

    
    <title>24 jours de Python-Pyxel | Dépôt</title>
    <style>
        .default-pyxel-screen {
            position: relative !important;

            width: 200px !important;
            height: 200px !important;
        }
        canvas#canvas {
            position: relative !important;
            left: 0%;
            top: 0%;
            width: 100%;
            height: 100%;
            /*image-rendering: pixelated;*/
        }
    </style>
</head>
<body>

    @include('inc-nav')

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

                <div class="text-center"><img src="{{ url('/')}}/img/ndc.png" width="240" /></div>
                <div class="text-center text-monospace text-dark mt-1 font-weight-bold" style="font-size:120%;">~ 24 JOURS DE PYTHON-PYXEL ~</div>	
                <div class="text-center text-monospace text-danger mb-2 font-weight-bold" style="font-size:120%;">JOUR 1</div>	
                <div class="text-center text-monospace text-success mb-4 font-weight-bold" style="font-size:100%;">Étape 2/2</div>	

                <?php
                // Chemin vers le fichier app.py
                $appFile = 'app.py';
                $appFile = storage_path('app').'/public/depot-jeux/python/2guy/njymd/app.py';
                $appContent = file_get_contents($appFile);
                $newLine  = "    if pyxel.btnp(pyxel.KEY_S):pyxel.screenshot()\n";

                // Rechercher "def update" et insérer la nouvelle ligne juste après
                $updatedContent = preg_replace(
                    "/^(def update.*)$/m", // Recherche la ligne qui commence par "def update"
                    "$1\n$newLine",        // Ajoute la nouvelle ligne après
                    $appContent
                );



       

                // Échapper les caractères spéciaux pour l'attribut HTML
                $escapedScript = htmlspecialchars($updatedContent, ENT_QUOTES);


                echo '<pre>';
                print_r($escapedScript);
                echo '</pre>';

                ?>

                <!-- Lancer Pyxel avec le script modifié -->
                <pyxel-run script="<?php echo $escapedScript; ?>"></pyxel-run>
                
                
<!--
                <pyxel-run
                script="
import pyxel

def update():
    pass
    




def draw():
    pyxel.cls(0)
    pyxel.text(50, 50, 'Appuyez S', pyxel.frame_count % 16)

pyxel.init(160, 120)
if pyxel.btnp(pyxel.KEY_A):pyxel.screenshot()
pyxel.run(update, draw)

                "
                ></pyxel-run>
            -->



                <button id="captureButton" onclick="captureCanvas()">Capturer le Canvas</button>
                <div id="capture"></div>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

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

function displayImage(imageURL) {
    const img = document.createElement('img');
    img.src = imageURL;
    img.alt = 'Capture Pyxel';
    img.style.border = '1px solid #000'; // Optionnel
    img.style.margin = '10px';
    document.body.appendChild(img);
}









    /*
async function loadPyodideAndPyxel() {
  await _loadScript(NO_SLEEP_URL);
  let noSleep = new NoSleep();
  noSleep.enable();
  await _loadScript(PYODIDE_URL);
  let pyodide = await loadPyodide();
  pyodide._api._skip_unwind_fatal_error = true;
  pyodide.canvas.setCanvas2D(canvas);
  await pyodide.loadPackage(_scriptDir() + PYXEL_WHEEL_PATH);
  let FS = pyodide.FS;
  FS.mkdir(PYXEL_WORKING_DIRECTORY);
  FS.chdir(PYXEL_WORKING_DIRECTORY);

  return pyodide;
}
*/

</script>

<script>
    /*
    function captureCanvas() {
    // Récupérer l'élément canvas
    const canvas = document.getElementById('canvas');
    
    // Convertir le contenu du canvas en data URL (image au format PNG)
    const imageDataURL = canvas.toDataURL('image/png');
    
    // Créer un élément <a> pour télécharger l'image
    const downloadLink = document.createElement('a');
    downloadLink.href = imageDataURL;
    downloadLink.download = 'canvas_capture.png'; // Nom du fichier téléchargé
    
    // Simuler un clic pour déclencher le téléchargement
    downloadLink.click();
    
}
    
    /*
function _scriptDir() {
  let scripts = document.getElementsByTagName("script");
  for (const script of scripts) {
    let match = script.src.match(/(^|.*\/)pyxel\.js$/);
    if (match) {
      return match[1];
    }
  }
}

async function capture() {
  await _loadScript(NO_SLEEP_URL);
  let noSleep = new NoSleep();
  noSleep.enable();
  await _loadScript(PYODIDE_URL);
  let pyodide = await loadPyodide();
  pyodide._api._skip_unwind_fatal_error = true;
  await pyodide.loadPackage(_scriptDir() + PYXEL_WHEEL_PATH);
  pyodide.runPython(`
  import pyxel.cli
  print('xxx')
  `);
  return pyodide;
}
  */


</script>

</body>
</html>
