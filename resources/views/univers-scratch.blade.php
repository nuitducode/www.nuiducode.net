<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <title>Univers de jeu Scratch</title>
</head>
<body>

	<div class="container mb-5">

        <div class="row mb-5 mt-4">
			<div class="col-md-8 offset-md-2 text-center">
                <div class=""><img src="{{ asset('img/ndc.png') }}" width="280" /></div>
                <div class="font-weight-bold text-monospace" style="font-size:21px;color:#261b0c;">UNIVERS DE JEU 2025</div>
                <div class="text-monospace text-danger font-weight-bold" style="font-size:18px">
                    SCRATCH<br /><img src="{{ asset('img/affiche/scratch.png') }}" width="35" />
                </div>
			</div>
        </div><!-- /row -->

        <div class="row mb-4">
            <div class="col-12 text-monospace text-danger" style="text-align:justify;border:1px solid #e35551;border-radius:4px;padding:15px 15px 0px 0px;">
                <ul>
                    <li class="mb-1">Les univers de jeu ainsi que les liens sont <b><u>confidentiels</u></b>. Pendant la période de la NDC (mai - juin):</li>
                    <ul>
                        <li>Les univers de jeu et les liens fournis ne doivent être partagés avec personne d'autre.</li>
                        <li>Les univers de jeu ne doivent pas être utilisés pour créer d'autres jeux.</li>
                        <li>Les jeux créés ne doivent pas être diffusés ou partagés ni publiés sur internet.</li>
                    </ul>
                    <li class="mb-1"><b>NE PAS PARTAGER VOTRE JEU SUR LE SITE DE SCRATCH</b>. Si vous avez cliqué sur «Share» par mégarde, allez dans «My Stuff» et cliquez sur «Unshare». Un contrôle automatique est fait régulièrement. Les jeux partagés sur le site de Scratch ne seront pas évalués.</li>
                    <li class="mb-1">Vous ne devez utiliser que les ressources fournies. Vous ne pouvez pas utiliser une IA, importer de ressources extérieures, utiliser du code déjà prêt, consulter de la documentation ni utiliser des notes personnelles. Par contre, vous pouvez poser des questions aux enseignants et à vos camarades des autres équipes.</li>
                    <li>Le respect des consignes fait partie de l'évaluation du jeu.</li>
                </ul>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-12 text-monospace" style="text-align:justify;border:1px solid #e35551;background-color:#e35551;color:white;border-radius:4px;padding:15px;">
                Tous les univers de jeu possèdent une signature liée à l'établissement et à la date de la NDC. Les jeux dont la signature ne sera pas validée lors des évaluations seront signalés et ne pourront pas participer à la sélection internationale.
            </div>
        </div>


        <div class="row">					
            <div class="col-md-6 offset-md-3 text-center">
                <div class="form-check">
                    <input class="form-check-input" style="cursor:pointer" type="checkbox"  onchange="document.getElementById('display_udj').disabled = !this.checked;">
                    <label class="form-check-label text-monospace small text-center pr-1 text-muted">J'ai lu attentivement les informations ci-dessus.</label>
                </div>
                <button type="submit" id="display_udj" class="btn btn-dark mt-2" onclick="document.getElementById('udj').style.display = 'block';" disabled>afficher les univers de jeu</button>
            </div>
        </div>

        <div id="udj" class="mt-5" style="display:none">  
        
            <div class="row row-cols-1 row-cols-md-3">

                <?php
                // =============
                $edition = 2025;
                // =============
                ?>

                @for ($i = 1; $i <= 6; $i++)
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img class="rounded" src="{{ asset('storage/univers/'.$edition.'/scratch/du548r2t5der3fp-'.$i.'.png') }}"  />
                            <div class="card-body text-center p-2" style="background-color:#f8fafc">
                                <form method="POST" action="{{ route('telecharger-univers') }}">
                                    @csrf
                                    <input type="hidden" name="fichier" value="{{$i}}.sb3">
                                    <input type="hidden" name="langage" value="scratch">
                                    <input type="hidden" name="edition" value="{{$edition}}">
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-arrow-down"></i><span class="pl-2 text-monospace">{{$i}}.sb3</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endfor

        </div>
		
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
