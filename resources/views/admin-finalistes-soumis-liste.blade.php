<?php
if (Auth::user()->is_admin != 1) {
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>ADMIN | LISTE FINALISTES</title>
    <style>
        .popover {
            width: 700px;
            max-width: 700px;
        }    
    </style>
</head>
<body>

    @include('inc-nav-console')
    @include('inc-fonctions')

	<div class="container mt-3 mb-5">
		<div class="row">

            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm mb-4" href="{{ url()->previous() }}" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

			<div class="col-md-10">

                <h1 class="mb-0">LISTE FINALISTES</h1>
                
                <h2>SCRATCH</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                <?php
                $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                foreach ($categories AS $categorie_code => $categorie){
                    $jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
                    ->where([
                        ['users.fin_evaluations', '=', 1],  
                        ['games.type', 'ndc'], 
                        ['games.categorie', $categorie], 
                        ['games.finaliste', 1],
                    ])
                    ->select('games.*')
                    ->get();
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
                                            <th scope="col" class="pl-1 pr-1">Nom de l'équipe</th>
                                            <th scope="col" class="pl-2 pr-2">Jeton</th>
                                            <th scope="col" class="pl-2 pr-2"><i class="fa-solid fa-shield-halved"></i></th>
                                            <th scope="col" class="pl-2 pr-2">Id</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Id<i class="ml-1 fa-solid fa-shield-halved"></i></th>
                                            <th scope="col" class="pl-2 pr-2">Date</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Date<i class="ml-1 fa-solid fa-shield-halved"></i></th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Dépot</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Δ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($jeux AS $jeu)

                                            <?php

                                            $status = '';
                                            $signature_jeton = '';
                                            $signature_date = '';
                                            $delta = '';
                                            $delta_class = '';

                                            $etablissement = App\Models\User::where('id', $jeu->etablissement_id)->first();
                                            $sb3_path = storage_path("app/public/depot-jeux/scratch/".$jeu->etablissement_jeton."/".$jeu->scratch_id.".sb3");
																						
											if ($jeu->metadata === NULL) {
												$signature_array = verifySb3Signatures($sb3_path);
												$jeu->metadata = serialize($signature_array);
												$jeu->save();
                                            } else {
                                                $signature_array = unserialize($jeu->metadata);	
                                            }

											$signature = json_decode($signature_array['first_signature_found']);
											
											if (isset($signature->id)) {
												$signature = json_decode($signature_array['first_signature_found']);
												$signature_id = $signature->id;
												$signature_jeton = $signature_id[6].$signature_id[4].$signature_id[2].$signature_id[0];
												$signature_date = $signature->date;
												$ndc_date = date('md', strtotime($etablissement->ndc_date));
												$depot_date = date('m/d H\hi', strtotime($jeu->created_at));

												// difference dates
												$date1 = DateTime::createFromFormat('YmdHi', date('Y') . $signature_date);    
												$date2 = new DateTime($jeu->created_at);
												$diffSec = abs($date2->getTimestamp() - $date1->getTimestamp());
												$hours   = floor($diffSec / 3600);
												$minutes = floor(($diffSec % 3600) / 60);
												$delta = "{$hours}h{$minutes}";
												if ($hours >= 6) {
													$delta_class = "text-danger";
												} else {
													$delta_class = "";
												}
											}
											
											// popover
											$signature_contenu = "<pre>".print_r($signature_array, true)."</pre>";
											$popover = htmlspecialchars($signature_contenu, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
											if ($etablissement->jeton == $signature_jeton AND $ndc_date == substr($signature_date, 0, 4)){
												$status_class = 'fa-solid fa-circle-check text-success';
											} else {
												$status_class = 'fa-solid fa-circle-exclamation text-danger';
											}
											$status = "<i class='".$status_class."' data-container='body' data-toggle='popover' data-html='true' data-placement='left' data-content='".$popover."'></i>";
                                            ?>

                                            <tr>
                                                <td class="w-100">{{$jeu->nom_equipe}}</td>
                                                <td class="pl-2 pr-2"><a href="https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{$jeu->etablissement_jeton}}/{{$jeu->scratch_id}}.sb3" target="_blank">{{$jeu->scratch_id}}</a></td>
                                                <td class="pl-2 pr-2">{!!$status!!}</td>
                                                <td class="pl-2 pr-2">{{$etablissement->jeton}}</td>
                                                <td class="pl-2 pr-2">{{$signature_jeton}}</td>
                                                <td class="pl-2 pr-2">{{substr($ndc_date, 0, 2)}}/{{substr($ndc_date, 2)}}</td>
                                                <td class="pl-2 pr-2" nowrap>{{substr($signature_date, 0, 2)}}/{{substr($signature_date, 2, 2)}} {{substr($signature_date, 4, 2)}}h{{substr($signature_date, 6, 2)}}</td>
                                                <td class="pl-2 pr-2" nowrap>{{$depot_date}}</td>
                                                <td class="pl-2 pr-2 {{$delta_class}}" nowrap>{{$delta}}</td>
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
                    $jeux = App\Models\Game::join('users', 'users.id', '=', 'games.etablissement_id')
                    ->where([
                        ['users.fin_evaluations', '=', 1],  
                        ['games.type', 'ndc'], 
                        ['games.categorie', $categorie], 
                        ['games.finaliste', 1],
                    ])
                    ->select('games.*')
                    ->get();
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
                                            <th scope="col" class="pl-1 pr-1">Nom de l'équipe</th>
                                            <th scope="col" class="pl-2 pr-2">Fichiers</th>
                                            <th scope="col" class="pl-2 pr-2">Jeton</th>
                                            <th scope="col" class="pl-2 pr-2"><i class="fa-solid fa-square-check"></i></th>
                                            <th scope="col" class="pl-2 pr-2">Id</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Id<i class="ml-1 fa-solid fa-shield-halved"></i></th>
                                            <th scope="col" class="pl-2 pr-2">Date</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Date<i class="ml-1 fa-solid fa-shield-halved"></i></th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Dépot</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Δ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jeux AS $jeu)

                                            <?php
                                            $etablissement = App\Models\User::where('id', $jeu->etablissement_id)->first();
                                            $dir = storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton."/".$jeu->python_id);
											
                                            $status = '';
                                            $signature_jeton = '';
                                            $signature_date = '';
                                            $delta = '';
											$delta_class = '';
											
											if ($jeu->metadata === NULL) {
												$matches = glob($dir.'/*.pyxres');
												if (isset($matches[0])){
													$pyxres_path = storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton."/".$jeu->python_id."/".basename($matches[0]));
													$signature_array = verifyPyxresSignature($pyxres_path);
												} else {
													$signature_array = ['id' => NULL, 'date' => NULL];
												}
												$jeu->metadata = base64_encode(serialize($signature_array));
												$jeu->save();
											} else {
												$signature_array = unserialize(base64_decode($jeu->metadata));
											}
																							
											if ($signature_array['id'] !== NULL){
												$signature_id = $signature_array['id'];
												$signature_jeton = $signature_id[6].$signature_id[4].$signature_id[2].$signature_id[0];
												$signature_date = substr($signature_array['date'], 0, 2) . "/" . substr($signature_array['date'], 2, 2) . " " . substr($signature_array['date'], 4, 2) . "h" . substr($signature_array['date'], 6, 2);
												
												$signature_contenu = "<pre>".print_r($signature_array, true)."</pre>";
												$ndc_date = date('md', strtotime($etablissement->ndc_date));
												if ($etablissement->jeton == $signature_jeton AND $ndc_date == substr($signature_array['date'], 0, 4)){
													$status_signature_class = 'fa-solid fa-circle-check text-success';
												}else{
													$status_signature_class = 'fa-solid fa-circle-exclamation text-danger';
												}
												$popover = htmlspecialchars($signature_contenu, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
												$status_signature = "<i class='".$status_signature_class." mr-1' data-container='body' data-toggle='popover' data-html='true' data-placement='left' data-content='".$popover."'></i>";

												$depot_date = date('m/d H\hi', strtotime($jeu->created_at));

												// difference dates
												if (DateTime::createFromFormat('mdHi', $signature_array['date'])) {
													$date1 = DateTime::createFromFormat('mdHi', $signature_array['date']); 
													$date2 = new DateTime($jeu->created_at);
													$diffSec = abs($date2->getTimestamp() - $date1->getTimestamp());
													$hours   = floor($diffSec / 3600);
													$minutes = floor(($diffSec % 3600) / 60);
													$delta = "{$hours}h{$minutes}";
													if ($hours >= 6) {
														$delta_class = "text-danger";
														$status_delta_class = 'fa-solid fa-circle-exclamation text-danger';
													} else {
														$delta_class = "";
														$status_delta_class = 'fa-solid fa-circle-check text-success';
													}
												}
												$status_delta = "<i class='".$status_delta_class." mr-1'></i>";
											}
                                            ?>

                                            <tr>
                                                <td class="w-100">{{$jeu->nom_equipe}}</td>
                                                <td class="pl-2 pr-2" nowrap>
                                                    <?php
													$status_pyxres_class = 'fa-solid fa-circle-check text-success';
                                                    $files = File::files(storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id));
                                                    foreach($files AS $file) {
                                                        echo '<kbd>'.basename($file).'</kbd> ';
														if (strpos(basename($file), 'pyxres') !== false AND basename($file) !== '1.pyxres' AND basename($file) !== '2.pyxres' AND basename($file) !== '3.pyxres' AND basename($file) !== '4.pyxres' AND basename($file) !== 'theme.pyxres') {
															$status_pyxres_class = 'fa-solid fa-circle-exclamation text-danger';
														} 
                                                    }
													$status_pyxres = "<i class='".$status_pyxres_class." mr-1'></i>";
                                                    ?>
                                                </td>
                                                <td class="pl-2 pr-2"><a href="/console/jouer-jeu-pyxel/{{$jeu->etablissement_jeton}}-{{$jeu->python_id}}" target="_blank">{{$jeu->python_id}}</a></td>
                                                <td class="pl-2 pr-2" nowrap>{!!$status_pyxres!!}{!!$status_signature!!}{!!$status_delta!!}</td>
                                                <td class="pl-2 pr-2">{{$etablissement->jeton}}</td>
                                                <td class="pl-2 pr-2">{{$signature_jeton}}</td>
                                                <td class="pl-2 pr-2">{{substr($ndc_date, 0, 2)}}/{{substr($ndc_date, 2)}}</td>
                                                <td class="pl-2 pr-2" nowrap>{{$signature_date}}</td>
                                                <td class="pl-2 pr-2" nowrap>{{$depot_date}}</td>
                                                <td class="pl-2 pr-2 {{$delta_class}}" nowrap>{{$delta}}</td>
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
<script>
    $('[data-toggle="popover"]').popover({
  container: 'body',
  html: true,
  boundary: 'window',  // ou 'window'

});
</script>

</body>
</html>
