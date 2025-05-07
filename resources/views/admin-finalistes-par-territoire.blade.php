<?php
if (Auth::user()->is_admin != 1) {
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>ADMIN | FINALISTES</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-3 mb-5">
		<div class="row">

            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="{{ url()->previous() }}" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

            <div class="col-md-10">
                <?php
                // JEUX EXCLUS
                $excluded_games = [];
                
                $academies = ["Aix-Marseille", "Amiens", "Besançon", "Bordeaux", "Clermont-Ferrand", "Corse", "Créteil", "Dijon", "Grenoble", "Guadeloupe", "Guyane", "La Réunion", "Lille", "Limoges", "Lyon", "Martinique", "Mayotte", "Montpellier", "Nancy-Metz", "Nantes", "Nice", "Normandie", "Orléans-Tours", "Paris", "Poitiers", "Reims", "Rennes", "Strasbourg", "Toulouse", "Versailles", "Wallis-et-Futuna", "Nouvelle-Calédonie", "Saint-Pierre-et-Miquelon", "Polynésie française"];
                $zones_aefe = ["AEFE - Afrique Australe et Orientale", "AEFE - Afrique Centrale", "AEFE - Afrique Occidentale", "AEFE - Amérique du Nord", "AEFE - Amérique Latine Rythme Nord", "AEFE - Amérique Latine Rythme Sud", "AEFE - Asie-Pacifique", "AEFE - Europe Centrale et Orientale", "AEFE - Europe du Nord-Ouest et Scandinave", "AEFE - Europe du Sud-Est", "AEFE - Europe Ibérique", "AEFE - Maghreb Est", "AEFE - Maroc", "AEFE - Proche-Orient", "AEFE - Moyen-Orient", "AEFE - Océan Indien"];
                $territoires = array_merge($academies, $zones_aefe);
  
                foreach ($territoires AS $territoire) {
                    echo '<h1 class="mt-5 mb-0 text-danger font-weight-bold">'.$territoire.'</h1>';
                    ?>

                    <h2>SCRATCH</h2>
                    <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                        <?php
                        $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                        foreach ($categories AS $categorie_code => $categorie) {

                            $jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
                            ->whereNotIn('games.id', $excluded_games)
                            ->where([
                                ['users.fin_evaluations', '=', 1],  
                                ['users.ac_zone', '=', $territoire],  
                                ['games.type', 'ndc'], 
                                ['games.categorie', $categorie_code], 
                                ['games.finaliste', 1]
                            ])
                            ->select('games.*')
                            ->get();

                            $nb_jeux = $jeux->count();
                            ?>

                            <h3 class="m-0 mb-1">{{$categorie}} [{{$nb_jeux}}]</h3>
                            @if($nb_jeux == 0)
                                <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                            @else
                                <div class="row row-cols-1 row-cols-md-4">

                                    <?php
                                    $evaluations = [];
                                    foreach($jeux AS $jeu){
                                        $nb_evals = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id]])->count();
                                        $note = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id]])->avg('note');
                                        $evaluations[$jeu->id] = ["nom_equipe"=>$jeu->nom_equipe, "etablissement_id"=>$jeu->etablissement_id, "scratch_id"=>$jeu->scratch_id, "nb_evals"=>$nb_evals, "note"=>$note];
                                    }
                                    uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                    $evaluations = array_reverse($evaluations, TRUE);
                                    ?>

                                    @foreach($evaluations AS $id => $evaluation)
                                        <div class="col mb-4">
                                            <div class="card h-100 p-3" @if(($loop->iteration <= 8) AND $evaluation['note'] != 0) style="background-color:#ffc905;border-radius:5px;" @endif>
												<div class="card-body p-0">
													<h3 class="mt-0" style="@if(in_array($id, $excluded_games)) text-decoration: line-through; @endif color:#4cbf56">@if(($loop->iteration <= 8) AND $evaluation['note'] != 0)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif {{$evaluation['nom_equipe']}}</h3>

													<?php
													$etablissement = App\Models\User::where('id', $evaluation['etablissement_id'])->first();
													?>
													<div class="text-monospace text-muted small mb-1" style="font-size:70%;color:silver;">
														[{{$id}}] {{$etablissement->etablissement}} - {{$etablissement->ville}} - {{$etablissement->pays}} - {{$etablissement->email}}<br />{{$etablissement->ac_zone}}
													</div>
												</div>

												<div class="card-footer mt-2">

													<div style="position:relative">
														<div style="position:absolute;top: 50%; left: 50%; transform: translate(-50%, -50%);">
															<a href="https://scratch.mit.edu/projects/{{$evaluation['scratch_id']}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
														</div>
														<img src="https://uploads.scratch.mit.edu/get_image/project/{{$evaluation['scratch_id']}}_282x218.png" class="img-fluid" style="border-radius:4px;" width="100%" />
													</div>

													<div class="mt-2 mb-1 text-monospace small">
														<div>Nb d'évaluations: <span class="text-primary font-weight-bold">{{ $evaluation['nb_evals'] }}</span></div>
													</div>
													<div class="text-center">
														<kbd class="text-center" style="display:block;">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],2) }} @else - @endif</span></kbd>
													</div>
												</div>
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
                        $categories = ['PI' => 'Première', 'POO' => 'Terminale', 'PB' => 'Postbac'];
                        foreach ($categories AS $categorie_code => $categorie) {

                            $jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
                            ->whereNotIn('games.id', $excluded_games)
                            ->where([
                                ['users.fin_evaluations', '=', 1],  
                                ['users.ac_zone', '=', $territoire], 
                                ['games.type', 'ndc'], 
                                ['games.categorie', $categorie_code], 
                                ['games.finaliste', 1]
                            ])
                            ->select('games.*')
                            ->get();

                            $nb_jeux = $jeux->count();
                            ?>

                            <h3 class="m-0 mb-1">{{$categorie}} [{{$nb_jeux}}]</h3>
                            @if(count($jeux) == 0)
                                <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                            @else
                                <div class="row row-cols-1 row-cols-md-4">

                                    <?php
                                    $evaluations = [];
                                    foreach($jeux AS $jeu){
                                        $nb_evals = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id]])->count();
                                        $note = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id]])->avg('note');
                                        $evaluations[$jeu->id] = ["nom_equipe"=>$jeu->nom_equipe, "etablissement_id"=>$jeu->etablissement_id, "etablissement_jeton"=>$jeu->etablissement_jeton, "python_id"=>$jeu->python_id, "nb_evals"=>$nb_evals, "note"=>$note,"documentation"=>$jeu->documentation];
                                    }
                                    uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                    $evaluations = array_reverse($evaluations, TRUE);
                                    ?>

                                    @foreach($evaluations AS $id => $evaluation)

                                        <div class="col mb-4">
                                            <div class="card h-100 p-3" @if(($loop->iteration <= 8) AND $evaluation['note'] != 0) style="background-color:#ffc905;border-radius:5px;" @endif>

                                                <div class="card-body p-0">
                                                    <h3 class="mt-0" style="@if(in_array($id, $excluded_games)) text-decoration: line-through; @endif color:#4cbf56">@if(($loop->iteration <= 8) AND $evaluation['note'] != 0)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif {{ $evaluation['nom_equipe'] }}</h3>

                                                    <?php
                                                    $etablissement = App\Models\User::where('id', $evaluation['etablissement_id'])->first();
                                                    ?>
                                                    <div class="text-monospace text-muted small" style="font-size:70%;color:silver;">
                                                        [{{$id}}] {{$etablissement->etablissement}} - {{$etablissement->ville}} - {{$etablissement->pays}} - {{$etablissement->email}}<br />{{$etablissement->ac_zone}}
                                                    </div>
                                                    @if($evaluation['documentation'] == NULL)
                                                        <span class="text-danger text-monospace">pas d'instructions</span>
                                                    @endif
                                                </div>

                                                <div class="card-footer mt-2">
                                                    <div class="text-center">
                                                        <a href="/console/jouer-jeu-pyxel/{{$evaluation['etablissement_jeton'].'-'.$evaluation['python_id']}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
                                                    </div>
                                                    <div class="mt-2 mb-1 text-monospace small">
                                                        <div>Nb d'évaluations: <span class="text-primary font-weight-bold">{{ $evaluation['nb_evals'] }}</span></div>
                                                    </div>
                                                    <div class="text-center">
                                                        <kbd class="text-center" style="display:block;">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],2) }} @else - @endif</span></kbd>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <?php
                            }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
