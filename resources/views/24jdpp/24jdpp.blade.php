<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>24 jours de Python-Pyxel</title>
</head>
<body>

    <?php
    $apps = App\Models\Vingtquatre_app::where([['jour', $jour]])->get();
    ?>

    <div class="container mt-2 mb-2">
		<div class="row mb-4">
			<div class="col-md-8 offset-md-2">
                <div class="text-center"><img src="{{ url('/')}}/img/n-d-c.png" width="250" /></div>
                <div class="text-center text-monospace text-dark mt-1 font-weight-bold" style="font-size:110%;">~ 24 JOURS DE PYTHON-PYXEL ~</div>	
                <div class="text-center text-monospace text-danger mb-2 font-weight-bold" style="font-size:120%;">JOUR {{ $jour }}</div>	
            </div>
        </div>

		<div class="row">
            <div class="col-md-12 text-center">
                @foreach($apps as $app)
                    <a href="/24jdpp-lecteur/{{ Crypt::encryptString($app['id']) }}"><img src="{{ asset('storage/vingtquatre-apps/jour-'.$app['jour'].'/'.$app['jeton'] .'/screenshot.png') }}" width="200" style="margin:5px;border-radius:4px;"></a>
                @endforeach
		    </div>
		</div><!-- /row -->
	</div><!-- /container -->

</body>
</html>
