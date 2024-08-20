<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('pyxel/inc-meta')
    <title>PYXEL</title>
</head>
<body>

	<div class="container mt-4 mb-5">
		<div class="row">

			<div class="col-md-2">
                <div class="sticky-top">
					@include('inc-nav')
                </div>
			</div>

			<div class="col-md-10">
                <div class="row">
                    <div class="col-md-4 offset-md-4">

                        <div class="mt-3 text-center">
                            <img src="https://github.com/kitao/pyxel/raw/main/docs/images/pyxel_logo_152x64.png" />
                        </div>
						
                        <div class="mt-5 mb-5 font-monospace text-danger">
                            <b>ATTENTION</b>
                            <br />
                            IL EST CONSEILLÉ DORÉNAVANT D'UTILISER <a href="https://www.pyxelstudio.net">"PYXEL STUDIO"</a>. LA VERSION EST PLUS RÉCENTE ET UNE CONSOLE PERMET D'AFFICHER LES ERREURS PYTHON ET LES 'PRINT'.
                        </div>						
						
						<!--
                        <div class="mt-5 font-monospace text-danger">
                            <b>ATTENTION</b>
                            <br />
                            En haut de la prochaine page, s'affichera un <u>lien à conserver précieusement</u>. Sans ce lien vous ne pourrez plus revenir sur l'espace de développement de votre jeu.
                        </div>
						-->
						<br />
						<br />
						<br />
						<br />
						<br />


                        <div class="mt-5 text-center">
                            <a class="btn btn-sm btn-warning" href="/pyxel/creer" role="button">créer un nouveau jeu</a>
                        </div>

                    </div>

                </div>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

</body>
</html>
