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
    <title>24 jours de Python-Pyxel | Confirmation</title>
</head>
<body>

    @include('inc-nav')

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-8 offset-md-2">

                <div class="text-center"><img src="{{ url('/')}}/img/n-d-c.png" width="250" /></div>
                <div class="text-center text-monospace text-dark mt-1 font-weight-bold" style="font-size:110%;">~ 24 JOURS DE PYTHON-PYXEL ~</div>	
                <div class="text-center text-monospace text-danger mb-2 font-weight-bold" style="font-size:120%;">JOUR  {{ session('depot_24_app_jour') }}</div>	
                <div class="text-center text-monospace text-success mb-4 font-weight-bold" style="font-size:100%;">Étape 3/3</div>	

                <div class="text-center text-monospace mt-2 mb-2">Capture enregistrée!</div>
                <div class="text-center text-monospace mt-2 mb-2"><a  class="btn btn-light btn-sm" href="/24jdpp/{{ session('depot_24_app_jour') }}" role="button" >quitter</a></div>
                <?php
                if (Storage::exists('public/vingtquatre-apps/jour-'.session('depot_24_app_jour').'/'.Crypt::decryptString(session('depot_24_app_jeton')).'/screenshot.gif')){
                    $capture = 'screenshot.gif';
                }else{
                    $capture = 'screenshot.png';
                }
                ?>
                <div class="text-center text-monospace mt-2 mb-5"><img src="{{ asset('storage/vingtquatre-apps/jour-'.session('depot_24_app_jour').'/'.Crypt::decryptString(session('depot_24_app_jeton')).'/'.$capture) }}" alt="Image enregistrée" style="border-radius:4px;"></div>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')   

</body>
</html>
