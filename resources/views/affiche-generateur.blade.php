@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <title>Générateur d'affiches</title>
    <style>
        body {
            line-height:1;
        }
        .infos {
            font-size:18px;
            padding:5px;
        }      
        .center {
            margin-left: auto;
            margin-right: auto;
        }   
        .categorie {
            border-radius:4px;
            background-color:#2ca05a;
            padding:4px 8px 4px 8px;
            color:white;
        }    
    </style>
</head>
<body>

    @include('inc-nav')

    <div class="container">
		<div class="row">
            <div class="col-md-9 offset-md-3">
                <h1 class="m-0">Générateur d'affiche</h1>
                <div class="mt-2 text-monospace">Utilisez les options pour créer votre affiche.</div>

            </div>
        </div>
    </div>

	<div class="container mt-4 mb-5">
		<div class="row mb-4 text-monospace">

            <div class="col-md-3">

                <div class="mb-1 font-weight-bold">OPTIONS</div>
                <div class="text-muted small mb-3" style="line-height:1.5;">Certaines zones de texte sont éditables. Cliquer pour éditer.</div>
                <div class="mb-1 font-weight-bold">Fond</div>
                <div>
                    <a href="#" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="gris clair" onclick="fond('#f8fafc')" style="display:inline-block;width:30px;height:30px;border-radius:2px;background-color:#f8fafc;color:#f8fafc;border:solid 4px #bdc3c7;">-</a>
                    <a href="#" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="blanc" onclick="fond('#ffffff')" style="display:inline-block;width:30px;height:30px;border-radius:2px;background-color:#ffffff;color:#ffffff;border:solid 4px #bdc3c7;">-</a>
                </div>

                <div class="mt-4 mb-1 font-weight-bold">Catégories</div>
                <div class="text-muted small mb-1" style="line-height:1.5;">Cliquer ci-dessous pour afficher/cacher les catégories.</div>
                <div>
                    <table>
                        <tr>
                            <td>
                                <span style="display:inline-block;border-radius:2px;background-color:#2ca05a;padding:4px;">
                                    <div class="text-center" style="width:25px">
                                        <a href="#" data-toggle="tooltip" data-trigger="hover" datadata-placement="top" title="CM1 > 6e" data-categorie-id="c1" data-categorie-statut="on" onclick="categories(this)" style="color:white"><i class="fas fa-eye"></i></a>
                                    </div>
                                </span>
                            </td>
                            <td>
                                <span style="display:inline-block;border-radius:2px;background-color:#2ca05a;padding:4px;">
                                    <div class="text-center" style="width:25px">
                                        <a href="#" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="5e > 3e" data-categorie-id="c2" data-categorie-statut="on" onclick="categories(this)" style="color:white"><i class="fas fa-eye"></i></a>
                                    </div>
                                </span>
                            </td>
                            <td>
                                <span style="display:inline-block;border-radius:2px;background-color:#2ca05a;padding:4px;">
                                    <div class="text-center" style="width:25px">
                                        <a href="#" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Lycée" data-categorie-id="c3" data-categorie-statut="on" onclick="categories(this)" style="color:white"><i class="fas fa-eye"></i></a>
                                    </div>
                                </span>
                            </td>
                            <td>
                                <span style="display:inline-block;border-radius:2px;background-color:#2ca05a;padding:4px;">
                                    <div class="text-center" style="width:25px">
                                        <a href="#" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="NSI 1re" data-categorie-id="c4" data-categorie-statut="on" onclick="categories(this)" style="color:white"><i class="fas fa-eye"></i></a>
                                    </div>
                                </span>
                            </td>
                            <td>
                                <span style="display:inline-block;border-radius:2px;background-color:#2ca05a;padding:4px;">
                                    <div class="text-center" style="width:25px">
                                        <a href="#" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="NSI Tle" data-categorie-id="c5" data-categorie-statut="on" onclick="categories(this)" style="color:white"><i class="fas fa-eye"></i></a>
                                    </div>
                                </span>
                            </td>
                        </tr>
                     </table>
                </div>

                <div class="mt-4 mb-1 font-weight-bold">Langages</div>
                    <div class="form-check">
                        <div>
                            <input class="form-check-input" type="radio" name="langage" id="c_scratch" value="scratch" onchange="langages(this)">
                            <label class="form-check-label text-monospace small" for="c_scratch" style="margin-top:6px">Scratch</label>  
                        </div>
                        <div>  
                            <input class="form-check-input" type="radio" name="langage" id="c_python" value="python" onchange="langages(this)">
                            <label class="form-check-label text-monospace small" for="c_python" style="margin-top:6px">Python</label>   
                        </div>  
                        <div>  
                            <input class="form-check-input" type="radio" name="langage" id="c_scratchpython" value="scratchpython" onchange="langages(this)" checked>
                            <label class="form-check-label text-monospace small" for="c_scratchpython" style="margin-top:6px">Scratch & Python</label>   
                        </div>                      
                    </div> 

                <div class="mt-4 mb-1 font-weight-bold">Informations</div>
                <div class="text-muted small mb-1" style="line-height:1.5;">Cliquer ci-dessous pour afficher/cacher les sections.</div>
                <div class="text-muted small mb-1" style="line-height:1.5;"></div>
                <div data-toggle="tooltip" data-trigger="hover" data-placement="right" title="date" class="text-center" style="width:25px;border-radius:2px;background-color:#2c3e50;padding:4px;margin-bottom:2px;">
                    <a href="#" data-information-id="info_3" data-information-statut="on" onclick="informations(this)" style="color:white"><i class="fas fa-eye"></i></a>
                </div>
                <div data-toggle="tooltip" data-trigger="hover" data-placement="right" title="équipes" class="text-center" style="width:25px;border-radius:2px;background-color:#2c3e50;padding:4px;margin-bottom:2px;">
                    <a href="#" data-information-id="info_2" data-information-statut="on" onclick="informations(this)" style="color:white"><i class="fas fa-eye"></i></a>
                </div>
                <div data-toggle="tooltip" data-trigger="hover" data-placement="right" title="lieu" class="text-center" style="width:25px;border-radius:2px;background-color:#2c3e50;padding:4px;margin-bottom:2px;">
                    <a href="#" data-information-id="info_4" data-information-statut="on" onclick="informations(this)" style="color:white"><i class="fas fa-eye"></i></a>
                </div>                 
                <div data-toggle="tooltip" data-trigger="hover" data-placement="right" title="inscriptions" class="text-center" style="width:25px;border-radius:2px;background-color:#2c3e50;padding:4px;margin-bottom:2px;">
                    <a href="#" data-information-id="info_5" data-information-statut="on" onclick="informations(this)" style="color:white"><i class="fas fa-eye"></i></a>
                </div>
                <div data-toggle="tooltip" data-trigger="hover" data-placement="right" title="informations supplémentaires" class="text-center" style="width:25px;border-radius:2px;background-color:#2c3e50;padding:4px;margin-bottom:2px;">
                    <a href="#" data-information-id="info_6" data-information-statut="on" onclick="informations(this)" style="color:white"><i class="fas fa-eye"></i></a>
                </div>

                <div class="mt-4 mb-1 font-weight-bold">Télécharger l'affiche</div>
                <div class="text-muted small mb-1" style="line-height:1.5;">Le PDF est prêt à être imprimé. Si vous souhaitez modifier/compléter l'affiche, téléchargez l'image et éditez-la.<br />Remarque: il faut quelques secondes pour générer l'affiche.</div>
                <div class="mt-2">
                    <a class="btn btn-primary btn-sm" href="#" role="button" onclick="telecharger_pdf()">pdf</a>
                    <a class="btn btn-primary btn-sm" href="#" role="button" onclick="telecharger_image()">image</a>
                </div>
                <div class="small mt-5" style="color:silver;line-height:1.3;">Si vous rencontrez des problèmes pour créer l'affiche, vous pouvez écrire à contact@nuitducode.net</div>
            </div>

            <div class="col-md-9">
                <div style="width:636px;height:897px;border:1px solid silver;border-radius:5px;padding:2px">
                    <div id="affiche" style="position:relative;width:630px;height:891px;">

                        <div class="text-center pt-4">
                            <img src="{{ asset('img/ndc2025.png') }}" width="280" />
				            <div class="mt-2 font-weight-bold text-monospace" style="font-size:17px;color:#261b0c;"><span class="pl-1 pr-1"contenteditable="true">6h pour coder un jeu</span></div>
				            <div class="mt-1 text-monospace font-weight-bold" style="font-size:12px;color:gray">~ 8<sup>e</sup> édition ~</div>
                            <div class="mt-4" style="font-size:14px;">
                                <span id="c1" class="categorie text-monospace">CM1 > 6<sup>e</sup></span>
                                <span id="c2" class="categorie text-monospace">5<sup>e</sup> > 3<sup>e</sup></span>
                                <span id="c3" class="categorie text-monospace">Lycée</span>
                                <span id="c4" class="categorie text-monospace">NSI 1<sup>re</sup></span>
                                <span id="c5" class="categorie text-monospace">NSI Tle</span>
                            </div>
                            <div class="pt-2">
                                <div id="scratch" style="display:none">
                                    <div class="mt-3 text-danger font-weight-bold" style="font-size:25px">SCRATCH</div>
                                    <div class="mt-1" style="font-size:30px"><img src="{{ asset('img/affiche/scratch.png') }}" width="40" /></div>
                                </div>                            
                                <div id="python" style="display:none">
                                    <div class="mt-3 text-danger font-weight-bold" style="font-size:25px">PYTHON</div>
                                    <div class="mt-1" style="font-size:30px"><img src="{{ asset('img/affiche/python.png') }}" width="40" /></div>
                                </div>                            
                                <div id="scratchpython">
                                    <div class="mt-3 text-monospace text-danger font-weight-bold" style="font-size:25px">SCRATCH <span style="color:silver;">&#8231;</span> PYTHON</div>
                                    <div class="mt-1" style="font-size:30px"><span style="margin-left:10px"><img src="{{ asset('img/affiche/scratch.png') }}" width="40" /></span><span style="margin-left:85px;"><img src="{{ asset('img/affiche/python.png') }}" width="40" /></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5 font-weight-bold" style="font-size:18px;padding-left:80px;line-height:1.3;color:#261b0c;">                            
                            <div id="info_3" class="mb-3 text-monospace" style="clear:both;">
                                <img src="{{ asset('img/affiche/calendar.png') }}" width="30" style="float:left;" />
                                <div clas="text-monospace" style="padding:5px 10px 0px 40px" contenteditable="true">20 mai 2025</div>
                            </div>
                            <div id="info_2" class="mb-3 text-monospace" style="clear:both;">
                                <img src="{{ asset('img/affiche/group.png') }}" width="30" style="float:left;" />
                                <div clas="text-monospace" style="padding:5px 10px 0px 40px" contenteditable="true">équipes de 2 ou 3</div>
                            </div>
                            <div id="info_4" class="mb-3 text-monospace" style="clear:both;">
                                <img src="{{ asset('img/affiche/pin.png') }}" width="30" style="float:left;" />
                                <div clas="text-monospace" style="padding:5px 10px 0px 40px" contenteditable="true">salle 101</div>
                            </div>
                            <div id="info_5" class="mb-3 text-monospace" style="clear:both;">
                                <img src="{{ asset('img/affiche/pen.png') }}" width="30" style="float:left;" />
                                <div clas="text-monospace" style="padding:5px 10px 0px 40px" contenteditable="true">inscriptions: ndc@domaine.net</div>
                            </div>
                            <div id="info_6" class="text-monospace" style="clear:both;">
                                <img src="{{ asset('img/affiche/search.png') }}" width="30" style="float:left;" />
                                <div clas="text-monospace" style="padding:5px 10px 0px 40px" contenteditable="true">pour plus d'informations: ndc@domaine.net</div>
                            </div>                       
                        </div>

                        <div class="text-center text-monospace font-weight-bolder" style="position:absolute;bottom:30px;color:#261b0c;width:100%;">
                            <div style="font-size:30px">
                                <img src="{{ asset('img/affiche/laptop.png') }}" width="40" />
                                <img src="{{ asset('img/affiche/pizza.png') }}" width="40" />
                                <img src="{{ asset('img/affiche/joystick.png') }}" width="40" />
                                <img src="{{ asset('img/affiche/cookie.png') }}" width="40" />
                                <img src="{{ asset('img/affiche/coding.png') }}" width="40" />
                                <img src="{{ asset('img/affiche/drink.png') }}" width="40" />
                                <img src="{{ asset('img/affiche/apple.png') }}" width="40" />
                            </div>
                            <div clas="text-monospace" style="font-size:35px;margin-top:20px;">CODEZ! <img src="{{ asset('img/affiche/flash.png') }}" width="40" /> JOUEZ!</div>
                        </div>

                    </div>
                </div>
            </div>



		</div><!-- row -->
	</div><!-- container -->

	@include('inc-bottom-js')
    <script src="{{ asset('js/html2pdf.bundle.js') }}"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
 
    <script>
        function fond(couleur) {
            document.getElementById("affiche").style.backgroundColor = couleur;
        };

        function categories(element) {
            id = element.getAttribute('data-categorie-id');
            statut = element.getAttribute('data-categorie-statut');
            if (statut == "on") {
                element.setAttribute('data-categorie-statut', 'off');
                document.getElementById(id).style.display = "none";
                element.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                element.setAttribute('data-categorie-statut', 'on');
                document.getElementById(id).style.display = "inline"; 
                element.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }

        function langages(element) {
            langage = element.value;
            console.log(langage);
            if (langage == "scratch") {
                document.getElementById("scratch").style.display = 'block';
                document.getElementById("python").style.display = 'none';
                document.getElementById("scratchpython").style.display = 'none';
            }
            if (langage == "python") {
                document.getElementById("scratch").style.display = 'none';
                document.getElementById("python").style.display = 'block';
                document.getElementById("scratchpython").style.display = 'none';
            }
            if (langage == "scratchpython") {
                document.getElementById("scratch").style.display = 'none';
                document.getElementById("python").style.display = 'none';
                document.getElementById("scratchpython").style.display = 'block';
            }                       
        }

        function informations(element) {
            id = element.getAttribute('data-information-id');
            statut = element.getAttribute('data-information-statut');
            if (statut == "on") {
                element.setAttribute('data-information-statut', 'off');
                document.getElementById(id).style.display = "none";
                element.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                element.setAttribute('data-information-statut', 'on');
                document.getElementById(id).style.display = "block"; 
                element.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }  
        
        function telecharger_pdf() {
            var element = document.getElementById('affiche');
            var opt = {
            margin:       0,
            filename:     'affiche_nuit-du-code_2023.pdf',
            image:        { type: 'png' },
            html2canvas:  { scale: 4 },
            jsPDF:        { unit: 'px', format: 'a3', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }

        function telecharger_image() {
            var element = document.getElementById('affiche');
            var opt = {
                scale: 8
            };
            html2canvas(element, opt).then(canvas => {
                canvas.toBlob(function(blob) {
                    window.saveAs(blob, 'affiche_nuit-du-code_2023.png');
                    });
            });
        }        
            
    </script>

</body>
</html>
