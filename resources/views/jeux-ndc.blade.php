@include('inc-top')
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.svg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <!-- <script src="https://kit.fontawesome.com/692fbff6c4.js" crossorigin="anonymous"></script> -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Open Graph -->
    <meta property="og:title" content="Nuit du Code 2023 - Sélection internationale" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée." />
    <meta property="og:url" content="https://www.nuitducode.net/ndc2023" />
    <meta property="og:image" content="{{ asset('img/open-graph-selection-2024.png') }}" />
    <meta property="og:image:alt" content="Nuit du Code" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@nuitducode">
    <meta name="twitter:creator" content="@nuitducode">
    <meta name="twitter:title" content="Nuit du Code 2023 - Sélection internationale">
    <meta name="twitter:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée.">
    <meta name="twitter:image" content="{{ asset('img/open-graph-selection-2024.png') }}">

    <!-- Matomo - données anonymisées - pas de cookies - RGPD -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//www.awame.net/matomo/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '10']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->  

    <title>Nuit du Code | Les sélections internationales</title>
</head>
<body>

    @include('inc-nav')

    <div class="container mt-4 mb-5">

    <div class="row mb-4">

        <div class="col-md-12 text-center">

            <img src="{{ asset('img/ndc2024.png') }}" width="280" />
            <div class="font-weight-bold text-monospace" style="font-size:17px;color:#261b0c;">6h pour coder un jeu</div>
            <div class="mt-2 mb-5">
                <div class="text-monospace text-danger font-weight-bold" style="font-size:18px">SCRATCH <span style="color:silver;">&#8231;</span> PYTHON</div>
                <div class="text-center"><span style="margin-left:10px;"><img src="{{ asset('img/affiche/scratch.png') }}" width="35" /></span><span style="margin-left:60px;"><img src="{{ asset('img/affiche/python.png') }}" width="35" /></span></div>
            </div>
            
            <p class="text-center">
				<a class="btn btn-success text-monospace m-2" href="/jeux-ndc2024" role="button">sélection internationale 2024</a>
                <br />
                <a class="btn btn-success text-monospace m-2" href="/jeux-ndc2023" role="button">sélection internationale 2023</a>
                <br />
                <a class="btn btn-success text-monospace m-2" href="/jeux-ndc2022" role="button">sélection internationale 2022</a>
            </p>

        </div>
    </div>

</body>
</html>