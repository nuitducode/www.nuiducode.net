@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <script src="https://cdn.jsdelivr.net/gh/kitao/pyxel/wasm/pyxel.js"></script>
    <title>Evaluation Pyxel Player</title>
</head>
<body>
<?php
$jeu_dossier = Crypt::decryptString($jeu_dossier);
$jeu_dossier = str_replace("-", "/", $jeu_dossier );
if(File::exists(storage_path("app/public/depot-jeux/python/".$jeu_dossier))) {
    echo '<pyxel-run root="/storage/depot-jeux/python/'.$jeu_dossier.'" name="app.py"></pyxel-run>';
} else {
    echo '<div class="mt-4 text-monospace text-center text-danger">JEU INTROUVABLE<br /><small>signaler le problème: contact@nuitducode.net</small></div>';
}
?>
</body>
</html>