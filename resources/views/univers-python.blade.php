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
                <div class=""><img src="{{ asset('img/ndc2023.png') }}" width="280" /></div>
                <div class="font-weight-bold text-monospace" style="font-size:24px;color:#261b0c;">UNIVERS DE JEU</div>
                <div class="text-monospace text-danger font-weight-bold" style="font-size:18px">
                    PYTHON<br /><img src="{{ asset('img/affiche/python.png') }}" width="35" />
                </div>
			</div>
        </div><!-- /row -->

        <div class="row mb-4">
            <div class="col-12 text-monospace text-danger" style="text-align:justify;border:1px solid #e35551;border-radius:4px;padding:15px 15px 0px 0px;">
                <ul>
                    <li class="mb-1">Les univers de jeu, les thèmes ainsi que les liens sont <b><u>confidentiels</u></b>. Ils ne doivent être partagés avec personne d'autre, ni pendant, ni après la NDC.</li>
                    <li class="mb-1">Vous ne devez utiliser que les ressources fournies. Vous ne pouvez pas importer de ressources extérieures, utiliser du code déjà prêt, consulter de la documentation ni utiliser des notes personnelles. Par contre, vous pouvez poser des questions aux enseignants et à vos camarades des autres équipes.</li>
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

            <div class="row mb-4">
                <div class="col-12 text-success text-monospace">
                    Le développement du jeu peut se faire en ligne avec <a href="https://www.nuitducode.net/pyxel" target="_blank">www.nuitducode.net/pyxel</a> (version de Pyxel Studio faite pour la NDC) ou avec l'environnement de développement de votre choix.
                    <br />
                    <i class="fas fa-exclamation-circle text-danger"></i>  N'utilisez pas www.pyxelstudio.net pour la NDC!
                </div>
            </div>

            <div class="row mb-4">
                
                <div class="col-12">
                    <div class="">Vous pouvez choisir un thème ou un des cinq univers ci-dessous.</div>

                    <div class="font-weight-bold mt-4">THÈMES</div>
                    <ul>
                        <li class="mb-1">Thème 1 : "le plus gros gagne"</li>
                        <li class="mb-1">Thème 2 : "le dernier à l'écran gagne"</li>
                    </ul>
                    <div>Si vous choissiez un des deux thèmes, utilisez ce fichier vide <a href="{{ asset('univers_python/2023/theme.pyxres') }}" download>theme.pyxres</a>.</div>

                    <div class="font-weight-bold mt-5">UNIVERS</div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-3">

                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('univers_python/2023/1.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            Fichier <a href="{{ asset('univers_python/2023/1.pyxres') }}" download>1.pyxres</a>
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('univers_python/2023/2.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            Fichier <a href="{{ asset('univers_python/2023/2.pyxres') }}" download>2.pyxres</a>
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('univers_python/2023/3.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            Fichier <a href="{{ asset('univers_python/2023/3.pyxres') }}" download>3.pyxres</a>
                        </div>
                    </div>
                </div>
                
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('univers_python/2023/4.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            Fichier <a href="{{ asset('univers_python/2023/4.pyxres') }}" download>4.pyxres</a>
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('univers_python/2023/5.png') }}"  />
                        <div class="card-body text-center p-2" style="background-color:#f8fafc">
                            Fichier <a href="{{ asset('univers_python/2023/5.pyxres') }}" download>5.pyxres</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
		
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
