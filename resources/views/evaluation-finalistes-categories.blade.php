<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Nuit du Code | Évaluation des finalistes</title>
</head>
<body>

    @include('inc-nav')

    <?php
    /*
    echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">';
    echo 'LES ÉVALUATIONS DÉBUTENT DÉBUT JUIN';
    echo '</div>';
    echo '</body>';
    echo '</html>';
    exit;
    */
    /*
    echo '<div class="text-success text-monospace text-center mt-5 pb-4" role="alert">';
    echo 'LES ÉVALUATIONS SONT MAINTEANT TERMINÉES';
    echo '</div>';
    echo '</body>';
    echo '</html>';
    exit;
    */
    ?>

	<div class="container mt-4 mb-5">
		<div class="row pt-3">
            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="/console" role="button"><i class="fas fa-arrow-left" aria-hidden="true"></i></a>
            </div>

			<div class="col-md-10">

                @if (session('message'))
                    <div class="text-success text-monospace text-center mt-5 pb-4" role="alert">
                        {{ session('message') }}
                    </div>
                @endif            

                <h1 class="">ÉVALUATIONS POUR LA SÉLECTION INTERNATIONALE</h1>
                <p>Choisir une catégorie pour évaluer un lot de 4 jeux.</p>
                <!--<p class="text-success text-monospace small">Tous les jeux ont été évalués! Merci!</p>-->
                <h2 class="">SCRATCH</h2>
                <a class="btn btn-success mr-1" href="/console/evaluation-finalistes/{{ Crypt::encryptString('C3') }}" role="button">Cycle 3</a>
                <a class="btn btn-success mr-1" href="/console/evaluation-finalistes/{{ Crypt::encryptString('C4') }}" role="button">Cycle 4</a>
                <a class="btn btn-success" href="/console/evaluation-finalistes/{{ Crypt::encryptString('LY') }}" role="button">Lycée</a>

                <h2 class="">PYTHON</h2>
                <a class="btn btn-success mr-1" href="/console/evaluation-finalistes/{{ Crypt::encryptString('PI') }}" role="button">Première</a>
                <a class="btn btn-success" href="/console/evaluation-finalistes/{{ Crypt::encryptString('POO') }}" role="button">Terminale</a>
                <a class="btn btn-success" href="/console/evaluation-finalistes/{{ Crypt::encryptString('PB') }}" role="button">Post-bac</a>

            </div>
        </div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
