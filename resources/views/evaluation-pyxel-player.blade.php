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
if(File::exists(storage_path("app/public/fichiers_pyxel/".$jeu_dossier))) {
    $files = File::files(storage_path("app/public/fichiers_pyxel/".$jeu_dossier));
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) == 'py') {
            $py_file = basename($file);
        }
    }
    echo '<pyxel-run root="/storage/fichiers_pyxel/'.$jeu_dossier.'" name="'.$py_file.'"></pyxel-run>';
} else {
    echo '<div class="mt-4 text-monospace text-center text-danger">JEU INTROUVABLE<br /><small>signaler le problème: contact@nuitducode.net</small></div>';
}
?>
</body>
</html>