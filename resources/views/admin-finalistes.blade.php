<?php
if (Auth::user()->is_admin != 1) {
    exit;
}

function ecart_type($data) {
    // Calcul de la moyenne
    $mean = array_sum($data) / count($data);
  
    // Calcul de la somme des carrés des écarts à la moyenne
    $sumOfSquares = 0;
    foreach($data as $value) {
        $sumOfSquares += pow($value - $mean, 2);
    }
  
    // Calcul de la variance
    $variance = $sumOfSquares / count($data);
  
    // Calcul de l'écart type
    $standardDeviation = sqrt($variance);
  
    return $standardDeviation;
}

function findFarthestFromMean($values) {
    $mean = array_sum($values) / count($values);
    $maxDiff = 0;
    $farthestValue = null;

    foreach ($values as $index => $value) {
        $diff = abs($value - $mean);
        if ($diff > $maxDiff) {
            $maxDiff = $diff;
            $farthestValue = $value;
        }
    }

    return $farthestValue;
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

            <div class="col-md-1 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

            <div class="col-md-11">

                <h1 class="mb-0">ÉVALUATIONS</h1>
                <br />
                <?php
                $nb_evaluations_par_jeu = 5;

                // JEUX EXCLUS
				$excluded_games = [];
                
                $tot_nb_jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
					->whereNotIn('games.id', $excluded_games)
					->where([
						['users.fin_evaluations', '=', 1],  
						['games.type', 'ndc'], 
						['games.finaliste', 1],
						['games.removed_from_finalists', '=', 0]
					])
					->count();
					
                $nb_evals = App\Models\Evaluation_finaliste::join('games', 'games.id', '=', 'evaluation_finalistes.game_id')
					->whereNotIn('games.id', $excluded_games)
					->where([
						['evaluation_finalistes.removed', '=', 0],
						['games.removed_from_finalists', '=', 0]
					])
					->count();
				
				$tot_nb_evals = App\Models\Evaluation_finaliste::count();
				
				$nb_evaluations_en_attente = ($tot_nb_jeux*$nb_evaluations_par_jeu)-$nb_evals;
                ?>
				
				<div class="text-monospace">
					Nombre de jeux à évaluer: {{$tot_nb_jeux}}<br />
					Nombre total d'évaluations faites: {{$tot_nb_evals}}<br />
					Nombre d'évaluations en attente: {{$nb_evaluations_en_attente}}
				</div>

                <h2>SCRATCH</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                    foreach ($categories AS $categorie_code => $categorie) {

                        $jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
                        ->whereNotIn('games.id', $excluded_games)
                        ->where([
                            ['users.fin_evaluations', '=', 1],  
                            ['games.type', 'ndc'], 
                            ['games.categorie', $categorie_code], 
                            ['games.finaliste', 1],
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
                                    $nb_evals = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id],['removed', '=', 0]])->count();
                                    $note = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id],['removed', '=', 0]])->avg('note');
                                    $notes = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id],['removed', '=', 0]])->pluck('note')->toArray();
                                    $evaluations[$jeu->id] = [
										"nom_equipe"			=>$jeu->nom_equipe,
										"etablissement_id"		=>$jeu->etablissement_id,
										"etablissement_jeton"	=>$jeu->etablissement_jeton,
										"scratch_id"			=>$jeu->scratch_id,
										"nb_evals"				=>$nb_evals,
										"note"					=>$note,
										"notes"					=>$notes,
										"documentation"			=>$jeu->documentation,
										"status"				=>$jeu->removed_from_finalists
									];
                                }
                                uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                $evaluations = array_reverse($evaluations, TRUE);
                                ?>

                                @foreach($evaluations AS $id => $evaluation)
                                    <div class="col mb-4" @if($evaluation['status'] == 1) style="opacity:0.2" @endif>
                                        <div class="card h-100 p-3" @if(($loop->iteration <= 8) AND $evaluation['note'] != 0) style="background-color:#ffc905;border-radius:5px;" @endif>
										
											<div class="card-body p-0">
												<h3 class="mt-0">
													<div class="small" style="float:right;cursor:pointer;color:gray;" onclick="update_removed_from_finalists({{$id}})"><i class="fas fa-trash"></i></div>
													<div class="pr-3 text-success">
													@if(($loop->iteration <= 8) AND $evaluation['note'] != 0)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif
													{{$evaluation['nom_equipe']}}
													</div>
												</h3>

												<?php
												$etablissement = App\Models\User::where('id', $evaluation['etablissement_id'])->first();
												?>
												
												<div class="text-monospace text-muted small mb-1" style="font-size:70%;color:silver;">
													[{{$id}}] {{$etablissement->etablissement}} - {{$etablissement->ville}} - {{$etablissement->pays}} - {{$etablissement->email}}
												</div>
											</div>

											<div class="card-footer mt-2">
								
                                                <div class="text-center">
													<?php
													$jeu_data = Crypt::encryptString(serialize([
														'nom_equipe'			=> True,
														'etablissement'			=> True,
														'modele_jeu'			=> 'Game',
														'modele_etablissement'	=> 'User',
														'jeu_id'				=> $id,
														'scratch_id'			=> $evaluation['scratch_id'],
														'etablissement_jeton'	=> $evaluation['etablissement_jeton'],
														'jeu_dossier'			=> 'depot-jeux/scratch/'.$evaluation['etablissement_jeton'].'/'.$evaluation['scratch_id'].'.sb3'
													]));
													?>
													<a href="/jouer-scratch/{{$jeu_data}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
												</div>													

												<div class="mt-2 mb-1 text-monospace small">
													<div>Nb d'évaluations: <span class="text-primary font-weight-bold">{{ $evaluation['nb_evals'] }}</span></div>
												</div>
												<div class="text-center">
													<kbd class="text-center" style="display:block;">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],2) }} @else - @endif</span></kbd>
												</div>
												<div class="text-center text-monospace small text-muted">
													<?php
													$ffm = -1;
													if (sizeof($evaluation['notes']) > 0) {
														$ffm = findFarthestFromMean($evaluation['notes']);
														$ec = round(ecart_type($evaluation['notes']), 2);
														if ($ec >= 2) {
															echo '<b class="text-danger">EC: ' . $ec . '</b> - ';
														} else {
															echo '<b class="text-success">EC: ' . $ec . '</b> - ';
														}
													}
																										
													$eval_notes = App\Models\Evaluation_finaliste::where([['game_id', $id],['removed', '=', 0]])->get();
													foreach($eval_notes AS $eval_note){
														echo '<button type="button" class="btn btn-dark btn-xs mr-1 p-1" onclick="update_removed('.$eval_note->id.')">';
														if ($eval_note->note == $ffm){
															echo '<u>' . $eval_note->note .'</u>';
														} else {
															echo $eval_note->note;
														}
														echo '</button>';
													}
													
													$eval_removed_notes = App\Models\Evaluation_finaliste::where([['game_id', $id],['removed', '=', 1]])->get();
													foreach($eval_removed_notes AS $eval_removed_note){
														echo '<button type="button" class="btn btn-light btn-xs mr-1 p-1" onclick="update_removed('.$eval_removed_note->id.')">';
														echo '<s>' . $eval_removed_note->note .'</s>';
														echo '</button>';
													}
													?>
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
                    $categories = ['PI' => 'Première', 'POO' => 'Terminale', 'PB' => 'Post-bac'];
                    foreach ($categories AS $categorie_code => $categorie) {

                        $jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
                        ->whereNotIn('games.id', $excluded_games)
                        ->where([
                            ['users.fin_evaluations', '=', 1],  
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
                                    $nb_evals = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id],['removed', '=', 0]])->count();
                                    $note = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id],['removed', '=', 0]])->avg('note');
                                    $notes = App\Models\Evaluation_finaliste::where([['game_id', $jeu->id],['removed', '=', 0]])->pluck('note')->toArray();
                                    $evaluations[$jeu->id] = [
										"nom_equipe"			=>$jeu->nom_equipe,
										"etablissement_id"		=>$jeu->etablissement_id,
										"etablissement_jeton"	=>$jeu->etablissement_jeton,
										"python_id"				=>$jeu->python_id,
										"nb_evals"				=>$nb_evals,
										"note"					=>$note,
										"notes"					=>$notes,
										"documentation"			=>$jeu->documentation,
										"status"				=>$jeu->removed_from_finalists
									];
                                }					
                                uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                $evaluations = array_reverse($evaluations, TRUE);
                                ?>

                                @foreach($evaluations AS $id => $evaluation)
                                    <div class="col mb-4" @if($evaluation['status'] == 1) style="opacity:0.2" @endif>
                                        <div class="card h-100 p-3" @if(($loop->iteration <= 8) AND $evaluation['note'] != 0) style="background-color:#ffc905;border-radius:5px;" @endif>

                                            <div class="card-body p-0">

												<h3 class="mt-0">
													<div class="small" style="float:right;cursor:pointer;color:gray;" onclick="update_removed_from_finalists({{$id}})"><i class="fas fa-trash"></i></div>
													<div class="pr-3 text-success">
													@if(($loop->iteration <= 8) AND $evaluation['note'] != 0)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif
													{{$evaluation['nom_equipe']}}
													</div>
												</h3>

                                                <?php
                                                $etablissement = App\Models\User::where('id', $evaluation['etablissement_id'])->first();
                                                ?>
                                                <div class="text-monospace text-muted small" style="font-size:70%;color:silver;">
                                                    [{{$id}}] {{$etablissement->etablissement}} - {{$etablissement->ville}} - {{$etablissement->pays}} - {{$etablissement->email}}
                                                </div>
                                                @if($evaluation['documentation'] == NULL)
                                                    <span class="text-danger text-monospace">pas d'instructions</span>
                                                @endif
                                            </div>

                                            <div class="card-footer mt-2">
																								
                                                <div class="text-center">
													<?php
													$jeu_data = Crypt::encryptString(serialize([
														'nom_equipe'			=> True,
														'etablissement'			=> True,
														'modele_jeu'			=> 'Game',
														'modele_etablissement'	=> 'User',
														'jeu_id'				=> $id,
														'python_id'				=> $evaluation['python_id'],
														'etablissement_jeton'	=> $evaluation['etablissement_jeton'],
														'jeu_dossier'			=> 'depot-jeux/python/'.$evaluation['etablissement_jeton'].'/'.$evaluation['python_id']
													]));
													?>
													<a href="/jouer-pyxel/{{$jeu_data}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
												</div>												
												
                                                <div class="mt-2 mb-1 text-monospace small">
                                                    <div>Nb d'évaluations: <span class="text-primary font-weight-bold">{{ $evaluation['nb_evals'] }}</span></div>
                                                </div>
                                                <div class="text-center">
                                                    <kbd class="text-center" style="display:block;">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],2) }} @else - @endif</span></kbd>
                                                </div>
                                                <div class="text-center text-monospace small text-muted">
                                                    <?php
                                                    $ffm = -1;
                                                    if (sizeof($evaluation['notes']) > 0) {
                                                        $ffm = findFarthestFromMean($evaluation['notes']);
                                                        $ec = round(ecart_type($evaluation['notes']), 2);
                                                        if ($ec >= 2) {
                                                            echo '<b class="text-danger">EC: ' . $ec . '</b> - ';
                                                        } else {
                                                            echo '<b class="text-success">EC: ' . $ec . '</b> - ';
                                                        }
                                                    }
													$eval_notes = App\Models\Evaluation_finaliste::where([['game_id', $id],['removed', '=', 0]])->get();
													foreach($eval_notes AS $eval_note){
														echo '<button type="button" class="btn btn-dark btn-xs mr-1 p-1" onclick="update_removed('.$eval_note->id.')">';
														if ($eval_note->note == $ffm){
															echo '<u>' . $eval_note->note .'</u>';
														} else {
															echo $eval_note->note;
														}
														echo '</button>';
													}
													
													$eval_removed_notes = App\Models\Evaluation_finaliste::where([['game_id', $id],['removed', '=', 1]])->get();
													foreach($eval_removed_notes AS $eval_removed_note){
														echo '<button type="button" class="btn btn-light btn-xs mr-1 p-1" onclick="update_removed('.$eval_removed_note->id.')">';
														echo '<s>' . $eval_removed_note->note .'</s>';
														echo '</button>';
													}
													echo '<br />';
													$files = File::files(storage_path("app/public/depot-jeux/python/".$evaluation['etablissement_jeton'].'/'.$evaluation['python_id']));
													foreach($files as $file){
														echo ' ' . basename($file) . ' ';
													}
                                                    ?>
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

            </div>

        </div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')
	
    <script>
	function update_removed_from_finalists(id_game) {
		const data = new URLSearchParams();
		data.append('id_game', id_game);
		fetch('/console/update_removed_from_finalists', {
			method: "POST",
			mode: "cors",
			headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-Token': '{{ csrf_token() }}'},
			body: data.toString()
		})
		.then(function(response) {
			if (response.ok) {
				console.log('Mise à jour de la base de données réussie.');
				//return response.text().then(data =>{console.log(data)});
				window.location.reload(); // Recharger la page si la réponse est correcte
			} else {
				console.log('Erreur lors de la mise à jour de la base de données.');
				return response.text().then(data =>{console.log(data)});
			}
		})
		.catch(function(error) {
			console.log('Erreur lors de la mise à jour de la base de données : ' + error.message);
		});
	}	
	
	function update_removed(id_eval) {
		const data = new URLSearchParams();
		data.append('id_eval', id_eval);
		fetch('/console/update_removed_evaluation_finaliste', {
			method: "POST",
			mode: "cors",
			headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-Token': '{{ csrf_token() }}'},
			body: data.toString()
		})
		.then(function(response) {
			if (response.ok) {
				console.log('Mise à jour de la base de données réussie.');
				//return response.text().then(data =>{console.log(data)});
				window.location.reload(); // Recharger la page si la réponse est correcte
			} else {
				console.log('Erreur lors de la mise à jour de la base de données.');
				return response.text().then(data =>{console.log(data)});
			}
		})
		.catch(function(error) {
			console.log('Erreur lors de la mise à jour de la base de données : ' + error.message);
		});
	}
    </script>	

</body>
</html>
