<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <script src="https://cdn.jsdelivr.net/gh/kitao/pyxel/wasm/pyxel.js"></script>
    <title>24 jours de Python-Pyxel | Lecteur</title>
    <style>
        body {
            padding-left:20px;
            padding-right:20px;
        }
        .default-pyxel-screen {
            position:relative;
            height: calc(100vh - 50px);
            border-radius:5px;
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

    <?php
    $app = App\Models\Vingtquatre_app::find(Crypt::decryptString($id));
    ?>

    <div class="mt-1">
        <a class="btn btn-light btn-sm mb-1" href="/24jdpp/{{$app['jour']}}" role="button"><i class="fas fa-arrow-left"></i></a>
    </div>

    <!-- Lancer Pyxel avec le script modifié -->
    <pyxel-run root="{{asset('storage/vingtquatre-apps/jour-'.$app['jour'].'/'.$app['jeton']) }}" name="app.py"></pyxel-run>

</body>
</html>
