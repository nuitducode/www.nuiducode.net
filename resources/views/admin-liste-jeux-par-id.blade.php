<?php
if (Auth::user()->is_admin != 1) {
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>ADMIN | JEUX</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-3 mb-5">
		<div class="row">

            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="{{ url()->previous() }}" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

			<div class="col-md-10">

                <h1 class="mb-0">JEUX</h1>
				
                <?php
                $user = App\Models\User::find(request()->get('id'));
                ?>
                <div class="text-monospace text-muted small">{{$user->etablissement}}-{{$user->ville}}-{{$user->pays}}</div>
                
                <h2>SCRATCH</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                <?php
                $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                foreach ($categories AS $categorie_code => $categorie){
                    $jeux = App\Models\Game::where([['etablissement_id', request()->get('id')], ['type', 'ndc'], ['categorie', $categorie_code]])->get();
                    ?>
                    <h3 class="m-0">{{$categorie}}</h3>
                    @if(count($jeux) == 0)
                        <div class="text-monospace text-danger small mb-4">~ pas de jeu dans cette catégorie ~</div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-striped table-sm text-monospace text-muted small">
                                    <thead><tr><th scope="col">Nom de l'équipe</th><th scope="col">Identifiant</th><th scope="col"></th></tr></thead>
                                    <tbody>
                                        @foreach($jeux AS $jeu)
                                        <tr>
                                            <td class="align-middle">{{$jeu->nom_equipe}}</td>
                                            <td class="align-middle"><a href="https://turbowarp.org?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{$jeu->etablissement_jeton}}/{{$jeu->scratch_id}}.sb3" target="_blank">{{$jeu->scratch_id}}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    <?php
                }
                ?>
                </div>
                <h2 class="mt-3">PYTHON</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                <?php
                $categories = ['PI' => 'Première', 'POO' => 'Terminale', 'PB' => 'Post-bac'];
                foreach ($categories AS $categorie_code => $categorie){
                    $jeux = App\Models\Game::where([['etablissement_id', request()->get('id')], ['type', 'ndc'], ['categorie', $categorie_code]])->get();
                    ?>
                    <h3 class="m-0">{{$categorie}}</h3>
                    @if(count($jeux) == 0)
                        <div class="text-monospace text-danger small mb-4">~ pas de jeu dans cette catégorie ~</div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-striped table-sm text-monospace text-muted small">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom de l'équipe</th>
                                            <th scope="col">Fichiers</th>
                                            <th scope="col">Identifiant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jeux AS $jeu)
                                        <tr>
                                            <td class="align-middle">{{$jeu->nom_equipe}}</td>
											<td class="align-middle">
												<?php
												$files = File::files(storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id));
												foreach($files AS $file) {
													echo '<kbd>'.basename($file).'</kbd> ';
												}
												?>
											</td>
                                            <td class="align-middle">
												<a href="/console/jouer-jeu-pyxel/{{$jeu->etablissement_jeton}}-{{$jeu->python_id}}" target="_blank">{{$jeu->python_id}}</a>
											</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    <?php
                    }
                ?>
                </div>
            </div>

        </div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>