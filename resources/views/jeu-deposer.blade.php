@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Nuit du Code | Dépôt jeu SCRATCH ou PYTHON</title>
</head>
<body>

    @include('inc-nav')

    <?php
    $user = App\Models\User::where([['jeton', $etablissement_jeton]])->first(); 
    if ($user->depots_status == 0) {
        echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">Les dépôts sont fermés</div>';
        echo '</body>';
        echo '</html>';        
        exit;       
    };   
    ?>

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-6 offset-md-3">

                <div class="text-center mb-4"><img src="{{ url('/')}}/img/ndc.png" width="280" /></div>

                <div class="mt-5 text-center">
                    <a class="btn btn-primary mr-2" href="/{{request()->segment(1)}}/scratch/{{$etablissement_jeton}}/{{$version}}" role="button">Déposer un jeu<br />SCRATCH</a>
                    <a class="btn btn-primary mr-2" href="/{{request()->segment(1)}}/python/{{$etablissement_jeton}}/{{$version}}" role="button">Déposer un jeu<br />PYTHON</a>
                </div>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
