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

                <h1 class="mb-0">JEUX V1</h1>
                
                <h2>SCRATCH</h2>
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                <?php
                $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                foreach ($categories AS $categorie_code => $categorie){
                    $jeux = App\Models\Game::where([['type', 'ndc'], ['categorie', $categorie_code]])->get();
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jeux AS $jeu)

                                            <?php
                                            $etablissement = App\Models\User::where('id', $jeu->etablissement_id)->first();
                                            $sb3_path = storage_path("app/public/depot-jeux/scratch/".$jeu->etablissement_jeton."/".$jeu->scratch_id.".sb3");
                                            $signature_array = verifySb3Signatures($sb3_path);
                                            $signature = json_decode($signature_array['first_signature_found']);
                                            $signature_id = $signature->id;
                                            $signature_jeton = $signature_id[6].$signature_id[4].$signature_id[2].$signature_id[0];
                                            $signature_date = $signature->date;
                                            $signature_contenu = "<pre>".print_r($signature_array, true)."</pre>";
                                            $ndc_date = date('md', strtotime($etablissement->ndc_date));
                                            if ($etablissement->jeton == $signature_jeton AND $ndc_date == date('md', strtotime($signature_date))){
                                                $status_class = 'fa-solid fa-circle-check text-success';
                                            }else{
                                                $status_class = 'fa-solid fa-circle-exclamation text-danger';
                                            }
                                            $popover = htmlspecialchars($signature_contenu, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                                            $status = "<i class='".$status_class."' data-container='body' data-toggle='popover' data-html='true' data-placement='left' data-content='".$popover."'></i>";
                                            ?>

                                            <tr>
                                                <td class="w-100">{{$jeu->nom_equipe}}</td>
                                                <td class="pl-2 pr-2"><a href="https://nuitducode.github.io/ndc-lecteur-scratch/embed.html?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{$jeu->etablissement_jeton}}/{{$jeu->scratch_id}}.sb3" target="_blank">{{$jeu->scratch_id}}</a></td>
                                                <td class="pl-2 pr-2">{!!$status!!}</td>
                                                <td class="pl-2 pr-2">{{$etablissement->jeton}}</td>
                                                <td class="pl-2 pr-2">{{$signature_jeton}}</td>
                                                <td class="pl-2 pr-2">{{$ndc_date}}</td>
                                                <td class="pl-2 pr-2">{{$signature_date}}</td>
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
                    $jeux = App\Models\Game::where([['type', 'ndc'], ['categorie', $categorie_code]])->get();
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
                                            <th scope="col" class="pl-2 pr-2"><i class="fa-solid fa-shield-halved"></i></th>
                                            <th scope="col" class="pl-2 pr-2">Id</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Id<i class="ml-1 fa-solid fa-shield-halved"></i></th>
                                            <th scope="col" class="pl-2 pr-2">Date</th>
                                            <th scope="col" class="pl-2 pr-2" nowrap>Date<i class="ml-1 fa-solid fa-shield-halved"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jeux AS $jeu)

                                            <?php
                                            $etablissement = App\Models\User::where('id', $jeu->etablissement_id)->first();
                                            $dir = storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton."/".$jeu->python_id);
                                            $pattern = $dir.'/*.pyxres';
                                            $matches = glob($dir.'/*.pyxres');
                                            $pyxres_path = storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton."/".$jeu->python_id."/".basename($matches[0]));
                                            $signature_array = verifyPyxresSignature($pyxres_path);
                                            $signature_id = $signature_array['id'];
                                            $signature_jeton = $signature_id[6].$signature_id[4].$signature_id[2].$signature_id[0];
                                            $signature_date = $signature_array['date'];
                                            
                                            $signature_contenu = "<pre>".print_r($signature_array, true)."</pre>";
                                            $ndc_date = date('md', strtotime($etablissement->ndc_date));
                                            if ($etablissement->jeton == $signature_jeton AND $ndc_date == date('md', strtotime($signature_date))){
                                                $status_class = 'fa-solid fa-circle-check text-success';
                                            }else{
                                                $status_class = 'fa-solid fa-circle-exclamation text-danger';
                                            }
                                            $popover = htmlspecialchars($signature_contenu, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                                            $status = "<i class='".$status_class."' data-container='body' data-toggle='popover' data-html='true' data-placement='left' data-content='".$popover."'></i>";
                                            ?>

                                            <tr>
                                                <td class="w-100">{{$jeu->nom_equipe}}</td>
                                                <td class="pl-2 pr-2" nowrap>
                                                    <?php
                                                    $files = File::files(storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id));
                                                    foreach($files AS $file) {
                                                        echo '<kbd>'.basename($file).'</kbd> ';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="pl-2 pr-2"><a href="/console/jouer-jeu-pyxel/{{$jeu->etablissement_jeton}}-{{$jeu->python_id}}" target="_blank">{{$jeu->python_id}}</a></td>
                                                <td class="pl-2 pr-2">{!!$status!!}</td>
                                                <td class="pl-2 pr-2">{{$etablissement->jeton}}</td>
                                                <td class="pl-2 pr-2">{{$signature_jeton}}</td>
                                                <td class="pl-2 pr-2">{{$ndc_date}}</td>
                                                <td class="pl-2 pr-2">{{$signature_date}}</td>
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
