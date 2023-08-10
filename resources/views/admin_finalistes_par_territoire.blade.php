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
                //$excluded_games = [1323,1335,866,1036,1359,855,1322,1265,1042,1390,470,1866,1865,1151,98,471,431,1220,1885,196,1484,37,24,845,1107,583,1369,1129,1372,688,1256,1869,811,195,1836,827,812,56,542,1385,1486,837,409,540,986,435,565,1908,506,146,112,562,1754,403,371,1738,594,689,1357];
                $excluded_games = [1323,1335,866,1036,1265,1322,1042,855,1359,1908,1390,565,1950,1951,1953,1798,1605,1955,562,98,837,583,1581,1866,845,1865,470,592,1274,724,688,1385,1220,37,24,1486,435,1836,827,812,1370,373,828,701,1260,1885,1837,700,1868,671,506,689,112,986,1372,1256,1845,1155,1153,409,1738,196,369,442,1379,1367,1151,1038,1129,1434,811,702,1543,1847,287,4,515,56,397,1849,1872,674,1538,372,1348,1604,1826,1088,146,691,1754];
                
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
                                        $json = @file_get_contents("https://api.scratch.mit.edu/projects/".$jeu->scratch_id);
                                        $evaluations[$jeu->id] = ["nom_equipe"=>$jeu->nom_equipe, "etablissement_id"=>$jeu->etablissement_id, "scratch_id"=>$jeu->scratch_id, "json"=>$json, "nb_evals"=>$nb_evals, "note"=>$note];
                                    }
                                    uasort($evaluations, fn($a, $b) => $a['note'] <=> $b['note']);
                                    $evaluations = array_reverse($evaluations, TRUE);
                                    ?>

                                    @foreach($evaluations AS $id => $evaluation)
                                        <div class="col mb-4">
                                            <div class="card h-100 p-3" @if(($loop->iteration <= 8) AND $evaluation['note'] != 0) style="background-color:#ffc905;border-radius:5px;" @endif>

                                                @if ($evaluation['json'] !== FALSE)

                                                    <div class="card-body p-0">
                                                        <h3 class="mt-0" style="@if(in_array($id, $excluded_games)) text-decoration: line-through; @endif color:#4cbf56">@if(($loop->iteration <= 8) AND $evaluation['note'] != 0)<i class="fas fa-crown mr-1" style="color:#f39c12"></i>@endif {{$evaluation['nom_equipe']}}</h3>

                                                        <?php
                                                        $etablissement = App\Models\User::where('id', $evaluation['etablissement_id'])->first();
                                                        ?>
                                                        <div class="text-monospace text-muted small mb-1" style="font-size:70%;color:silver;">
                                                            [{{$id}}] {{$etablissement->etablissement}} - {{$etablissement->ville}} - {{$etablissement->pays}} - {{$etablissement->email}}<br />{{$etablissement->ac_zone}}
                                                        </div>
                                                        @if(json_decode($evaluation['json'])->instructions == NULL)
                                                            <span class="text-danger text-monospace">pas d'instructions</span>
                                                        @endif
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

                                                @else

                                                    <div class="text-monospace small text-danger">Cet identifiant Scratch n'existe pas! [{{$jeu->scratch_id}}]</div>
                                                    <div class="text-monospace small text-danger">Vérifier que le jeu a bien été partagé (bouton orange "Partager", ou "Share" en anglais).</div>

                                                @endif

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
