<!doctype html>
<html lang="fr">
<head>
    <script src="https://cdn.jsdelivr.net/gh/kitao/pyxel/wasm/pyxel.js"></script>
    <title>Jouer Pyxel</title>
</head>
<body>
	<?php
	try {
		$jeu_dossier = Crypt::decryptString($jeu_dossier);   
		if(File::exists(storage_path('app/public/'.$jeu_dossier))) {
			echo '<pyxel-run root="/storage/'.$jeu_dossier.'" name="app.py"></pyxel-run>';
		} else {
			echo '<div style="font-family:monospace">JEU INTROUVABLE<br /><small>signaler le problème: contact@nuitducode.net</small></div>';
		}		
	} catch (Exception $e) {
		echo '<div style="font-family:monospace">JEU INTROUVABLE<br /><small>signaler le problème: contact@nuitducode.net</small></div>';
	}
	?>
</body>
</html>