@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>NdC Console | Jeux v2</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-3 mb-5">
		<div class="row">

            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

			<div class="col-md-10">

    			@if (session('status'))
    				<div class="text-success text-monospace text-center pb-4" role="alert">
    					{{ session('status') }}
    				</div>
    			@endif

                <h1 class="mb-0">JEUX VERSION 2</h1>
                <div class="text-monospace text-muted small">
                    @if(request()->segment(2) == 'ndc') Nuit du Code 2024 @endif
                    @if(request()->segment(2) == 'sltn') Sélections @endif
                    @if(request()->segment(2) == 'demo') Démo @endif
                </div>
                <h2>SCRATCH</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                <?php
                $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                foreach ($categories AS $categorie_code => $categorie){
                    $jeux = App\Models\Ndc24_v2_game::where([['etablissement_id', Auth::user()->id], ['type', request()->segment(2)], ['categorie', $categorie_code]])->get();
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
                                            <td class="align-middle"><a href="https://turbowarp.org/embed/?project_url=www.nuitducode.net/storage/2024-depot-jeux-v2/scratch/{{Auth::user()->jeton}}/{{$jeu->scratch_id}}.sb3" target="_blank">{{$jeu->scratch_id}}</a></td>
                                            <td class="text-right" style="width:160px;">
                                                <button class="btn btn-dark btn-sm text-light" type="button" data-toggle="collapse" data-target="#collapse_{{$jeu->id}}" aria-expanded="false" aria-controls="collapse_{{$jeu->id}}">
                                                    <i class='fas fa-trash fa-sm'></i>
                                                </button>
                                                <div class="collapse" id="collapse_{{$jeu->id}}">
                                                    <a href='/console/supprimer-jeu-v2/{{ Crypt::encryptString($jeu->id) }}' class='mt-2 btn btn-danger btn-sm text-white' role='button'>confirmer</a>
                                                    <a class="mt-2 btn btn-light btn-sm text-dark" data-toggle="collapse" href="#collapse_{{$jeu->id}}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-xmark"></i></a>
                                                </div>
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

                <h2 class="mt-3">PYTHON</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['PI' => 'Première', 'POO' => 'Terminale', 'PB' => 'Post-bac'];
                    foreach ($categories AS $categorie_code => $categorie){
                        $jeux = App\Models\Ndc24_v2_game::where([['etablissement_id', Auth::user()->id], ['type', request()->segment(2)], ['categorie', $categorie_code]])->get();
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
                                                <th scope="col"></th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($jeux AS $jeu)
                                            <tr>
                                                <td class="align-middle">{{$jeu->nom_equipe}}</td>
                                                <td class="align-middle">
                                                    <?php
                                                    $files = File::files(storage_path("app/public/2024-depot-jeux-v2/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id));
                                                    foreach($files AS $file) {
                                                        echo '<kbd>'.basename($file).'</kbd> ';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="align-middle">
													<?php
													$jeu_data = Crypt::encryptString(serialize(['modele'=>'Ndc24_v2_game','jeu_id'=>$jeu->id,'python_id'=>$jeu->python_id,'etablissement_jeton'=>$jeu->etablissement_jeton,'jeu_dossier'=>'2024-depot-jeux-v2/python/'.$jeu->etablissement_jeton.'/'.$jeu->python_id]));
													?>
													<a href="/jouer-pyxel/{{$jeu_data}} " target="_blank">{{$jeu->python_id}}</a>
												</td>
                                                <td class="text-right" style="width:160px;">
                                                    <button class="btn btn-dark btn-sm text-light" type="button" data-toggle="collapse" data-target="#collapse_{{$jeu->id}}" aria-expanded="false" aria-controls="collapse_{{$jeu->id}}">
                                                        <i class='fas fa-trash fa-sm'></i>
                                                    </button>
                                                    <div class="collapse" id="collapse_{{$jeu->id}}">
                                                        <a href='/console/supprimer-jeu-v2/{{ Crypt::encryptString($jeu->id) }}' class='mt-2 btn btn-danger btn-sm text-white' role='button'>confirmer</a>
                                                        <a class="mt-2 btn btn-light btn-sm text-dark" data-toggle="collapse" href="#collapse_{{$jeu->id}}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-xmark"></i></a>
                                                    </div>
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
