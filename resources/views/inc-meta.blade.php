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
<meta property="og:title" content="Nuit du Code" />
<meta property="og:type" content="website" />
<meta property="og:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée." />
<meta property="og:url" content="https://www.nuitducode.net" />
<meta property="og:image" content="{{ asset('img/open-graph.png') }}" />
<meta property="og:image:alt" content="Nuit du Code" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@nuitducode">
<meta name="twitter:creator" content="@nuitducode">
<meta name="twitter:title" content="Nuit du Code">
<meta name="twitter:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée.">
<meta name="twitter:image" content="{{ asset('img/open-graph.png') }}">

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