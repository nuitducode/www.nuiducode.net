<?php
if (Auth::user()->is_admin != 1) {
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>ADMIN | NOTES</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-3 mb-5">
		<div class="row">

            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="{{ url()->previous() }}" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

            <div class="col-md-10">

                <h1 class="mb-0">ÉVALUATIONS</h1>
                <div class="text-monospace text-muted small">Nuit du Code 2023</div>
                <?php
                $user = App\Models\User::find(request()->get('id'));
                $etablissement_id = $user->id;
                $etablissement_jeton = $user->jeton;
                ?>
                <div class="text-monospace text-muted small">{{$user->etablissement}} &#8226; {{$user->ville}} &#8226; {{$user->pays}}</div>
                <div class="text-monospace text-muted small">{{$user->nom}} {{$user->prenom}} &#8226; {{$user->email}}</div>

                <h2>SCRATCH</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                    foreach ($categories AS $categorie_code => $categorie){
                        $jeux = App\Models\Game::where([['etablissement_id', $etablissement_id], ['type', 'ndc'], ['categorie', $categorie_code]])->get();
                        ?>
                        <h3 class="m-0 mb-1">{{$categorie}}</h3>
                        @if(count($jeux) == 0)
                            <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                        @else
                            <div class="row row-cols-1 row-cols-md-3">

                                <?php
                                $evaluations = [];
                                foreach($jeux AS $jeu){
                                    $nb_eval_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->count();
                                    $nb_eval_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->count();
                                    $note_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->avg('note');
                                    $note_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->avg('note');
                                    $note = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id]])->avg('note');
                                    $evaluations[$jeu->id] = ["nom_equipe"=>$jeu->nom_equipe, "scratch_id"=>$jeu->scratch_id, "finaliste"=>$jeu->finaliste, "nb_eval_eleves"=>$nb_eval_eleves, "nb_eval_enseignants"=>$nb_eval_enseignants, "note_eleves"=>$note_eleves, "note_enseignants"=>$note_enseignants, "note"=>$note];
                                }
                                uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                $evaluations = array_reverse($evaluations, TRUE);
                                ?>

                                @foreach($evaluations AS $evaluation)
                                    <div class="col mb-4">
                                        <div class="card p-3" @if($evaluation['finaliste'] == 1) style="background-color:#ffc905;border-radius:5px;" @endif> 

                                            <h3 class="mt-0" style="color:#4cbf56">@if($evaluation['finaliste'] == 1)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif {{$evaluation['nom_equipe']}}</h3>

											<div class="text-center">
												<a href="https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{$jeu->etablissement_jeton}}/{{$jeu->scratch_id}}.sb3" class="btn btn-success btn-sm" target="_blank" role="button">
													<i class="fas fa-gamepad fa-2x"></i>
												</a>
											</div>

											<div class="mt-2 text-monospace small">
												<div>Nb d'évaluations élèves: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_eleves'] }}</span></div>
												<div>Nb d'évaluations enseignants: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_enseignants'] }}</span></div>
												<div>Note élèves: <span class="text-primary font-weight-bold">@if($evaluation['note_eleves'] != 0){{ round($evaluation['note_eleves'], 1) }} @else - @endif</span></div>
												<div>Note enseignants: <span class="text-primary font-weight-bold">@if($evaluation['note_enseignants'] != 0) {{ round($evaluation['note_enseignants'],1) }} @else - @endif</span></div>
											</div>

											<kbd class="mt-2 text-center">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],1) }} @else - @endif</span></kbd>


                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <?php
                        }
                    ?>
                </div>

                <h2>PYTHON</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['PI' => 'Première', 'POO' => 'Terminale'];
                    foreach ($categories AS $categorie_code => $categorie){
                        $jeux = App\Models\Game::where([['etablissement_id', $etablissement_id], ['type', 'ndc'], ['categorie', $categorie_code]])->get();
                        ?>
                        <h3 class="m-0 mb-1">{{$categorie}}</h3>
                        @if(count($jeux) == 0)
                            <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                        @else
                            <div class="row row-cols-1 row-cols-md-3">

                                <?php
                                $evaluations = [];
                                foreach($jeux AS $jeu){
                                    $nb_eval_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->count();
                                    $nb_eval_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->count();
                                    $note_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->avg('note');
                                    $note_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->avg('note');
                                    $note = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id]])->avg('note');
                                    $evaluations[$jeu->id] = ["nom_equipe"=>$jeu->nom_equipe, "python_id"=>$jeu->python_id, "finaliste"=>$jeu->finaliste, "nb_eval_eleves"=>$nb_eval_eleves, "nb_eval_enseignants"=>$nb_eval_enseignants, "note_eleves"=>$note_eleves, "note_enseignants"=>$note_enseignants, "note"=>$note];
                                }
                                uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                $evaluations = array_reverse($evaluations, TRUE);
                                ?>

                                @foreach($evaluations AS $evaluation)

                                    <div class="col mb-4">
                                        <div class="card p-3" @if($evaluation['finaliste'] == 1) style="background-color:#ffc905;border-radius:5px;" @endif>

                                            <h3 class="mt-0" style="color:#4cbf56">@if($evaluation['finaliste'] == 1)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif {{ $evaluation['nom_equipe'] }}</h3>

                                            <div class="text-center">
                                                <a href="/console/jouer-jeu-pyxel/{{$etablissement_jeton.'-'.$evaluation['python_id']}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
                                            </div>

                                            <div class="mt-2 text-monospace small">
                                                <div>Nb d'évaluations élèves: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_eleves'] }}</span></div>
                                                <div>Nb d'évaluations enseignants: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_enseignants'] }}</span></div>
                                                <div>Note élèves: <span class="text-primary font-weight-bold">@if($evaluation['note_eleves'] != 0){{ round($evaluation['note_eleves'], 1) }} @else - @endif</span></div>
                                                <div>Note enseignants: <span class="text-primary font-weight-bold">@if($evaluation['note_enseignants'] != 0) {{ round($evaluation['note_enseignants'],1) }} @else - @endif</span></div>
                                            </div>

                                            <kbd class="mt-2 text-center">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],1) }} @else - @endif</span></kbd>

                                        </div>
                                    </div>
                                @endforeach
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
