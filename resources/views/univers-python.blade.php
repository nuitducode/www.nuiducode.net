<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <title>Univers de jeu Python</title>
</head>
<body>

	<div class="container mb-5">

        <div class="row mb-5 mt-4">
			<div class="col-md-8 offset-md-2 text-center">
                <div class=""><img src="{{ asset('img/ndc.png') }}" width="280" /></div>
                <div class="font-weight-bold text-monospace" style="font-size:21px;color:#261b0c;">UNIVERS DE JEU 2025</div>
                <div class="text-monospace text-danger font-weight-bold" style="font-size:18px">
                    PYTHON<br /><img src="{{ asset('img/affiche/python.png') }}" width="35" />
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
                    <li class="mb-1">Vous ne devez utiliser que les ressources fournies. Vous ne pouvez pas utiliser une IA, importer de ressources extérieures, utiliser du code déjà prêt, consulter de la documentation ni utiliser des notes personnelles. Par contre, vous pouvez poser des questions aux enseignants et à vos camarades des autres équipes.</li>
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

            <div class="row mb-2">

                <?php
                // =============
                $edition = 2025;
                // =============
                ?>
                
                <div class="col-12">
                    

                    <div class="mt-4 mb-5 text-danger text-monospace"><i class="fa-solid fa-circle-exclamation"></i> Vous devez conserver les noms des fichiers <kbd>.pyxres</kbd>. Ils doivent être nommés <kbd>1.pyxres</kbd>, <kbd>2.pyxres</kbd>, <kbd>3.pyxres</kbd>, <kbd>4.pyxres</kbd> ou <kbd>theme.pyxres</kbd>.</div>

                    <div>Vous pouvez choisir le thème <b>ou bien</b> un des quatre univers ci-dessous.</div>

                    <div class="font-weight-bold mt-4 mb-2">THÈME</div>
                  
                    <div class="mb-1">
                        <b>"Bataille navale"</b>
                        <br />
                        L'utilisation de l'éditeur d'images n'est pas obligatoire. Vous pouvez créer votre jeu en utilisant des formes géométriques seulement.
                        <br />
                        Si vous prévoyez d'utiliser l'éditeur d'images, vous <u class="text-danger">devez</u> utiliser ce fichier vide :
                        <form method="POST" action="{{ route('telecharger-univers') }}" class="pl-1 pr-1" style="display:inline">
                                @csrf
                                <input type="hidden" name="fichier" value="theme.pyxres">
                                <input type="hidden" name="langage" value="python">
                                <input type="hidden" name="edition" value="{{$edition}}">
                                <input type="hidden" name="token" value="{{$token}}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-down"></i><span class="pl-2 text-monospace">theme.pyxres</span>
                                </button>
                        </form>
                        
                    </div>

                    <div class="font-weight-bold mt-5">UNIVERS</div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-3">

                <div class="col mb-4">
                    <div class="card h-100">
                        <img class="rounded" src="{{ asset('storage/univers/'.$edition.'/python/du548r2t5der3fp-1.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            <form method="POST" action="{{ route('telecharger-univers') }}">
                                @csrf
                                <input type="hidden" name="fichier" value="1.pyxres">
                                <input type="hidden" name="langage" value="python">
                                <input type="hidden" name="edition" value="{{$edition}}">
                                <input type="hidden" name="token" value="{{$token}}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-down"></i><span class="pl-2 text-monospace">1.pyxres</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card h-100">
                        <img class="rounded" src="{{ asset('storage/univers/'.$edition.'/python/du548r2t5der3fp-2.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            <form method="POST" action="{{ route('telecharger-univers') }}">
                                @csrf
                                <input type="hidden" name="fichier" value="2.pyxres">
                                <input type="hidden" name="langage" value="python">
                                <input type="hidden" name="edition" value="{{$edition}}">
                                <input type="hidden" name="token" value="{{$token}}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-down"></i><span class="pl-2 text-monospace">2.pyxres</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card h-100">
                        <img class="rounded" src="{{ asset('storage/univers/'.$edition.'/python/du548r2t5der3fp-3.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            <form method="POST" action="{{ route('telecharger-univers') }}">
                                @csrf
                                <input type="hidden" name="fichier" value="3.pyxres">
                                <input type="hidden" name="langage" value="python">
                                <input type="hidden" name="edition" value="{{$edition}}">
                                <input type="hidden" name="token" value="{{$token}}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-down"></i><span class="pl-2 text-monospace">3.pyxres</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col mb-4">
                    <div class="card h-100">
                        <img class="rounded" src="{{ asset('storage/univers/'.$edition.'/python/du548r2t5der3fp-4.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            <form method="POST" action="{{ route('telecharger-univers') }}">
                                @csrf
                                <input type="hidden" name="fichier" value="4.pyxres">
                                <input type="hidden" name="langage" value="python">
                                <input type="hidden" name="edition" value="{{$edition}}">
                                <input type="hidden" name="token" value="{{$token}}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-down"></i><span class="pl-2 text-monospace">4.pyxres</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
		
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
