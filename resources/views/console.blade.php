@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>NdC Console</title>
    <style>
    .table-sm th, .table-sm td {padding: 0 4px 0 4px;}
    </style>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-4 mb-5">
		<div class="row">

            <div class="col-md-2 mt-5 mb-5">

				<a class=" btn btn-warning btn-sm btn-block text-left mt-4" href="https://github.com/nuitducode/ORGANISATION-2025/discussions" target="_blank" role="button"><i class="far fa-comment-alt pr-2"></i> discussions</a>

				<a class=" btn btn-info btn-sm btn-block text-left mt-4" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/01-presentation/" role="button" target="_blank">présentation</a>
				<a class=" btn btn-info btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/02-organisation/" role="button" target="_blank">organisation</a>
				<a class=" btn btn-info btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/" role="button" target="_blank">règles & conseils</a>
				<a class=" btn btn-info btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/03-communication-et-goodies/" role="button" target="_blank">communication & "goodies"</a>

				<a class=" btn btn-secondary btn-sm btn-block text-left mt-4" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/SCRATCH/01-introduction/" role="button" target="_blank">entrainement scratch</a>
				<a class=" btn btn-secondary btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/01-presentation/" role="button" target="_blank">entrainement python</a>

				<a class=" btn btn-light btn-sm btn-block text-left mt-4" href="/console/fiche-inscription" role="button"><i class="far fa-address-card pr-2"></i> fiche d'inscription</a>

				@if (Auth::user()->is_admin == 1)
					<div class="mt-3 text-center">
						<a class=" btn btn-danger btn-sm text-left mt-1" href="/console/admin" role="button"><i class="fa-solid fa-list"></i></a>
						<a class=" btn btn-danger btn-sm text-left mt-1" href="/console/admin_finalistes" role="button"><i class="fa-solid fa-chart-simple"></i></a>
						<a class=" btn btn-danger btn-sm text-left mt-1" href="/console/admin_finalistes_par_territoire" role="button"><i class="fa-solid fa-earth-americas"></i></a>
						<br />
						<a class=" btn btn-danger btn-sm text-left mt-1 font-weight-bold text-monospace" href="/console/admin-liste-jeux-v1" role="button">v1</a>
						<a class=" btn btn-danger btn-sm text-left mt-1 font-weight-bold text-monospace" href="/console/admin-liste-jeux-v2" role="button">v2</a>
					</div>
				@endif

            </div>

			<div class="col-md-10">

				@if (session('status'))
					<div class="text-success text-monospace text-center pb-4" role="alert">
						{{ session('status') }}
					</div>
				@endif

                <?php
                if (Auth::user()->ndc_date){
                    $datetime = new DateTime(Auth::user()->ndc_date);
                    $jour = $datetime->format('j');
                    $mois = $datetime->format('m');
                    $heure = $datetime->format('H').':'.$datetime->format('i');
                }
                ?>                

                <h1 class="m-0 p-0">NUIT DU CODE 2025</h1>

                <div class="mt-2 mb-3">
                    Vous avez prévu d'organiser la NDC le : <kbd><b>@php if (Auth::user()->ndc_date){echo sprintf('%02d', $jour)."/".$mois;}else{echo "?";}@endphp</b></kbd>
                </div>

                <div class="text-monospace text-secondary mb-3 small">
                    <div>Journal de la NDC</div>
                    <div class="overflow-auto table-responsive" style="border:1px solid #f1f1f1;background-color:#f1f1f1;border-radius:4px;padding:10px 10px 10px 14px;height:140px">
                        <table class="table table-borderless table-sm text-secondary">

                            <tr><td><b>08/19</b></td><td style="width:100%">Ouverture des inscriptions  pour la NDC 2025</td></tr>
                            <tr><td><b>05/09</b></td><td style="width:100%">Bulletin <a href="https://github.com/nuitducode/ORGANISATION-2025/discussions/1" target="_blank">#01</a></td></tr>
                            <tr><td><b>24/02</b></td><td style="width:100%">Bulletin <a href="https://github.com/nuitducode/ORGANISATION-2025/discussions/5" target="_blank">#02</a></td></tr>
                            <tr><td><b>10/04</b></td><td style="width:100%">Bulletin <a href="https://github.com/nuitducode/ORGANISATION-2025/discussions/7" target="_blank">#03</a></td></tr>
                            
                        </table>
                    </div>
                </div>


                <?php
                $data_state = "";
                if (Auth::user()->udj_scratch == 1 OR Auth::user()->udj_python == 1) {
                    $data_state = "disabled";
                }
                ?>

                <h2 class="mb-0">DONNÉES<sup class="text-danger">*</sup></h2>
                <div class="text-danger text-monospace" style="font-size:70%">à mettre à jour au fur et à mesure que les données sont connues</div>

                <form method="POST" action="{{ route('fiche-inscription-details_post') }}" style="border:1px solid #dfdfdf;border-radius:4px;padding:20px 20px 10px 20px;background-color:#f3f5f7;">
                
                    @csrf

                    <div class="row">

                        <div class="col-md-4">

                            <h3 class="m-0">JOUR J</h3>
                            <table class="mt-1 mb-1" style="border-collapse:separate;border-spacing:5px;">
                                <tr>
                                    <td></td>
                                    <td class="text-center text-muted" style="line-height:0.6em;font-size:70%"><br />Mois</td>
                                    <td class="text-center text-muted" style="line-height:0.6em;font-size:70%"><br />Jour</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Date</td>
                                    <td class="text-center">
                                        <select id="ndc_mois" name="ndc_mois" class="form-control form-control-sm" style="width:80px;" {{$data_state}}>
                                            <option></option>
                                            <option value="04" @if(isset($mois) AND $mois == '04') selected @endif>avril</option>
                                            <option value="05" @if(isset($mois) AND $mois == '05') selected @endif>mai</option>
                                            <option value="06" @if(isset($mois) AND $mois == '06') selected @endif>juin</option>
                                        </select>
                                    </td>
                                    <td class="text-left">
                                        <select id="ndc_jour" name="ndc_jour" class="form-control form-control-sm" style="width:60px;" {{$data_state}}>
                                            <option></option>
                                            @for ($j = 1; $j <= 31; $j++)
                                            <option value="{{$j}}" @if(isset($jour) AND $jour == $j) selected @endif>{{ $j }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                            </table>

                        </div>

                        <div class="col-md-4">

                            <h3 class="m-0">SCRATCH</h3>
                            <table class="table table-borderless table-sm mt-1 mb-1" style="border-collapse:separate;border-spacing:5px;">
                                <tr>
                                    <td></td>
                                    <td class="text-center text-muted" style="line-height:1em;font-size:70%">Nombre<br />d'équipes</td>
                                    <td class="text-center text-muted" style="line-height:1em;font-size:70%">Nombre<br />d'élèves</td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" style="line-height:0.8em">Cycle 3 <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-html="true" data-placement="auto" title="CM1 > 6<sup>e</sup>"></i></sup></td>
                                    <td class="text-center"><input id="scratch_nb_equipes_c3" name="scratch_nb_equipes_c3" class="form-control form-control-sm text-center" style="display:inline;width:50px" value="{{Auth::user()->scratch_nb_equipes_c3}}" /></td>
                                    <td class="text-center"><input id="scratch_nb_eleves_c3" name="scratch_nb_eleves_c3" class="form-control form-control-sm text-center" style="display:inline;width:50px" value="{{Auth::user()->scratch_nb_eleves_c3}}" /></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" style="line-height:0.8em">Cycle 4 <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-html="true" data-placement="auto" title="5<sup>e</sup> > 3<sup>e</sup>"></i></sup></td>
                                    <td class="text-center"><input id="scratch_nb_equipes_c4" name="scratch_nb_equipes_c4" class="form-control form-control-sm text-center" style="display:inline;width:50px" value="{{Auth::user()->scratch_nb_equipes_c4}}" /></td>
                                    <td class="text-center"><input id="scratch_nb_eleves_c4" name="scratch_nb_eleves_c4" class="form-control form-control-sm text-center" style="display:inline;width:50px" value="{{Auth::user()->scratch_nb_eleves_c4}}" /></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle">Lycée</td>
                                    <td class="text-center"><input id="scratch_nb_equipes_lycee" name="scratch_nb_equipes_lycee" class="form-control form-control-sm text-center" style="display:inline;width:50px" value="{{Auth::user()->scratch_nb_equipes_lycee}}" /></td>
                                    <td class="text-center"><input id="scratch_nb_eleves_lycee" name="scratch_nb_eleves_lycee" class="form-control form-control-sm text-center" style="display:inline;width:50px" value="{{Auth::user()->scratch_nb_eleves_lycee}}" /></td>
                                </tr>
                            </table>

                        </div>

                        <div class="col-md-4">

                            <h3 class="m-0">PYTHON</h3>
                            <table class="table table-borderless table-sm mt-1 mb-1" style="border-collapse:separate;border-spacing:5px;">
                                <tr>
                                    <td></td>
                                    <td class="text-center text-muted" style="line-height:1em;font-size:70%">Nombre<br />d'équipes</td>
                                    <td class="text-center text-muted" style="line-height:1em;font-size:70%">Nombre<br />d'élèves</td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle">1<sup>re</sup> NSI <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="auto" title="Élèves de Première NSI ou élèves ayant les connaissances suffisantes en Python"></i></sup></td>
                                    <td class="text-center"><input  id="python_nb_equipes_pi" name="python_nb_equipes_pi" class="form-control form-control-sm  text-center" style="display:inline;width:50px" value="{{Auth::user()->python_nb_equipes_pi}}" /></td>
                                    <td class="text-center"><input  id="python_nb_eleves_pi" name="python_nb_eleves_pi" class="form-control form-control-sm  text-center" style="display:inline;width:50px" value="{{Auth::user()->python_nb_eleves_pi}}" /></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle">Tle NSI <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="auto" title="Élèves de Terminale NSI ou élèves ayant les connaissances suffisantes en Python"></i></sup></td>
                                    <td class="text-center"><input  id="python_nb_equipes_poo" name="python_nb_equipes_poo" class="form-control form-control-sm  text-center" style="display:inline;width:50px" value="{{Auth::user()->python_nb_equipes_poo}}" /></td>
                                    <td class="text-center"><input  id="python_nb_eleves_poo" name="python_nb_eleves_poo" class="form-control form-control-sm  text-center" style="display:inline;width:50px" value="{{Auth::user()->python_nb_eleves_poo}}" /></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle">Post-bac <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="auto" title="Universités, écoles, prépas..."></i></sup></td>
                                    <td class="text-center"><input  id="python_nb_equipes_postbac" name="python_nb_equipes_postbac" class="form-control form-control-sm text-center" style="display:inline;width:50px" value="{{Auth::user()->python_nb_equipes_postbac}}" /></td>
                                    <td class="text-center"><input  id="python_nb_eleves_postbac" name="python_nb_eleves_postbac" class="form-control form-control-sm  text-center" style="display:inline;width:50px" value="{{Auth::user()->python_nb_eleves_postbac}}" /></td>
                                </tr>                                
                            </table>

                        </div>

                    </div><!-- /row -->

                    <div class="text-center">

                        @if($errors->any())
                            <div class="text-monospace text-danger small">{{ $errors->first() }}</div>
                        @else
                            <div class="text-monospace text-danger small">&nbsp;</div>
                        @endif

                        <button type="submit" class="btn btn-primary btn-sm mt-1 pl-4 pr-4"><i class="fas fa-check"></i></button>

                        @if (Session::has('data_updated'))
                            <div class="mt-1 text-monospace text-success small fade-out">{{ Session::get('data_updated') }}</div>
                        @else
                            <div class="mt-1 text-monospace text-success small">&nbsp;</div>
                        @endif
                    </div>

                </form>

                <div class="mt-3" style="border:1px solid #dfdfdf;border-radius:4px;padding:20px;">
                    <div class="row">
                        <div class="col-12">

        
                            <!-- == 1 == -->
                            <h3 id="s01" class="m-0 mb-2"><span class="badge badge-pill badge-primary pt-1">1</span> Documents pour les équipes</h3>

                            <div class="row ml-2">
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://forge.apps.education.fr/nuit-du-code/DOCUMENTATION/-/raw/main/docs/assets/documents/regles-et-conseils-scratch.pdf" role="button">Règles et Conseils<br /><span style="font-size:80%;color:gray">Scratch</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">à distribuer (format papier ou numérique)</div>
                                </div>
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://forge.apps.education.fr/nuit-du-code/DOCUMENTATION/-/raw/main/docs/assets/documents/regles-et-conseils-python.pdf" role="button">Règles et Conseils<br /><span style="font-size:80%;color:gray">Python</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">à distribuer (format papier ou numérique)</div>
                                </div>
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://forge.apps.education.fr/nuit-du-code/DOCUMENTATION/-/raw/main/docs/assets/documents/documentation-pyxel.pdf" role="button">Documentation Pyxel<br /><span style="font-size:80%;color:gray">Python</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">à distribuer (format papier ou numérique)</div>
                                </div>                                
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://forge.apps.education.fr/nuit-du-code/DOCUMENTATION/-/raw/main/docs/assets/documents/carnet-de-bord-scratch.pdf" role="button">Carnet de bord<br /><span style="font-size:80%;color:gray">Scratch</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">optionnel: à imprimer et distribuer</div>
                                </div>
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://forge.apps.education.fr/nuit-du-code/DOCUMENTATION/-/raw/main/docs/assets/documents/carnet-de-bord-python.pdf" role="button">Carnet de bord<br /><span style="font-size:80%;color:gray">Python</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">optionnel: à imprimer et distribuer</div>
                                </div>
                            </div>

                            <div class="ml-4 mt-3">Versions en ligne: <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/#scratch" target="_blank">Scratch</a> - <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/#python-pyxel" target="_blank">Python</a></div>


                            <!-- == 2 == -->
                            <h3 id="s02" class="mt-5"><span class="badge badge-pill badge-primary pt-1">2</span> Entraînement </h3>
                            <div class="ml-4">
                                Ressources pour préparer les élèves à la  Nuit du Code:
                                <ul>
                                    <li><a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/01-presentation/" target="_blank">Scratch</a></li>
                                    <li><a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/SCRATCH/01-introduction/" target="_blank">Python</a></li>
                                </ul>
                                <div style="text-align:justify">Pour cette nouvelle édition, nous souhaitons étoffer les tutoriels Scratch et Python et proposer des séquences pédagogiques "Nuit du Code" Scratch ou Python à intégrer dans les programmes (technologie, mathématiques, SNT, NSI...). Si vous avez créé d'autres ressources ou si vous souhaitez contribuer à la création de nouvelles ressources, vous pouvez écrire à <a href="mailto:contact@nuitducode.net">contact@nuitducode.net</a>.</div>
                            </div>


                            <!-- == 2 == -->
                            <h3 id="s02" class="mt-5"><span class="badge badge-pill badge-primary pt-1">2</span> Univers de jeu</h3>

                            <div class="ml-4 mt-0 mb-3" style="border:1px solid #e35551;border-radius:4px;padding:20px 20px 0px 20px;">
                                <div class="text-monospace text-danger small" style="text-align:justify">
                                    <b>IMPORTANT</b><br />
                                    <ul>
                                        <li class="mb-1">Les univers de jeu ainsi que les liens sont <b><u>confidentiels</u></b>. Ils ne doivent être partagés qu'avec les élèves qui participent à la NDC et qu'<u>au tout début des 6h</u> (pas plus tôt). Il est important de bien indiquer aux élèves qu'ils ne doivent s'en servir que pour créer leur jeu, qu'ils ne doivent pas partager les univers de jeu avec d'autres personnes, qu'ils ne doivent pas diffuser leurs jeux ou les publier sur internet et qu'ils ne doivent pas utiliser les univers de jeu pour créer d'autres jeux pendant toute la période de la NDC (mai - juin). De plus, si vous réalisez des reportages pendant la NDC, veillez à ne pas divulguer les univers de jeu (photos, vidéos, etc.).</li>
                                        <li class="mb-1">Pour les élèves qui utiliseront Scratch: <b>NE PAS PARTAGER LE JEU SUR LE SITE DE SCRATCH</b>. Si une équipe a cliqué sur « Share » par mégarde, il faut aller dans « My Stuff » et cliquer sur « Unshare ».</li>
                                        <li class="mb-1">Les élèves ne doivent utiliser que les ressources fournies. Ils ne peuvent pas utiliser une IA, importer de ressources extérieures, utiliser du code déjà prêt, consulter de la documentation (autre que celle fournie) ni utiliser des notes personnelles. Par contre, ils peuvent poser des questions aux enseignants et à leurs camarades des autres équipes.</li>
                                        <li class="mb-1">Pour Scratch et Python, les élèves doivent écrire une courte présentation et un mode d'emploi du jeu.</li>
                                        <li>Pour plus de détails, voir <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/" target="_blank">"Règles et Conseils"</a> Scratch ou Python.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ml-4 mt-1" style="border:1px solid silver;border-radius:4px;padding:20px 20px 20px 20px;background-color:white;">
                                <div class="text-center mb-4">Lien(s) à ne fournir aux équipes qu'<u>au tout début des 6h</u></div>
                                <div>
                                    <div>
                                        <u>Scratch</u> <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="right" title="Lien vers les univers de jeu Scratch. Les équipes en prennent connaissance, les étudient et elles en choisissent un."></i></sup> : <span class="text-monospace text-success">{!!$scratch_lien!!}</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div>
                                        <u>Python / Pyxel</u> <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="right" title="Lien vers les univers de jeu Pyxel (fichiers .pyxres) et les thèmes. Les équipes en prennent connaissance, les étudient et elles choisissent un univers ou un thème."></i></sup> : <span class="text-monospace text-success">{!!$python_fichiers!!}</span>
                                    </div>
                                </div>
                            </div>


                            <!-- == 3 == -->
                            <h3 id="s03" class="mt-5"><span class="badge badge-pill badge-primary pt-1">3</span> Dépôt & évaluation des jeux</h3>
                            <div class="mb-1 ml-3">
                                <table style="border-collapse:separate;border-spacing:5px;">
                                    <tr>
                                        <td>
                                            <a class="btn btn-info btn-block" href="/console/ndc?p=enregistrement" role="button">dépôt</a>
                                        </td>
                                        <td>
                                            <a class=" btn btn-info btn-block" href="/console/ndc?p=evaluation" role="button">évaluation</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="btn btn-light btn-sm btn-block pl-3 pr-3" href="/console/ndc/liste-jeux" role="button">liste des jeux déposés</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-light btn-sm btn-block pl-4 pr-4" href="/console/ndc/liste-evaluations" role="button">liste des évaluations</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="depots_off" @if(Auth::user()->depots_status == 0) checked @endif>
                                                <label class="custom-control-label text-monospace small" style="padding-top:2px;" for="depots_off">fermer les dépôts</label>
                                            </div>
                                        </td>
                                        <td>
                                            
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="evaluations_off" @if(Auth::user()->evaluations_status == 0) checked @endif>
                                                <label class="custom-control-label text-monospace small" style="padding-top:2px;" for="evaluations_off">fermer les évaluations</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>                                    
                                
                            </div>


                            <!-- == 4 == -->
                            <h3 id="s04" class="mt-5"><span class="badge badge-pill badge-primary pt-1">4</span> Bilan des évaluations & Sélection</h3>
                            <div class="mb-1 ml-4">
                                <a class=" btn btn-info" href="/console/ndc/jeux-evaluations" role="button"><i class="fas fa-trophy"></i></a>
                            </div>


                            <!-- == 5 == -->
                            <h3 id="finalistes" class="mt-5"><span class="badge badge-pill badge-primary pt-1">5</span> Jeux proposés pour la sélection internationale</h3>
                            <div class="ml-2 mb-1 ml-4 pl-4 pr-4 pb-3 pt-3" style="border-radius:4px;border:1px solid #dfdfdf;background-color:#f3f5f7">
                            
                                @if (Auth::user()->fin_evaluations == 0 AND date("Y-m-d") > "2025-06-02")

                                    <div class="text-monospace small text-secondary">
                                        Vous n'avez pas proposé de jeux. Fin des propositions de listes.
                                    </div>

                                @else

                                    @if (Auth::user()->fin_evaluations == 0)
                                        <div class="text-monospace small text-success">
                                            Il est recommandé de ne proposer que des jeux qui ont été évalués par au moins quatre personnes différentes et qui ont une note supérieure à 12. Pour modifier cette liste, voir "4. BILAN DES ÉVALUATIONS & SÉLECTION".
                                        </div>
                                    @endif

                                    @if (App\Models\Game::where([['etablissement_id', Auth::user()->id], ['type', 'ndc'], ['finaliste', 1]])->count() != 0)

                                        <div class="p-3 pl-4 mb-3" style="border-radius:4px;@if(Auth::user()->fin_evaluations == 0) background-color:#f3f5f7 @else  background-color:#ffc905;margin-top:10px; @endif">
                                            <?php
                                            $categories = ['C3' => 'Scratch - Cycle 3', 'C4' => 'Scratch - Cycle 4', 'LY' => 'Scratch - Lycée', 'PI' => 'Python - Première', 'POO' => 'Python - Terminale', 'PB' => 'Python - Post-bac'];
                                            foreach ($categories AS $categorie_code => $categorie){
                                                $jeux_finalistes = App\Models\Game::where([['etablissement_id', Auth::user()->id], ['type', 'ndc'], ['categorie', $categorie_code], ['finaliste', 1]])->get();
                                                if($jeux_finalistes->count() != 0){
                                                    if(Auth::user()->fin_evaluations == 0 ){
                                                        echo "<h4>" . $categorie . "</h4>";
                                                    } else {
                                                        echo "<h4><i class='fas fa-crown mr-2' style='color:#f39c12'></i>" . $categorie . "</h4>";
                                                    }
                                                    echo '<ul class="mb-4">';
                                                    foreach($jeux_finalistes AS $jeu_finaliste){
                                                        $nb_eval = App\Models\Evaluation::
                                                            where([['etablissement_id', Auth::user()->id], ['game_id', $jeu_finaliste->id]])
                                                            ->where(function($query){
                                                                $query->where([['jury_type', 'eleve']]);
                                                                $query->orWhere([['jury_type', 'enseignant']]);
                                                            })->count();
                                                        $note = App\Models\Evaluation::where([['etablissement_id', Auth::user()->id], ['game_id', $jeu_finaliste->id]])->avg('note');
                                                        echo '<li class="mb-3">';
                                                        echo '<span style="color:black">'.strtoupper($jeu_finaliste->nom_equipe).'</span>';
                                                        echo '<br /><kbd class="text-center text-primary font-weight-bold">'.round($note, 1).'</kbd>';
                                                        echo '<span class="ml-2 small" style="opacity:0.5"><i class="fa-solid fa-user-check"></i> '.$nb_eval .'</span>';
                                                        echo '</li>';
                                                    }
                                                    echo '</ul>';                                        
                                                }
                                            }
                                            ?>
                                        </div>

                                        @if(Auth::user()->fin_evaluations == 0)

                                            <form method="POST" action="{{ route('valider-finalistes') }}">

                                                @csrf

                                                <div class="border rounded text-monospace p-3" style="background-color:#F8FAFC;">
                                                    <div class="text-center font-weight-bold text-success">Soummettre cette liste pour la sélection internationnale</div>

                                                    <div class="mt-2 font-weight-bold">Informations</div>
                                                    <div class="pl-3">
                                                        <div><u>Début de la NDC</u></div>
                                                        <div class="pl-3 mb-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="d1" name="debut" value="d1" class="custom-control-input">
                                                                <label class="custom-control-label" for="d1">Les univers de jeux ont été téléchargés avant le début de la NDC par l'enseignant</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="d2" name="debut" value="d2" class="custom-control-input">
                                                                <label class="custom-control-label" for="d2">Les univers de jeu ont été téléchargés par les élèves au tout début de la NDC</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="d3" name="debut" value="d3" class="custom-control-input">
                                                                <label class="custom-control-label" for="d3">Autre</label>
                                                            </div>
                                                        </div>

                                                        <div><u>Fin de la NDC</u></div>
                                                        <div class="pl-3 mb-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="f1" name="fin" value="f1" class="custom-control-input">
                                                                <label class="custom-control-label" for="f1">Les jeux ont été déposés par l'enseignant après les 6h de la NDC</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="f2" name="fin" value="f2" class="custom-control-input">
                                                                <label class="custom-control-label" for="f2">Les jeux ont été déposés par les élèves (ou l'enseigant) à la fin des 6h de la NDC (+/- quelques minutes)</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="f3" name="fin" value="f3" class="custom-control-input">
                                                                <label class="custom-control-label" for="f3">Autre</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3 font-weight-bold">Critères</div>
                                                    <ul class="mb-0">
                                                        <li>Les jeux proposés ne comportent aucun bug (ou seulement des bug mineurs qui ne nuisent pas à la jouabilité)</li>
                                                        <li>Les jeux proposés ont été créés sans aide extérieure: IA, ressources sur internet, ressources sur l'ordinateur, notes papier...</li>
                                                    </ul>

                                                    <div>Valider les points précédents en écrivant "Je confirme": <input id="confirmation" class="form-control" type="text" style="display:inline;width:120px;" /></div>

                                                    <div class="mt-2">Si vous avez des doutes sur un ou plusieurs jeux, merci de ne pas les proposer (voir "4. BILAN DES ÉVALUATIONS & SÉLECTION" pour modifier la liste).</div>

                                                    <div class="mt-2">Cliquer sur <i class="fas fa-unlock"></i> pour verouiller cette liste et proposer ces jeux pour la sélection internationale.</div>

                                                </div>

                                                <div class="text-center">
                                                    <button id="cadenas" class="btn btn-primary mt-2" style="width:60px;" type="button" data-toggle="collapse" data-target="#collapseValiderFinalistes" aria-expanded="false" aria-controls="collapseValiderFinalistes" style="cursor:not-allowed" disabled>
                                                        <i class="fas fa-unlock"></i>
                                                    </button>
                                                    <div class="collapse" id="collapseValiderFinalistes">
                                                        <button type="submit" class="mt-2 btn btn-success" style="width:60px;"><i class="fa-solid fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </form>

                                        @else
                                            <div class="text-center text-monospace small">
                                                Si vous voulez déverrouiller cette liste pour la modifier, écrire à contact@nuitducode.net
                                            </div>
                                        @endif

                                    @else
                                        <div class="mt-3 text-monospace text-danger text-center">
                                            Votre liste est vide. Voir "4. BILAN DES ÉVALUATIONS & SÉLECTION" ci-dessus.
                                        </div>
                                    @endif

                                @endif

                            </div>


                            @if (Auth::user()->is_admin == 1)
						    <div class="mt-5 text-danger text-monospace">--------------------------------- MODE ADMIN ---------------------------------</div>
						
                            
                            <!-- == 6 == -->
                            <h3 id="s06" class="mt-5"><span class="badge badge-pill badge-primary pt-1">6</span> Sélection internationale</h3>
                            <div class="mb-1 ml-4">
                                <a class="btn btn-info" href="/console/evaluation-finalistes-categories" role="button">évaluation</a>
                            </div>




                            <!-- == 7 == -->
                            <h3 id="s07" class="mt-5"><span class="badge badge-pill badge-primary pt-1">7</span> Page des jeux de l'établissement</h3>
                            <div class="mb-2 ml-4">
                                En cliquand <a href="/console/jeux-etablissement-selection">ici</a>, vous pouvez sélectionner les jeux qui apparaitront sur la page de votre établissement.
                            </div>
                            <div class="mb-2 ml-4 text-monospace">
                                <i class="fa-solid fa-share-nodes mr-1"></i> Page établissement: <a href="/ndc2025/{{Auth::user()->jeton}}" target="_blank">www.nuitducode.net/ndc2025/{{Auth::user()->jeton}}</a>
                            </div>   
                            <div class="mb-2 ml-4 text-monospace small" style="color:silver;">
                                <?php
                                $twitter_text = urlencode(Auth::user()->etablissement.": les jeux de la Nuit du Code 2025 \n ➡️ https://www.nuitducode.net/ndc2025/".Auth::user()->jeton." \n\n #NDC2025 #Scratch #Python #NSI \n @nuitducode");
                                $mastodon_text = urlencode(Auth::user()->etablissement.": les jeux de la Nuit du Code 2025 \n ➡️ https://www.nuitducode.net/ndc2025/".Auth::user()->jeton." \n\n #NDC2025 #Scratch #Python #NSI \n @nuitducode@mastodon.social");
                                ?>
                                Partagez cette page sur <a href="https://mastodonshare.com/?text={{$mastodon_text}}" target="_blank">Mastodon</a> et/ou <a href="https://twitter.com/intent/tweet?text={{$twitter_text}}" target="_blank">Twitter</a>.
                            </div>                                                     

						
                            <!-- == 8 == -->
                            <h3 id="s08" class="mt-5"><span class="badge badge-pill badge-primary pt-1">8</span> Dépôt - Jeux version 2</h3>
                            <div class="mb-1 ml-4">
								<div>Les équipes qui ont continué le developement de leur jeux après la Nuit du Code peuvent déposer ici la version finale.</div>
								<div>Conditions:</div>
								<ul class="m-0">
									<li>le jeu doit être une <u>version améliorée</u> du jeu qui a été déposé lors de la Nuit du Code</li>
									<li>le jeu <u>ne doit pas comporter de bogues</u></li>
									<li>le jeu doit <u>respecter toutes les consignes</u> de la Nuit du code (voir "<a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/" target="_blank">Règles et Conseils</a>")</li>
									<li>la <u>documentation</u> doit être <u>complète</u></li>
								</ul>
								
								<div class="mt-1 mb-3">Date limite: 6 septembre 2025</div>
								
								<div>Lien à fournir aux équipes:</div>
								<div style="display:inline-block;">
									<div style="background-color:white;border:solid 1px #e2e6ea;border-radius:3px;padding:8px 16px 8px 16px;">
										<span>
											<a id='lien_depot_jeu' href="/ndc/{{strtoupper(Auth::user()->jeton)}}/v2" class="text-monospace text-success" target="_blank">https://www.nuitducode.net/ndc/{{strtoupper(Auth::user()->jeton)}}/v2</a>
										</span>

										<div id="lien_depot_jeu_fullscreen" class="bg-white pt-4 text-center" style="display:none">
											<img src="{{ asset('img/ndc.png') }}" width="400" />
											<div class="text-monospace text-success font-weight-bold mt-4" style="font-size:2vw;">Dépôt Jeux v2</div>
											<div class="text-monospace text-dark font-weight-bold mt-5" style="font-size:5vw;">www.nuitducode.net/ndc/{{strtoupper(Auth::user()->jeton)}}/v2</div>
										</div>

										<span class="pl-3" onclick="fullscreen('lien_depot_jeu_fullscreen')" style="cursor:pointer;"><i class="fas fa-expand"></i></span>
										<span class="pl-3" onclick="copier('lien_depot_jeu')" style="cursor:pointer;"><i class="fa-regular fa-copy"></i></span>
									</div>
									<div id="lien_depot_jeu_copie_confirmation" class="text-right small text-monospace text muted">&nbsp;</div>
								</div>								
								<div>                            
                                    <a class="btn btn-light btn-sm pl-3 pr-3" href="/console/ndc/liste-jeux-v2" role="button">liste des jeux déposés</a>
								</div>
							</div>
                					
						
                            <!-- == 9 == -->
                            <h3 id="s09" class="mt-5"><span class="badge badge-pill badge-primary pt-1">9</span> Sélection internationale 2025</h3>
                            <div class="mb-2 ml-4 text-monospace">
                                <i class="fa-solid fa-share-nodes mr-1"></i> <a href="/ndc2025" target="_blank">www.nuitducode.net/ndc2025</a>
                            </div>   
                            <div class="mb-2 ml-4 text-monospace small" style="color:silver;">
                                <?php
                                $twitter_text = urlencode("Nuit du Code 2025: la sélection internationale \n ➡️ www.nuitducode.net/ndc2025 \n\n #NDC2025 #Scratch #Python #NSI #SNT \n @nuitducode");
                                $mastodon_text = urlencode("Nuit du Code 2025: la sélection internationale \n ➡️ www.nuitducode.net/ndc2025/ \n\n #NDC2025 #Scratch #Python #NSI #SNT \n @nuitducode@mastodon.social");
                                ?>
                                Partagez cette page sur <a href="https://mastodonshare.com/?text={{$mastodon_text}}" target="_blank">Mastodon</a> et/ou <a href="https://twitter.com/intent/tweet?text={{$twitter_text}}" target="_blank">Twitter</a>.
                            </div>
							
							

							<div class="mt-4 text-danger text-monospace">--------------------------------- FIN MODE ADMIN ---------------------------------</div>
                            @endif

                        </div>
                    </div>
                </div>

  


                <h2>FEUILLE DE ROUTE</h2>
                <div class="small mb-1">Voir <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/02-organisation/#feuille-de-route-ressources" target="_blank">"Feuille de route et Ressources"</a> pour plus de détails.</div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center text-monospace small p-2">
                        <span><i class="fas fa-angle-right text-danger"></i> Inscription de l'établissement</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-monospace small p-2">
                        <span><i class="fas fa-angle-right text-danger"></i> Choix de la date de l'événement (saisir cette date dans la section "JOUR J" ci-dessous)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-monospace small p-2">
                        <span><i class="fas fa-angle-right text-danger"></i> Création des équipes qui participeront à l'événement (indiquer, ci-dessous, le nombre d'équipes et d'élèves pour chaque catégories, mettre 0 pour les catégories sans participants)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-monospace small p-2">
                        <span><i class="fas fa-angle-right text-danger"></i> Entraînement des élèves</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-monospace small p-2">
                        <span><i class="fas fa-angle-right text-danger"></i> Sélection des élèves (si le nombre d'élèves intéressés est trop grand)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-monospace small p-2">
                        <span><i class="fas fa-angle-right text-danger"></i> Préparation de l'événement dans l'établissement (date, lieux, autoriations, affiches, ordinateurs, nourriture, boissons, décoration...)</span>
                    </li>
                </ul>

            </div>

        </div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const input      = document.getElementById('confirmation');
        const btn        = document.getElementById('cadenas');
        const submitList = document.getElementById('submit_liste');
        const radiosDeb  = document.querySelectorAll('input[name="debut"]');
        const radiosFin  = document.querySelectorAll('input[name="fin"]');

        // --- 1. Interdire copy/paste/cut/drop/contextmenu/ctrl+v uniquement sur #confirmation
        ['copy','paste','cut','drop','contextmenu'].forEach(evt =>
            input.addEventListener(evt, e => e.preventDefault())
        );
        input.addEventListener('keydown', e => {
            const k = e.key.toLowerCase();
            if ((e.ctrlKey||e.metaKey) && ['v','c','x'].includes(k)) e.preventDefault();
        });

        // Fonction qui vérifie toutes les conditions
        function updateButtonState() {
            const texteOk  = input.value === 'Je confirme';
            const debutOk  = Array.from(radiosDeb).some(r => r.checked);
            const finOk    = Array.from(radiosFin).some(r => r.checked);

            if (texteOk && debutOk && finOk) {
            btn.removeAttribute('disabled');
            btn.style.cursor = 'pointer';
            } else {
            btn.setAttribute('disabled', '');
            btn.style.cursor = 'not-allowed';
            }
        }

        // Écouteurs pour réagir dès qu’on tape ou qu’on change une radio
        input.addEventListener('input', updateButtonState);
        radiosDeb.forEach(r => r.addEventListener('change', updateButtonState));
        radiosFin.forEach(r => r.addEventListener('change', updateButtonState));
        });

/*
        submitList.addEventListener('click', e => {
            e.preventDefault();
            if (btn.disabled) return;

            // récupère les radios cochées
            const selDeb = document.querySelector('input[name="debut"]:checked');
            const selFin = document.querySelector('input[name="fin"]:checked');

            // vérifications de sécurité (optionnel si bouton déjà verrouillé)
            if (!selDeb || !selFin || inputConfirm.value !== 'Je confirme') {
                return;
            }

            const payload = {
                debut:        selDeb.value,
                fin:          selFin.value,
            };
            
            fetch("", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN':  token
                },
                body: JSON.stringify(payload)
            })
            .then(function(res) {
                if (!res.ok) {
                    throw new Error('HTTP ' + res.status);
                }
                return res.json();
            })
            .then(function(data) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    console.log('Succès', data);
                }
            })
            .catch(function(err) {
                console.error('Erreur envoi NDC :', err);
                // ici, vous pouvez afficher une alerte ou un toast utilisateur
            });
           

        });
         */
    </script> 

    <script>
        document.getElementById('depots_off').addEventListener('change', function() {
            const value = this.checked ? 0 : 1;
            fetch('{{ route("update-depots-status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept':       'application/json',
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ depots_status: value })
            })
            .then(response => {
                if (!response.ok) throw new Error('Erreur réseau');
                    return response.json();
                })
            .then(data => {
                //console.log('Mise à jour réussie :', data);
            })
            .catch(error => {
                console.error('Échec de la mise à jour :', error);
                this.checked = !this.checked;
            });
        });
    </script>

    <script>
        document.getElementById('evaluations_off').addEventListener('change', function() {
            const value = this.checked ? 0 : 1;
            fetch('{{ route("update-evaluations-status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept':       'application/json',
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ evaluations_status: value })
            })
            .then(response => {
                if (!response.ok) throw new Error('Erreur réseau');
                    return response.json();
                })
            .then(data => {
                //console.log('Mise à jour réussie :', data);
            })
            .catch(error => {
                console.error('Échec de la mise à jour :', error);
                this.checked = !this.checked;
            });
        });
    </script>

	<script>
	function copier(id) {
		var texte = document.getElementById(id).textContent;
		if (!navigator.clipboard) {
			// Alternative pour les navigateurs ne prenant pas en charge navigator.clipboard
			var zoneDeCopie = document.createElement("textarea");
			zoneDeCopie.value = texte;
			document.body.appendChild(zoneDeCopie);
			zoneDeCopie.select();
			document.execCommand("copy");
			document.body.removeChild(zoneDeCopie);
			return;
		}

		navigator.clipboard.writeText(texte).then(function() {
			//alert("Le texte a été copié dans le presse-papiers.");
		}, function() {
			// Gérer les erreurs éventuelles
			//alert("Impossible de copier le texte dans le presse-papiers. Veuillez le faire manuellement.");
		});
		
		var status = document.getElementById(id+'_copie_confirmation');
        status.innerText = "copié";
		
		status.style.opacity = '1';
		var fadeOutInterval = setInterval(function() {
			var opacity = parseFloat(status.style.opacity);
			if (opacity <= 0) {
				clearInterval(fadeOutInterval);
				status.innerHTML = "&nbsp;"; // Effacer le texte après l'animation
			} else {
				status.style.opacity = (opacity - 0.1).toString();
			}
		}, 150);
	}
	</script>

    <script>
        function fullscreen(id) {
            var el = document.getElementById(id);
            var isFullscreen = document.fullscreenElement || document.webkitFullscreenElement || document.msFullscreenElement || document.mozFullScreenElement;

            if (isFullscreen) {
                // Quitter le plein écran
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { /* Safari */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { /* IE11 */
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) { /* Firefox */
                    document.mozCancelFullScreen();
                }
            } else {
                // Afficher l'élément et entrer en plein écran
                el.style.display = 'block';
                if (el.requestFullscreen) {
                    el.requestFullscreen();
                } else if (el.webkitRequestFullscreen) { /* Safari */
                    el.webkitRequestFullscreen();
                } else if (el.msRequestFullscreen) { /* IE11 */
                    el.msRequestFullscreen();
                } else if (el.mozRequestFullScreen) { /* Firefox */
                    el.mozRequestFullScreen();
                }
            }
        }

        function updateFsButton() {
            if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement && !document.mozFullScreenElement) {
                // L'élément n'est plus en plein écran
                document.getElementById('lien_depot_jeu_fullscreen').style.display = 'none';
                document.getElementById('lien_evaluation_eleves_fullscreen').style.display = 'none';
                document.getElementById('lien_evaluation_enseignants_fullscreen').style.display = 'none';
            }
            console.log("État du plein écran changé");
        }

        document.addEventListener("fullscreenchange", updateFsButton, false);
        document.addEventListener("webkitfullscreenchange", updateFsButton, false);
        document.addEventListener("mozfullscreenchange", updateFsButton, false);
        document.addEventListener("MSFullscreenChange", updateFsButton, false);
    </script>

</body>
</html>
