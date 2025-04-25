@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>{{ config('app.name', 'Laravel') }} | console</title>
</head>
<body>

    @include('inc-nav-console')

    <?php
    $etablissement_id = Auth::user()->id;
    $etablissement_jeton = Auth::user()->jeton;
    ?>

	<div class="container mt-4 mb-5">
		<div class="row">

            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="{{ url()->previous() }}" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

			<div class="col-md-10">

    			@if (session('status'))
    				<div class="text-success text-monospace text-center pb-4" role="alert">
    					{{ session('status') }}
    				</div>
    			@endif

                <h1 class="m-0 p-0">JEUX</h1>

                <div class="text-monospace text-muted small">
                    @if(request()->segment(2) == 'ndc') Nuit du Code @endif
                    @if(request()->segment(2) == 'sltn') Sélections @endif
                    @if(request()->segment(2) == 'demo') Démo @endif
                </div>

                <h2>SCRATCH</h2>
                <div class="text-monospace small text-justify mb-2">
                    Pour la sélection internationale, par défaut, dans chaque catégorie, les deux jeux qui ont les meilleures notes sont pré-sélectionnés. Mais vous pouvez modifier manuellement les jeux selectionnés en décochant/cochant les jeux. Ces jeux seront proposés pour la sélection internationale (à condition de valider la liste - voir "5. JEUX PROPOSÉS POUR LA SÉLECTION INTERNATIONALE" dans la console).
                </div>

                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                    foreach ($categories AS $categorie_code => $categorie){
                        $jeux = App\Models\Game::where([['etablissement_id', $etablissement_id], ['type', request()->segment(2)], ['categorie', $categorie_code]])->get();
                        ?>
                        <h3 class="m-0 mb-2">{{$categorie}}</h3>
                        @if(count($jeux) == 0)
                            <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                        @else
                            <div class="row row-cols-1 row-cols-md-4">

                                <?php
                                $evaluations = [];
                                $nb_finalistes[$categorie_code] = 0;
                                foreach($jeux AS $jeu) {
                                    if ($jeu->finaliste == 1) $nb_finalistes[$categorie_code]++;
                                    $nb_eval_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->count();
                                    $nb_eval_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->count();
                                    $note_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->avg('note');
                                    $note_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->avg('note');
                                    $note = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id]])->avg('note');
                                    $evaluations[$jeu->id] = ["nom_equipe"=>$jeu->nom_equipe, "finaliste"=>$jeu->finaliste, "scratch_id"=>$jeu->scratch_id, "nb_eval_eleves"=>$nb_eval_eleves, "nb_eval_enseignants"=>$nb_eval_enseignants, "note_eleves"=>$note_eleves, "note_enseignants"=>$note_enseignants, "note"=>$note];
                                }
                                uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                $evaluations = array_reverse($evaluations, TRUE);
                                ?>


                                @foreach($evaluations AS $game_id => $evaluation)

                                    <?php
                                    if (Auth::user()->fin_evaluations == 0) {
                                        if ($nb_finalistes[$categorie_code] < 2) {
                                            if(($loop->iteration == 1 OR $loop->iteration == 2) AND $evaluation['finaliste'] !=1 AND $evaluation['note'] != 0) {
                                                App\Models\Game::where('id', $game_id)->update(['finaliste' => 1]);
                                                $evaluation['finaliste'] = 1;
                                                $nb_finalistes[$categorie_code]++;
                                            }
                                        }
                                    }
                                    ?>

                                    <div class="col mb-4">

                                        <div id="{{$game_id}}" class="card p-3 h-100" @if($evaluation['finaliste'] == 1) style="background-color:#ffc905;border-radius:5px;" @else style="background-color:#f8fafc;border-radius:5px;" @endif>

                                            <div class="card-body p-0">

                                                @if(Auth::user()->fin_evaluations == 0) 
                                                <div style="position:absolute;top:5px;right:8px;">
                                                    <input type="checkbox" class="checkbox_{{$categorie_code}}" name="game_id" value="{{$game_id}}" onclick="update_finaliste(this)" @if ($evaluation['finaliste'] == 1) checked @endif>
                                                </div>
                                                @endif

                                                <h3 class="mt-0" style="color:#4cbf56">
                                                    <span id="{{$game_id}}_h3">@if($evaluation['finaliste'] == 1)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif</span> {{$evaluation['nom_equipe']}}
                                                </h3>
                                            </div>

                                            <div class="card-footer">
											
                                                <div class="text-center">
                                                    <a href="https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{$etablissement_jeton}}/{{$evaluation['scratch_id']}}.sb3" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
                                                </div>

												<div class="mt-2 text-monospace small">
													<div>Nb d'éval. élèves: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_eleves'] }}</span></div>
													<div>Nb d'éval. ens.: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_enseignants'] }}</span></div>
													<div>Note élèves: <span class="text-primary font-weight-bold">@if($evaluation['note_eleves'] != 0){{ round($evaluation['note_eleves'], 1) }} @else - @endif</span></div>
													<div>Note enseignants: <span class="text-primary font-weight-bold">@if($evaluation['note_enseignants'] != 0) {{ round($evaluation['note_enseignants'],1) }} @else - @endif</span></div>
												</div>

												<kbd class="mt-2 text-center d-block">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],1) }} @else - @endif</span></kbd>

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
                <div class="text-monospace small text-justify mb-2">
                    Pour la sélection internationale, par défaut, dans chaque catégorie, les deux jeux qui ont les meilleures notes sont pré-sélectionnés. Mais vous pouvez modifier manuellement les jeux selectionnés en décochant/cochant les jeux. Ces jeux seront proposés pour la sélection internationale (à condition de valider la liste - voir "5. JEUX PROPOSÉS POUR LA SÉLECTION INTERNATIONALE" dans la console).
                </div>
                
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['PI' => 'Première', 'POO' => 'Terminale', 'PB' => 'Post-bac'];
                    foreach ($categories AS $categorie_code => $categorie){
                        $jeux = App\Models\Game::where([['etablissement_id', $etablissement_id], ['type', request()->segment(2)], ['categorie', $categorie_code]])->get();
                        ?>
                        <h3 class="m-0 mb-2">{{$categorie}}</h3>
                        @if(count($jeux) == 0)
                            <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                        @else
                            <div class="row row-cols-1 row-cols-md-4">

                                <?php
                                $evaluations = [];
                                $nb_finalistes[$categorie_code] = 0;
                                foreach($jeux AS $jeu) {
                                    if ($jeu->finaliste == 1) $nb_finalistes[$categorie_code]++;
                                    $nb_eval_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->count();
                                    $nb_eval_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->count();
                                    $note_eleves = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'eleve']])->avg('note');
                                    $note_enseignants = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id], ['jury_type', 'enseignant']])->avg('note');
                                    $note = App\Models\Evaluation::where([['etablissement_id', $etablissement_id], ['game_id', $jeu->id]])->avg('note');
                                    $evaluations[$jeu->id] = ["nom_equipe"=>$jeu->nom_equipe, "finaliste"=>$jeu->finaliste, "python_id"=>$jeu->python_id, "nb_eval_eleves"=>$nb_eval_eleves, "nb_eval_enseignants"=>$nb_eval_enseignants, "note_eleves"=>$note_eleves, "note_enseignants"=>$note_enseignants, "note"=>$note];
                                }
                                uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                $evaluations = array_reverse($evaluations, TRUE);
                                ?>

                                @foreach($evaluations AS $game_id => $evaluation)

                                    <?php
                                    if (Auth::user()->fin_evaluations == 0) {
                                        if ($nb_finalistes[$categorie_code] < 2) {
                                            if(($loop->iteration == 1 OR $loop->iteration == 2) AND $evaluation['finaliste'] !=1 AND $evaluation['note'] != 0) {
                                                App\Models\Game::where('id', $game_id)->update(['finaliste' => 1]);
                                                $evaluation['finaliste'] = 1;
                                                $nb_finalistes[$categorie_code]++;
                                            }
                                        }
                                    }
                                    ?>

                                    <div class="col mb-4">

                                        <div id="{{$game_id}}" class="card h-100 p-3" @if($evaluation['finaliste'] == 1) style="background-color:#ffc905;border-radius:5px;" @else style="background-color:#f8fafc;border-radius:5px;" @endif>
                                            
                                            <div class="card-body p-0">

                                                @if(Auth::user()->fin_evaluations == 0) 
                                                <div style="position:absolute;top:5px;right:8px;">
                                                    <input type="checkbox" class="checkbox_{{$categorie_code}}" name="game_id" value="{{$game_id}}" onclick="update_finaliste(this)" @if ($evaluation['finaliste'] == 1) checked @endif>
                                                </div>
                                                @endif

                                                <h3 class="mt-0" style="color:#4cbf56">
                                                    <span id="{{$game_id}}_h3">@if($evaluation['finaliste'] == 1)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif</span> {{ $evaluation['nom_equipe'] }}
                                                </h3>
                                            </div>

                                            <div class="card-footer">

                                                <div class="text-center">
                                                    <a href="/console/jouer-jeu-pyxel/{{$etablissement_jeton.'-'.$evaluation['python_id']}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
                                                </div>

                                                <div class="mt-2 text-monospace small">
                                                    <div>Nb d'éval. élèves: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_eleves'] }}</span></div>
                                                    <div>Nb d'éval. ens.: <span class="text-primary font-weight-bold">{{ $evaluation['nb_eval_enseignants'] }}</span></div>
                                                    <div>Note élèves: <span class="text-primary font-weight-bold">@if($evaluation['note_eleves'] != 0){{ round($evaluation['note_eleves'], 1) }} @else - @endif</span></div>
                                                    <div>Note enseignants: <span class="text-primary font-weight-bold">@if($evaluation['note_enseignants'] != 0) {{ round($evaluation['note_enseignants'],1) }} @else - @endif</span></div>
                                                </div>

                                                <kbd class="mt-2 text-center d-block">Note globale:<span class="text-primary font-weight-bold">@if($evaluation['note'] != 0) {{ round($evaluation['note'],1) }} @else - @endif</span></kbd>

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
        const cats = ['C3', 'C4', 'LY', 'PI','POO'];
        const checkboxes = [];
        const checkedCount = [];
        cats.forEach((cat) => {
            checkboxes[cat] = document.querySelectorAll('.checkbox_'+cat);
            checkedCount[cat] = 0;
            for (let i = 0; i < checkboxes[cat].length; i++) {
                if (checkboxes[cat][i].checked) {
                    checkedCount[cat]++;
                }
                if (checkedCount[cat] >= 2) {
                    for (let j = 0; j < checkboxes[cat].length; j++) {
                        if (!checkboxes[cat][j].checked) {
                            checkboxes[cat][j].disabled = true;
                        }
                    }
                } else {
                    for (let j = 0; j < checkboxes[cat].length; j++) {
                        checkboxes[cat][j].disabled = false;
                    }
                }                   
                checkboxes[cat][i].addEventListener('click', function() {
                    if (this.checked) {
                        checkedCount[cat]++;
                    } else {
                        checkedCount[cat]--;
                    }
                    if (checkedCount[cat] >= 2) {
                        for (let j = 0; j < checkboxes[cat].length; j++) {
                            if (!checkboxes[cat][j].checked) {
                                checkboxes[cat][j].disabled = true;
                            }
                        }
                    } else {
                        for (let j = 0; j < checkboxes[cat].length; j++) {
                            checkboxes[cat][j].disabled = false;
                        }
                    }
                });
            }
        });
    </script>

    <script>
        function update_finaliste(e) {
            console.log(e.value);
            console.log(e.checked);
			var json = JSON.stringify({game_id:e.value, state:e.checked});
            fetch('/console/update_finaliste', {
				method: "POST",
				mode: "cors",
                headers: {"Content-Type": "application/json; charset=UTF-8", "X-CSRF-Token": "{{ csrf_token() }}"},
                body: json
            })
            .then(function(response) {
                if (response.ok) {
                    if (e.checked) {
                        document.getElementById(e.value).style.backgroundColor="#ffc905";
                        document.getElementById(e.value+'_h3').innerHTML = '<i class="fas fa-crown mr-1" style="color:#f39c12"></i>';
                    } else {
                        document.getElementById(e.value).style.backgroundColor="#f8fafc";
                        document.getElementById(e.value+'_h3').innerHTML = '';
                    }
                    console.log('Mise à jour de la base de données réussie.');
                    return response.text().then(data =>{console.log(data)});
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
