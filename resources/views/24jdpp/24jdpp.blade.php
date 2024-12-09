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

    <div class="container-fluid mt-2 mb-2">
		<div class="row mb-4">
			<div class="col-md-8 offset-md-2">
                <div class="text-center"><img src="{{ url('/')}}/img/n-d-c.png" width="100" /></div>
                <div class="text-center text-monospace text-dark mt-1 font-weight-bold" style="font-size:110%;">~ 24 JOURS DE PYTHON-PYXEL ~</div>	
                <div class="text-center text-monospace text-danger mb-2 font-weight-bold" style="font-size:120%;">JOUR {{ $jour }}</div>	
                <div class="text-center text-monospace mt-2 mb-2"><a  class="btn btn-light btn-sm" href="https://nuit-du-code.forge.apps.education.fr/24-jours-de-python-pyxel/" role="button" >voir tous les sujets</a></div>	
            </div>
        </div>

		<div class="row">
            <div class="col-md-12 text-center">
                @foreach($apps as $app)
                    <?php
                    $gif_exists = Storage::exists('public/vingtquatre-apps/jour-'.$app['jour'].'/'.$app['jeton'] .'/screenshot.gif');
                    $png_exists = Storage::exists('public/vingtquatre-apps/jour-'.$app['jour'].'/'.$app['jeton'] .'/screenshot.png');
                    if ($gif_exists){
                        $capture = 'screenshot.gif';
                    } else {
                        $capture = 'screenshot.png';
                    }
                    ?>
                    @if($gif_exists OR $png_exists)
                        <a href="/24jdpp-lecteur/{{ Crypt::encryptString($app['id']) }}"><img src="{{ asset('storage/vingtquatre-apps/jour-'.$app['jour'].'/'.$app['jeton'] .'/'.$capture) }}" width="200" style="margin:5px;border-radius:4px;"></a>
                    @endif
                @endforeach
		    </div>
		</div><!-- /row -->
	</div><!-- /container -->

</body>
</html>
