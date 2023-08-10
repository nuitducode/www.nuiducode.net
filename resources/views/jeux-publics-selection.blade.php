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
                <a class="btn btn-light btn-sm mb-4" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

			<div class="col-md-10">

                <h1 class="m-0 p-0">JEUX</h1>

                <h2>SCRATCH</h2>
                <div class="text-monospace small text-justify mb-2">Les jeux cochés apparaîtront sur la page des jeux de l'établissement: <a href="https://www.nuitducode.net/ndc2023/{{$etablissement_jeton}}" target="_blank">www.nuitducode.net/ndc2023/{{$etablissement_jeton}}</a></div>

                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['C3' => 'Cycle 3', 'C4' => 'Cycle 4', 'LY' => 'Lycée'];
                    foreach ($categories AS $categorie_code => $categorie){
                        $jeux = App\Models\Game::where([['etablissement_id', $etablissement_id], ['type', 'ndc'], ['categorie', $categorie_code]])->get();
                        ?>
                        <h3 class="m-0 mb-2">{{$categorie}}</h3>
                        @if(count($jeux) == 0)
                            <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                        @else
                            <div class="row row-cols-1 row-cols-md-4">

                                @foreach($jeux AS $jeu)

                                    @php
                                    $json = @file_get_contents("https://api.scratch.mit.edu/projects/".$jeu->scratch_id);
                                    @endphp

                                    <div class="col mb-4">

                                        <div id="{{$jeu->id}}" class="card p-3 h-100" @if($jeu->is_public == 1) style="background-color:#38c172;border-radius:5px;" @else style="background-color:#f8fafc;border-radius:5px;" @endif>

                                            <div class="card-body p-0">

                                                <div style="position:absolute;top:5px;right:8px;">
                                                    <input type="checkbox" class="checkbox_{{$categorie_code}}" name="game_id" value="{{$jeu->id}}" onclick="update_is_public(this)" @if ($jeu->is_public == 1) checked @endif>
                                                </div>

                                                <h3 class="mt-0" style="color:#2c3e50">{{$jeu->nom_equipe}}</h3>
                                            </div>

                                            <div class="card-footer">
                                                @if ($json !== FALSE)

                                                    <div style="position:relative">
                                                        <div style="position:absolute;top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                            <a href="https://scratch.mit.edu/projects/{{$jeu->scratch_id}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
                                                        </div>
                                                        <img src="https://uploads.scratch.mit.edu/get_image/project/{{$jeu->scratch_id}}_282x218.png" class="img-fluid" style="border-radius:4px;" width="100%" />
                                                    </div>

                                                @else

                                                    <div class="text-monospace small text-danger">Cet identifiant Scratch n'existe pas! [{{$jeu->scratch_id}}]</div>
                                                    <div class="text-monospace small text-danger">Vérifier que le jeu a bien été partagé (bouton orange "Partager", ou "Share" en anglais).</div>

                                                @endif
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
                <div class="text-monospace small text-justify mb-2">Les jeux cochés apparaîtront sur la page des jeux de l'établissement: <a href="https://www.nuitducode.net/ndc2023/{{$etablissement_jeton}}" target="_blank">www.nuitducode.net/ndc2023/{{$etablissement_jeton}}</a></div>
                
                <div style="border:1px silver solid;border-radius:5px;padding:20px;background-color:white;">
                    <?php
                    $categories = ['PI' => 'Première', 'POO' => 'Terminale'];
                    foreach ($categories AS $categorie_code => $categorie){
                        $jeux = App\Models\Game::where([['etablissement_id', $etablissement_id], ['type', 'ndc'], ['categorie', $categorie_code]])->get();
                        ?>
                        <h3 class="m-0 mb-2">{{$categorie}}</h3>
                        @if(count($jeux) == 0)
                            <div class="text-monospace text-danger small mb-4">~ pas de jeux dans cette catégorie ~</div>
                        @else
                            <div class="row row-cols-1 row-cols-md-4">

                                @foreach($jeux AS $jeu)

                                    <div class="col mb-4">

                                        <div id="{{$jeu->id}}" class="card h-100 p-3" @if($jeu->is_public == 1) style="background-color:#38c172;border-radius:5px;" @else style="background-color:#f8fafc;border-radius:5px;" @endif>
                                            
                                            <div class="card-body p-0">

                                                <div style="position:absolute;top:5px;right:8px;">
                                                    <input type="checkbox" class="checkbox_{{$categorie_code}}" name="game_id" value="{{$jeu->id}}" onclick="update_is_public(this)" @if ($jeu->is_public == 1) checked @endif>
                                                </div>

                                                <h3 class="mt-0" style="color:#2c3e50">{{ $jeu->nom_equipe }}</h3>
                                            </div>

                                            <div class="card-footer">

                                                <div class="text-center">
                                                    <a href="/console/jouer-jeu-pyxel/{{$etablissement_jeton.'-'.$jeu->python_id}}" class="btn btn-success btn-sm" target="_blank" role="button"><i class="fas fa-gamepad fa-2x"></i></a>
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
        function update_is_public(e) {
            console.log(e.value);
            console.log(e.checked);
			var json = JSON.stringify({game_id:e.value, state:e.checked});
            fetch('/console/update_is_public', {
				method: "POST",
				mode: "cors",
                headers: {"Content-Type": "application/json; charset=UTF-8", "X-CSRF-Token": "{{ csrf_token() }}"},
                body: json
            })
            .then(function(response) {
                if (response.ok) {
                    if (e.checked) {
                        document.getElementById(e.value).style.backgroundColor="#38c172";
                    } else {
                        document.getElementById(e.value).style.backgroundColor="#f8fafc";
                    }
                    console.log('Mise à jour de la base de données réussie.');
                    return response.text().then(data =>{console.log(data)});
                } else {
                    console.log('Erreur lors de la mise à jour de la base de données.');
                    return response.text().then(data =>{console.log(data)});
                }
            })
            .catch(function(error) {
                console.log('Erreur: ' + error.message);
            });
        }
    </script>  

</body>
</html>
