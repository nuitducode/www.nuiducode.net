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

            <a class=" btn btn-warning btn-sm btn-block text-left mt-4" href="https://github.com/nuitducode/ORGANISATION-2024/discussions" target="_blank" role="button"><i class="far fa-comment-alt pr-2"></i> discussions</a>

            <a class=" btn btn-info btn-sm btn-block text-left mt-4" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/01-presentation/" role="button" target="_blank">présentation</a>
            <a class=" btn btn-info btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/02-organisation/" role="button" target="_blank">organisation</a>
            <a class=" btn btn-info btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/" role="button" target="_blank">règles & conseils</a>
            <a class=" btn btn-info btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/03-communication-et-goodies/" role="button" target="_blank">communication & "goodies"</a>

            <a class=" btn btn-secondary btn-sm btn-block text-left mt-4" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/SCRATCH/01-introduction/" role="button" target="_blank">entrainement scratch</a>
            <a class=" btn btn-secondary btn-sm btn-block text-left" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/01-presentation/" role="button" target="_blank">entrainement python</a>

            <a class=" btn btn-light btn-sm btn-block text-left mt-4" href="/console/fiche-inscription" role="button"><i class="far fa-address-card pr-2"></i> fiche d'inscription</a>

            @if (Auth::user()->is_admin == 1)
                <a class=" btn btn-danger btn-sm text-left mt-3" href="/console/admin" role="button"><i class="fas fa-shield-alt"></i></a>
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

                <h1 class="m-0 p-0">NUIT DU CODE 2024</h1>

                <div class="mt-2 mb-3">
                    Vous avez prévu d'organiser la NDC le : <kbd><b>@php if (Auth::user()->ndc_date){echo sprintf('%02d', $jour)."/".$mois;}else{echo "?";}@endphp</b></kbd>
                </div>

                <div class="text-monospace text-secondary mb-3 small">
                    <div>Journal de la NDC 2024</div>
                    <div class="overflow-auto table-responsive" style="border:1px solid #f1f1f1;background-color:#f1f1f1;border-radius:4px;padding:10px 10px 10px 14px;height:140px">
                        <table class="table table-borderless table-sm text-secondary">

                            <tr><td><b>03/10</b></td><td style="width:100%">Ajout de la catégorie "Post-bac"</td></tr>
                            <tr><td><b>08/08</b></td><td style="width:100%">Ouverture des inscriptions  pour la NDC 2024</td></tr>
                            
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


            {{-- EN COMMENTAIRES

                <h2>JEUX & ÉVALUATIONS</h2>
                <div style="border:1px solid #dfdfdf;border-radius:4px;padding:20px;">
                    <div class="row">
                        <div class="col-12">

                            <div class="mt-0 mb-5" style="border:1px solid #e35551;border-radius:4px;padding:20px 20px 0px 20px;">
                                <div class="text-monospace text-danger small" style="text-align:justify">
                                    <b>IMPORTANT</b><br />
                                    <ul>
                                        <li class="mb-1">Les univers de jeu ainsi que les liens sont <b><u>confidentiels</u></b>. Ils ne doivent être partagés qu'avec les élèves qui participent à la NDC et qu'<u>au tout début des 6h</u> (pas plus tôt). Il est important de bien indiquer aux élèves qu'ils ne doivent s'en servir que pour créer leur jeu pendant la durée de la NDC et qu'ils ne doivent les partager avec personne d'autre, ni pendant, ni après la NDC.</li>
                                        <li class="mb-1">Pour les élèves qui utiliseront Scratch: le titre du jeu créé par une équipe doit être le nom de l'équipe. De plus, les mots suivants ne doivent pas apparaître dans le titre ni dans les champs "Instructions" et "Notes et Crédits" du jeu (ou des différentes versions du jeu): "nuit", "code", "c0de", "2023", "NdC", "ndc".</li>
                                        <li class="mb-1">Les élèves ne doivent utiliser que les ressources fournies. Ils ne peuvent pas importer de ressources extérieures, utiliser du code déjà prêt, consulter de la documentation ni utiliser des notes personnelles. Par contre, ils peuvent poser des questions aux enseignants et à leurs camarades des autres équipes.</li>
                                        <li class="mb-1">Pour Scratch et Python, les élèves doivent écrire une courte documentation (ou mode d'emploi) du jeu.</li>
                                        <li>Pour plus de détails, voir <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/04-regles-conseils/" target="_blank">"Règles et Conseils"</a> Scratch ou Python.</li>
                                    </ul>
                                </div>
                            </div>

                            <h3 id="s01" class="m-0 mb-2"><span class="badge badge-pill badge-primary pt-1">1</span> Documents pour les équipes <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="auto" title="Documents à distribuer aux équipes le jour de la NDC ou quelques jours avant."></i></sup></h3>
                            <div class="row ml-2">
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://github.com/nuitducode/ORGANISATION-2023/raw/main/documents-a-distribuer/regles-et-conseils-scratch-2023.pdf" role="button">Règles et Conseils<br /><span style="font-size:80%;color:gray">Scratch</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">à distribuer (format papier ou numérique)</div>
                                </div>
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://github.com/nuitducode/ORGANISATION-2023/raw/main/documents-a-distribuer/regles-et-conseils-python-2023.pdf" role="button">Règles et Conseils<br /><span style="font-size:80%;color:gray">Python</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">à distribuer (format papier ou numérique)</div>
                                </div>
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://github.com/nuitducode/ORGANISATION-2023/raw/main/documents-a-distribuer/documentation-pyxel-2023.pdf" role="button">Documentation Pyxel<br /><span style="font-size:80%;color:gray">Python</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">à distribuer (format papier ou numérique)</div>
                                </div>                                
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://github.com/nuitducode/ORGANISATION-2023/raw/main/documents-a-distribuer/carnet-de-bord-scratch-2023.pdf" role="button">Carnet de bord<br /><span style="font-size:80%;color:gray">Scratch</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">optionnel: à imprimer et distribuer</div>
                                </div>
                                <div class="col">
                                    <a class=" btn btn-light btn-block btn-sm" href="https://github.com/nuitducode/ORGANISATION-2023/raw/main/documents-a-distribuer/carnet-de-bord-python-2023.pdf" role="button">Carnet de bord<br /><span style="font-size:80%;color:gray">Python</span></a>
                                    <div class="text-center text-monospace mt-1" style="color:silver;font-size:70%">optionnel: à imprimer et distribuer</div>
                                </div>
                            </div>

                            <h3 id="s02" class="mt-5"><span class="badge badge-pill badge-primary pt-1">2</span> Univers de jeu</h3>
                                
                            <?php
                            /*
                            <div class="mt-1 ml-4">    
                                Quels univers de jeu souhaitez-vous recevoir pour votre Nuit du code ? <sup><i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="auto" title="Les univers de jeu seront publiés dans la console 48h avant la date indiquée. En cas de problème, écrire à contact@nuitducode.net"></i></sup>
                                <form method="POST" action="{{ route('fiche-inscription-details_post') }}" style="border:1px solid #dfdfdf;border-radius:4px;padding:10px;background-color:#f3f5f7;">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="univers_scratch">
                                                    <label class="custom-control-label" for="univers_scratch">Scratch</label>
                                                </div>
                                            </td>
                                            <td class="pl-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="univers_python">
                                                    <label class="custom-control-label" for="univers_python">Python</label>
                                                </div>
                                            </td>
                                            <td class="pl-3">
                                                <u>Date</u><br />{{$jour}}/{{$mois}}
                                            </td>
                                            <td class="pl-3">   
                                                <button type="submit" class="btn btn-primary btn-sm text-left btn-block pl-3 pr-3">
                                                    <i class="fas fa-check pt-1" style="float:left"></i>
                                                    <div class="ml-4">valider la date et les univers de jeu</div>
                                                </button>     
                                            </td>  
                                            <td class="text-monospace text-muted small pl-3">   
                                                Vous pouvez changer la date dans la section "DONNÉES". 
                                            </td>                 
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            */
                            ?>

                            <div class="ml-4 mt-1 text-monospace text-danger small" style="text-align:justify">
                                Rappel: les univers de jeu ainsi que les liens sont <b><u>confidentiels</u></b>. Ils ne doivent être partagés qu'avec les élèves qui participent à la NDC. Les élèves ne doivent les partager avec personne d'autre, ni pendant, ni après la NDC.
                            </div>
                            <div class="ml-4" style="border:1px solid #e35551;border-radius:4px;padding:20px 20px 20px 20px;background-color:white;">
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

                            <h3 id="s03" class="mt-5"><span class="badge badge-pill badge-primary pt-1">3</span> Enregistrement & Évaluation des Jeux</h3>
                            <div class="mb-1 ml-3">
                                <table style="border-collapse:separate;border-spacing:5px;">
                                    <tr>
                                        <td>
                                            <a class="btn btn-info btn-block" href="/console/ndc?p=enregistrement" role="button">enregistrement</a>
                                        </td>
                                        <td>
                                            <a class=" btn btn-info btn-block" href="/console/ndc?p=evaluation" role="button">évaluation</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="btn btn-light btn-sm btn-block pl-3 pr-3" href="/console/ndc/liste-jeux" role="button">liste des jeux enregistrés</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-light btn-sm btn-block pl-4 pr-4" href="/console/ndc/liste-evaluations" role="button">liste des évaluations</a>
                                        </td>
                                    </tr>
                                </table>                                    
                                
                            </div>

                            <h3 id="s04" class="mt-5"><span class="badge badge-pill badge-primary pt-1">4</span> Bilan des évaluations & Sélection</h3>
                            <div class="mb-1 ml-4">
                                <a class=" btn btn-info" href="/console/ndc/jeux-evaluations" role="button"><i class="fas fa-trophy"></i></a>
                            </div>

                           
                            <h3 id="finalistes" class="mt-5"><span class="badge badge-pill badge-primary pt-1">5</span> Jeux proposés pour la sélection internationale</h3>
                            <div class="ml-2 mb-1 ml-4 pl-4 pr-4 pb-3 pt-3" style="border-radius:4px;border:1px solid #dfdfdf;background-color:#f3f5f7">
                            
                                @if (Auth::user()->fin_evaluations == 0 AND date("Y-m-d") > "2023-06-04")

                                    <div class="text-monospace small text-secondary">
                                        Vous n'avez pas proposé de jeux. Fin des propositions de listes.
                                    </div>

                                @else

                                    @if (Auth::user()->fin_evaluations == 0)
                                        <div class="text-monospace small text-success">
                                            Il est recommandé de ne proposer que des jeux qui ont été évalués par au moins quatre personnes différentes et qui ont une note supérieure à 12.
                                            <br />Pour modifier cette liste, voir "4. BILAN DES ÉVALUATIONS & SÉLECTION".
                                            <br />Pour valider cette liste, cliquer sur <i class="fas fa-unlock"></i>.
                                        </div>
                                    @endif

                                    @if (App\Models\Game::where([['etablissement_id', Auth::user()->id], ['type', 'ndc'], ['finaliste', 1]])->count() != 0)

                                        <div class="p-3 pl-4 mb-3" style="border-radius:4px;@if(Auth::user()->fin_evaluations == 0) background-color:#f3f5f7 @else  background-color:#ffc905;margin-top:10px; @endif">
                                            <?php
                                            $categories = ['C3' => 'Scratch - Cycle 3', 'C4' => 'Scratch - Cycle 4', 'LY' => 'Scratch - Lycée', 'PI' => 'Python - Première', 'POO' => 'Python - Terminale'];
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
                                            <div class="text-center">
                                                <a tabindex='0' class='btn btn-primary btn-sm mt-2 pl-4 pr-4' role='button'  style="cursor:pointer;outline:none;" data-toggle="popover" data-trigger="focus" data-placement="top" data-html="true" data-content="<div class='text-center'><div class='pb-2'>Verrouiller cette liste et proposer ces jeux pour la sélection internationale.</div><a href='/console/valider-finalistes/{{ Crypt::encryptString(Auth::user()->id) }}' class='btn btn-danger btn-sm' style='color:white' role='button'>confirmer</a><a class='btn btn-light btn-sm ml-2' href='#' role='button'>annuler</a>"><i class="fas fa-unlock"></i></a>
                                            </div>
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

                            <h3 id="s06" class="mt-5"><span class="badge badge-pill badge-primary pt-1">6</span> Sélection internationale</h3>
                            <div class="mb-1 ml-4">
                                <a class="btn btn-info" href="/console/evaluation-finalistes-categories" role="button">évaluation</a>
                            </div>
 
                            <h3 id="s07" class="mt-5"><span class="badge badge-pill badge-primary pt-1">7</span> Page des jeux de l'établissement</h3>
                            <div class="mb-2 ml-4">
                                Vous pouvez sélectionner les jeux qui apparaitront sur la page <a href="/console/jeux-publics-selection">ici</a>.
                            </div>
                            <div class="mb-2 ml-4 text-monospace">
                                <i class="fa-solid fa-share-nodes mr-1"></i> <a href="/ndc2023/{{Auth::user()->jeton}}" target="_blank">www.nuitducode.net/ndc2023/{{Auth::user()->jeton}}</a>
                            </div>   
                            <div class="mb-2 ml-4 text-monospace small" style="color:silver;">
                                <?php
                                $twitter_text = urlencode(Auth::user()->etablissement.": les jeux de la Nuit du Code 2023 \n https://www.nuitducode.net/ndc2023/".Auth::user()->jeton." \n\n #NDC2023 #Scratch #Python #NSI \n @nuitducode");
                                $mastodon_text = urlencode(Auth::user()->etablissement.": les jeux de la Nuit du Code 2023 \n https://www.nuitducode.net/ndc2023/".Auth::user()->jeton." \n\n #NDC2023 #Scratch #Python #NSI \n @nuitducode@mastodon.social");
                                ?>
                                Partagez cette page sur <a href="https://mastodonshare.com/?text={{$mastodon_text}}" target="_blank">Mastodon</a> et/ou <a href="https://twitter.com/intent/tweet?text={{$twitter_text}}" target="_blank">Twitter</a>.
                            </div>                                                     

                            <h3 id="s08" class="mt-5"><span class="badge badge-pill badge-primary pt-1">8</span> Sélection internationale 2023</h3>
                            <div class="mb-2 ml-4 text-monospace">
                                <i class="fa-solid fa-share-nodes mr-1"></i> <a href="/ndc2023" target="_blank">www.nuitducode.net/ndc2023</a>
                            </div>   
                            <div class="mb-2 ml-4 text-monospace small" style="color:silver;">
                                <?php
                                $twitter_text = urlencode("Nuit du Code 2023: la sélection internationale \n https://www.nuitducode.net/ndc2023 \n\n #NDC2023 #Scratch #Python #NSI \n @nuitducode");
                                $mastodon_text = urlencode("Nuit du Code 2023: la sélection internationale \n https://www.nuitducode.net/ndc2023/ \n\n #NDC2023 #Scratch #Python #NSI \n @nuitducode@mastodon.social");
                                ?>
                                Partagez cette page sur <a href="https://mastodonshare.com/?text={{$mastodon_text}}" target="_blank">Mastodon</a> et/ou <a href="https://twitter.com/intent/tweet?text={{$twitter_text}}" target="_blank">Twitter</a>.
                            </div>  

                        </div>
                    </div>
                </div>

            --}}


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

</body>
</html>
