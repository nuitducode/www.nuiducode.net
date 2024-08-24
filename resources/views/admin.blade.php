<?php
if (Auth::user()->is_admin != 1) {
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>ADMIN</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container-fluid mt-3 mb-5" style="max-width:1400px;">
		<div class="row">

            <div class="col-md-1 mt-4">
                <a class="btn btn-light btn-sm mb-3" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

			<div class="col-md-11">
                <h1 class="mb-0">ADMIN</h1>
            </div>

        </div><!-- /row -->

        <?php
        $etablissements = App\Models\User::where([['is_admin', 0], ['nb_participants', '>', 0], ['annulation', 0]])->get();
        $etablissements_sans_validation_email = App\Models\User::where([['is_admin', 0], ['nb_participants', '>', 0], ['email_verified_at', NULL], ['annulation', 0]])->get();
        $etablissements_sans_date = App\Models\User::where([['is_admin', 0], ['nb_participants', '>', 0], ['ndc_date', NULL], ['annulation', 0]])->get();
        $etablissements_avec_date = App\Models\User::where([['is_admin', 0], ['nb_participants', '>', 0], ['ndc_date', '!=', NULL], ['annulation', 0]])->orderby('ndc_date')->get();
        
		// PYTHON
        $python_nb_eleves_pi = App\Models\User::sum('python_nb_eleves_pi');
        $python_nb_eleves_poo = App\Models\User::sum('python_nb_eleves_poo');
        $python_nb_eleves_postbac = App\Models\User::sum('python_nb_eleves_postbac');
		
        $python_nb_equipes_pi = App\Models\User::sum('python_nb_equipes_pi');
        $python_nb_equipes_poo = App\Models\User::sum('python_nb_equipes_poo');
        $python_nb_equipes_postbac = App\Models\User::sum('python_nb_equipes_postbac');
		
        $python_nb_jeux_pi = App\Models\Game::where([['categorie', 'PI']])->count();
        $python_nb_jeux_poo = App\Models\Game::where([['categorie', 'POO']])->count();
        $python_nb_jeux_postbac = App\Models\Game::where([['categorie', 'POSTBAC']])->count();
		
		// SCRATCH
        $scratch_nb_eleves_c3 = App\Models\User::sum('scratch_nb_eleves_c3');
        $scratch_nb_eleves_c4 = App\Models\User::sum('scratch_nb_eleves_c4');
        $scratch_nb_eleves_lycee = App\Models\User::sum('scratch_nb_eleves_lycee');
		
        $scratch_nb_equipes_c3 = App\Models\User::sum('scratch_nb_equipes_c3');
        $scratch_nb_equipes_c4 = App\Models\User::sum('scratch_nb_equipes_c4');
        $scratch_nb_equipes_lycee = App\Models\User::sum('scratch_nb_equipes_lycee');
		
        $scratch_nb_jeux_c3 = App\Models\Game::where([['categorie', 'C3']])->count();
        $scratch_nb_jeux_c4 = App\Models\Game::where([['categorie', 'C4']])->count();
        $scratch_nb_jeux_lycee = App\Models\Game::where([['categorie', 'LY']])->count();		
        ?>
		
		
		<table class="small text-monospace text-muted">
			<tr>
				<td>
					<div class="p-3">
						<div>Nb élèves Python Première: {{$python_nb_eleves_pi}}</div>
						<div>Nb élèves Python Terminale: {{$python_nb_eleves_poo}}</div>
						<div>Nb élèves Python Postbac: {{$python_nb_eleves_postbac}}</div>
						<div>Nb élèves Python: {{$python_nb_eleves_pi + $python_nb_eleves_poo + $python_nb_eleves_postbac}}</div>
					</div>
				</td>
				<td>
					<div class="p-3">
						<div>Nb équipes Python Première: {{$python_nb_equipes_pi}}</div>
						<div>Nb équipes Python Terminale: {{$python_nb_equipes_poo}}</div>
						<div>Nb équipes Python Postbac: {{$python_nb_equipes_postbac}}</div>
						<div>Nb équipes Python: {{$python_nb_equipes_pi + $python_nb_equipes_poo + $python_nb_equipes_postbac}}</div>
					</div>
				</td>
				<td>
					<div class="p-3">
						<div>Nb jeux Python Première: {{$python_nb_jeux_pi}}</div>
						<div>Nb jeux Python Terminale: {{$python_nb_jeux_poo}}</div>
						<div>Nb jeux Python Postbac: {{$python_nb_jeux_postbac}}</div>
						<div>Nb jeux Python: {{$python_nb_jeux_pi + $python_nb_jeux_poo + $python_nb_jeux_postbac}}</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="p-3">
						<div>Nb élèves Scratch C3: {{$scratch_nb_eleves_c3}}</div>
						<div>Nb élèves Scratch C4: {{$scratch_nb_eleves_c4}}</div>
						<div>Nb élèves Scratch Lycée: {{$scratch_nb_eleves_lycee}}</div>
						<div>Nb élèves Scratch: {{$scratch_nb_eleves_c3 + $scratch_nb_eleves_c4 + $scratch_nb_eleves_lycee}}</div>
					</div>
				</td>
				<td>
					<div class="p-3">
						<div>Nb équipes Scratch C3: {{$scratch_nb_equipes_c3}}</div>
						<div>Nb équipes Scratch C4: {{$scratch_nb_equipes_c4}}</div>
						<div>Nb équipes Scratch Lycée: {{$scratch_nb_equipes_lycee}}</div>
						<div>Nb équipes Scratch: {{$scratch_nb_equipes_c3 + $scratch_nb_equipes_c4 + $scratch_nb_equipes_lycee}}</div>
					</div>
				</td>
				<td>
					<div class="p-3">
						<div>Nb jeux Scratch C3: {{$scratch_nb_jeux_c3}}</div>
						<div>Nb jeux Scratch C4: {{$scratch_nb_jeux_c4}}</div>
						<div>Nb jeux Scratch Lycée: {{$scratch_nb_jeux_lycee}}</div>
						<div>Nb jeux Scratch: {{$scratch_nb_jeux_c3 + $scratch_nb_jeux_c4 + $scratch_nb_jeux_lycee}}</div>
					</div>
				</td>
			</tr>
		</table>

	
        <div class="row p-3">
            <div class="col-md-12 text-center small">
                    <span style="font-weight:bold;color:#d35400">{{ App\Models\User::count(); }}</span>
					<span class="text-monospace " style="color:silver"> établissements inscrits</span>
					<span class="ml-3" style="font-weight:bold;color:#d35400">{{ App\Models\User::sum('nb_participants'); }}</span>
					<span class="text-monospace " style="color:silver"> élèves</span>
					<span class="ml-3" style="font-weight:bold;color:#d35400">{{ App\Models\User::distinct()->count('ville'); }}</span>
					<span class="text-monospace " style="color:silver"> villes</span>
					<span class="ml-3" style="font-weight:bold;color:#d35400">{{ App\Models\User::distinct()->count('pays'); }}</span>
					<span class="text-monospace " style="color:silver"> pays</span>			
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <a class="" data-toggle="collapse" href="#etablissements_sans_validation_email" role="button" aria-expanded="false" aria-controls="etablissements_sans_validation_email"><i class="fas fa-plus-square"></i></a> Établissements sans validation d'email : {{$etablissements_sans_validation_email->count()}}
                <div class="p-3 mb-3 text-monospace small text-muted collapse" id="etablissements_sans_validation_email" style="background-color:white;border:1px silver solid;border-radius:4px;">
                    @php
                    foreach($etablissements_sans_validation_email AS $etablissement){
                        echo $etablissement->email . '; ';
                    }
                    @endphp
                </div>
            </div>
        </div><!-- /row -->   


        <div class="row">
            <div class="col-md-12">
                <a class="" data-toggle="collapse" href="#etablissements_sans_date" role="button" aria-expanded="false" aria-controls="etablissements_sans_date"><i class="fas fa-plus-square"></i></a> Établissements sans date: {{$etablissements_sans_date->count()}}
                <div class="p-3 text-monospace small text-muted collapse" id="etablissements_sans_date" style="background-color:white;border:1px silver solid;border-radius:4px;">
                    @php
                    foreach($etablissements_sans_date AS $etablissement){
                        echo $etablissement->email . '; ';
                    }
                    @endphp
                </div>
            </div>
        </div><!-- /row -->

        <div class="row">
            <div class="col-md-12">
                <a class="" data-toggle="collapse" href="#etablissements_avec_date" role="button" aria-expanded="false" aria-controls="etablissements_avec_date"><i class="fas fa-plus-square"></i></a> Établissements avec date: {{$etablissements_avec_date->count()}}
                <div class="col-md-12 p-3 text-monospace small text-muted collapse" id="etablissements_avec_date" style="background-color:white;border:1px silver solid;border-radius:4px;">
                    @php
                    foreach($etablissements_avec_date AS $etablissement){
                        echo $etablissement->email . '; ';
                    }
                    @endphp
                </div>
            </div>
        </div><!-- /row -->
    
        <div class="row">
            <div class="col-md-12">
                <a class="" data-toggle="collapse" href="#etablissements_inscrits" role="button" aria-expanded="false" aria-controls="etablissements_inscrits"><i class="fas fa-plus-square"></i></a> Établissements inscrits : {{$etablissements->count()}}
                <div class="col-md-12 p-3 text-monospace small text-muted collapse" id="etablissements_inscrits" style="background-color:white;border:1px silver solid;border-radius:4px;">
                    @php
                    foreach($etablissements AS $etablissement){
                        echo $etablissement->email . '; ';
                    }
                    @endphp
                </div>
            </div>
        </div><!-- /row -->


        <div class="row mt-4 mb-5">
            <div class="col-md-12"><b>Établissements avec date par date croissante</b></div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-striped table-sm text-monospace text-muted" style="font-size:75%">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>                                
                                <th scope="col">Nom</th>
                                <th scope="col"></th>
                                <th scope="col">Pays</th>
                                <th scope="col">@</th>
                                <th scope="col">Nb</th>
                                <th scope="col">Date</th>
                                <th scope="col">S-C3</th>
                                <th scope="col">S-C4</th>
                                <th scope="col">S-L</th>
                                <th scope="col">P-P</th>
                                <th scope="col">P-T</th>
                                <th scope="col">P-PB</th>
                                <th scope="col">Tot.</th>
                                <th scope="col">Diff.</th>
                                <th scope="col">Modif.</th>
                                <th scope="col">Eq. S</th>
                                <th scope="col">Eq. P</th>
                                <th scope="col">UDJ S</th>
                                <th scope="col">UDJ P</th>                                
                                <th scope="col">UDJ read</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $date = '05-02';
                            $emails = [];
							$semaine = 1;
                            ?>
                            @foreach($etablissements_avec_date AS $etablissement)
                                <?php
                                if ($date !== substr($etablissement->ndc_date,5,5) AND $emails !== []){
                                    echo '<tr class="p-0">';
									echo '<td style="background-color:white;text-align:center;"><div onclick="copier_adresses('.$semaine.')" style="cursor:pointer;"><i class="fa-regular fa-copy"></i></div></td>';
									echo '<td colspan="27" class="p-0" style="background-color:white;">';
									echo '<div id="adresses_semaine_'.$semaine.'" contentEditable="true" class="text-monospace m-0 mt-1 mb-3 p-1 pl-2" style="border-radius:3px;background-color:silver;color:white">' . trim(implode('; ',$emails),'; ') . '</div>';
									echo '</td>';
									echo '</tr>';
                                    $date = substr($etablissement->ndc_date,5,5);
                                    $emails = [];
									$semaine++;
                                }
                                $emails[] = $etablissement->email;
                                $nb_jeux = App\Models\Game::where([['etablissement_id', $etablissement->id]])->count();
                                ?>
                                <tr>
                                    <td class="text-success">{{$loop->index + 1}}</td>
                                    <td>{{$etablissement->id}}</td>
                                    <td>{{$etablissement->jeton}}</td>
                                    <td>@if($etablissement->fin_evaluations == 1) <i class="fas fa-lock"></i> @endif</td>
                                    <td class="text-center"><a href="/console/admin_notes?id={{$etablissement->id}}"><i class="fas fa-trophy" data-toggle="tooltip" data-placement="top" title="notes"></i></a></td>
                                    <td class="text-center" nowrap><a href="/console/admin-liste-jeux-par-id?id={{$etablissement->id}}"><i class="fas fa-gamepad mr-1" data-toggle="tooltip" data-placement="top" title="liste des jeux"></i>{{$nb_jeux}}</a></td>
                                    <td class="text-center"><a href="/console/admin_evaluations?id={{$etablissement->id}}"><i class="fas fa-check" data-toggle="tooltip" data-placement="top" title="liste des évaluations"></i></a></td>
                                    <td><a href="/ndc/{{$etablissement->jeton[3].'j'.$etablissement->jeton[2].'w'.$etablissement->jeton[1].'a'.$etablissement->jeton[0]}}"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="évaluation"></i></a></td>
                                    <td>{{$etablissement->prenom}} {{$etablissement->nom}}</td>
                                    <td>
                                        <i class="fas fa-question-circle text-muted" data-boundary="window" data-toggle="tooltip" data-placement="top" title="{{$etablissement->etablissement}} - {{$etablissement->ville}} - Ac./zone: {{$etablissement->ac_zone}} "></i>
                                    </td>
                                    <td>{{$etablissement->pays}}</td>
                                    <td>
										<div data-adresse="{{$etablissement->email}}" onclick="copier_adresse(this)" style="cursor:pointer;" data-boundary="window" data-toggle="tooltip" data-placement="top" title="{{$etablissement->email}}"><i class="fas fa-envelope"></i></div>
									</td>
                                    <td>{{$etablissement->nb_participants}}</td>
                                    <td class="text-primary font-weight-bold" nowrap>{{substr($etablissement->ndc_date,5,5)}}</td>
                                    <td class="text-left">
                                        <?php
                                        if ($etablissement->scratch_nb_equipes_c3 !== NULL AND $etablissement->scratch_nb_equipes_c3 !== 0 AND $etablissement->scratch_nb_eleves_c3/$etablissement->scratch_nb_equipes_c3 > 3){
                                            echo '<span style="color:red">';
                                        } else {
                                            echo '<span >';
                                        }
                                        echo $etablissement->scratch_nb_equipes_c3 .'>' . $etablissement->scratch_nb_eleves_c3;
                                        echo '</span >';
                                        ?>
                                    </td>
                                    <td class="text-left">
                                        <?php
                                        if ($etablissement->scratch_nb_equipes_c4 !== NULL AND $etablissement->scratch_nb_equipes_c4 !== 0 AND $etablissement->scratch_nb_eleves_c4/$etablissement->scratch_nb_equipes_c4 > 3){
                                            echo '<span style="color:red">';
                                        } else {
                                            echo '<span >';
                                        }
                                        echo $etablissement->scratch_nb_equipes_c4 .'>' . $etablissement->scratch_nb_eleves_c4;
                                        echo '</span >';
                                        ?>
                                    </td>
                                    <td class="text-left">
                                        <?php
                                        if ($etablissement->scratch_nb_equipes_lycee !== NULL AND $etablissement->scratch_nb_equipes_lycee !== 0 AND $etablissement->scratch_nb_eleves_lycee/$etablissement->scratch_nb_equipes_lycee > 3){
                                            echo '<span style="color:red">';
                                        } else {
                                            echo '<span >';
                                        }
                                        echo $etablissement->scratch_nb_equipes_lycee .'>' . $etablissement->scratch_nb_eleves_lycee;
                                        echo '</span >';
                                        ?>                                        
                                    </td>
                                    <td class="text-left">
                                        <?php
                                        if ($etablissement->python_nb_equipes_pi !== NULL AND $etablissement->python_nb_equipes_pi !== 0 AND $etablissement->python_nb_eleves_pi/$etablissement->python_nb_equipes_pi > 3){
                                            echo '<span style="color:red">';
                                        } else {
                                            echo '<span >';
                                        }
                                        echo $etablissement->python_nb_equipes_pi .'>' . $etablissement->python_nb_eleves_pi;
                                        echo '</span >';
                                        ?>      
                                    </td>
                                    <td class="text-left">
                                        <?php
                                        if ($etablissement->python_nb_equipes_poo !== NULL AND $etablissement->python_nb_equipes_poo !== 0 AND $etablissement->python_nb_eleves_poo/$etablissement->python_nb_equipes_poo > 3){
                                            echo '<span style="color:red">';
                                        } else {
                                            echo '<span >';
                                        }
                                        echo $etablissement->python_nb_equipes_poo .'>' . $etablissement->python_nb_eleves_poo;
                                        echo '</span >';
                                        ?>                                         
                                    </td>
                                    <td class="text-left">
                                        <?php
                                        if ($etablissement->python_nb_equipes_postbac !== NULL AND $etablissement->python_nb_equipes_postbac !== 0 AND $etablissement->python_nb_eleves_postbac/$etablissement->python_nb_equipes_postbac > 3){
                                            echo '<span style="color:red">';
                                        } else {
                                            echo '<span >';
                                        }
                                        echo $etablissement->python_nb_equipes_postbac .'>' . $etablissement->python_nb_eleves_postbac;
                                        echo '</span >';
                                        ?>    
                                    </td>
                                    <td class="text-center">{{$etablissement->scratch_nb_eleves_c3 + $etablissement->scratch_nb_eleves_c4 + $etablissement->scratch_nb_eleves_lycee + $etablissement->python_nb_eleves_pi + $etablissement->python_nb_eleves_poo + $etablissement->python_nb_eleves_postbac }}</td>
                                    <td class="text-center">
                                        <?php
                                        $diff = $etablissement->scratch_nb_eleves_c3 + $etablissement->scratch_nb_eleves_c4 + $etablissement->scratch_nb_eleves_lycee + $etablissement->python_nb_eleves_pi + $etablissement->python_nb_eleves_poo + $etablissement->python_nb_eleves_postbac - $etablissement->nb_participants;
                                        if ($diff > 0) {
                                            echo '<span class="text-success">+'.$diff.'</span>';
                                        } elseif ($diff < 0) {
                                            echo '<span class="text-danger">'.$diff.'</span>';
                                        } else {
                                            echo $diff;
                                        }
                                        ?>
                                    </td>
                                    <td nowrap>{{substr($etablissement->updated_at,5,5)}}</td>
                                    <td class="text-center">{{$etablissement->scratch_nb_equipes_c3 + $etablissement->scratch_nb_equipes_c4 + $etablissement->scratch_nb_equipes_lycee}}</td>
                                    <td class="text-center">{{$etablissement->python_nb_equipes_pi + $etablissement->python_nb_equipes_poo + $etablissement->python_nb_equipes_postbac}}</td>                                
                                    <td class="text-center">
                                        <input type="checkbox" name="scratch" value="{{$etablissement->id}}" onclick="update_udj(this)" @if ($etablissement->udj_scratch) checked @endif>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="python" value="{{$etablissement->id}}" onclick="update_udj(this)" @if ($etablissement->udj_python) checked @endif>
                                    </td>
                                    <td nowrap>{{substr($etablissement->udj_read_at,5,5)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /row -->

        <hr />

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-striped table-sm text-monospace text-muted" style="font-size:75%">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Établissement</th>
                                <th scope="col">Nb élèves</th>
                                <th scope="col">Ac. / zone</th>
                                <th scope="col">Pays</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Courriel</th>
                                <th scope="col">Date</th>
                                <th scope="col">Éq. C3</th>
                                <th scope="col">Éq. C4</th>
                                <th scope="col">Éq. LY</th>
                                <th scope="col">Éq. PI</th>
                                <th scope="col">Éq. PO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etablissements AS $etablissement)
                            <tr>
                                <td class="text-success">{{$loop->index + 1}}</td>
                                <td>{{$etablissement->id}}</td>
                                <td>{{$etablissement->prenom}} {{$etablissement->nom}}</td>
                                <td>{{$etablissement->etablissement}}</td>
                                <td>{{$etablissement->nb_participants}}</td>
                                <td>{{$etablissement->ac_zone}}</td>
                                <td>{{$etablissement->pays}}</td>
                                <td>{{$etablissement->ville}}</td>
                                <td>{{$etablissement->email}}</td>
                                <td>{{$etablissement->ndc_date}}</td>
                                <td class="text-center">{{$etablissement->scratch_nb_equipes_c3}}</td>
                                <td class="text-center">{{$etablissement->scratch_nb_equipes_c4}}</td>
                                <td class="text-center">{{$etablissement->scratch_nb_equipes_lycee}}</td>
                                <td class="text-center">{{$etablissement->python_nb_equipes_pi}}</td>
                                <td class="text-center">{{$etablissement->python_nb_equipes_poo}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /row -->

        <hr />

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-striped table-sm text-monospace text-muted" style="font-size:75%">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Établissement</th>
                                <th scope="col">Nb élèves</th>
                                <th scope="col">Ac. / zone</th>
                                <th scope="col">Pays</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Courriel</th>
                                <th scope="col">Date</th>
                                <th scope="col">Twitter Orga</th>
                                <th scope="col">Mastodon Orga</th>
                                <th scope="col">LinkedIn Orga</th>
                                <th scope="col">Twitter Etab</th>
                                <th scope="col">Mastodon Etab</th>
                                <th scope="col">LinkedIn Etab</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($etablissements AS $etablissement)
                            <tr>
                                <td class="text-success">{{$loop->index + 1}}</td>
                                <td>{{$etablissement->id}}</td>
                                <td>{{$etablissement->prenom}} {{$etablissement->nom}}</td>
                                <td>{{$etablissement->etablissement}}</td>
                                <td>{{$etablissement->nb_participants}}</td>
                                <td>{{$etablissement->ac_zone}}</td>
                                <td>{{$etablissement->pays}}</td>
                                <td>{{$etablissement->ville}}</td>
                                <td>{{$etablissement->email}}</td>
                                <td>{{$etablissement->ndc_date}}</td>
                                <td class="text-center">{{$etablissement->twitter_orga}}</td>
                                <td class="text-center">{{$etablissement->mastodon_orga}}</td>
                                <td class="text-center">{{$etablissement->linkedin_orga}}</td>
                                <td class="text-center">{{$etablissement->twitter_etab}}</td>
                                <td class="text-center">{{$etablissement->mastodon_etab}}</td>
                                <td class="text-center">{{$etablissement->linkedin_etab}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /row -->        

	</div><!-- /container -->

	@include('inc-bottom-js')

    <script>
	function update_udj(e) {
		console.log(e.name);
		console.log(e.value);
		console.log(e.checked);
		var json = JSON.stringify({language:e.name, user_id:e.value, state:e.checked});
		fetch('/console/update_udj_publication', {
			method: "POST",
			mode: "cors",
			headers: {"Content-Type": "application/json; charset=UTF-8", "X-CSRF-Token": "{{ csrf_token() }}"},
			body: json
		})
		.then(function(response) {
			if (response.ok) {
				console.log('Mise à jour de la base de données réussie.');
				return response.text().then(data =>{console.log(data)});
			} else {
				console.log('Erreur lors de la mise à jour de la base de données.');
				return response.text().then(data =>{console.log(data)});
			}
		})
		.catch(function(error) {
			console.log('Erreur lors de la mise à jour de la base de données : ' + error.message);
		});
	}
    </script>
	
	<script>
	function copier_adresses(semaine) {
		var texte = document.getElementById('adresses_semaine_'+semaine).textContent;
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
	}
	</script>	


	<script>
	function copier_adresse(el) {
		var texte = el.dataset.adresse;
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
	}
	</script>	



</body>
</html>
