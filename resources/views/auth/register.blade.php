<?php
//echo 'inscriptions fermées';
//exit;
?>
@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <title>{{ config('app.name', 'Laravel') }} | inscrire un établissement</title>
</head>
<body>

	@include('inc-nav')

	<div class="container mb-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card mt-5" style="background:none;border:none;">
					<h1>Inscription</h1>

					<div class="card-body">
						<form method="POST" action="{{ route('register') }}">
							@csrf

							<div class="form-group row">
								<label for="prenom" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">prénom <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" autofocus>
									@error('prenom')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="nom" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">nom <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" />
									@error('nom')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="titre" class="col-md-6 col-form-label text-md-right text-info" style="line-height:1">
									<div class="text-uppercase">titre <sup class="text-danger">*</sup></div>
									<div class="text-dark small font-italic pr-2 pt-1" style="opacity:0.5">ex.: enseignante de mathématiques, enseignant de SNT, proviseure, proviseur-adjoint, CPE...</div>
								</label>
								<div class="col-md-6">
									<input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre') }}" />
									@error('titre')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="email" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
									<div class="text-uppercase">adresse courriel <sup class="text-danger">*</sup></div>
									<div class="text-dark small font-italic pr-2 pt-1" style="opacity:0.5">adresse professionnelle (académique, aefe...)</div>
								</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" />
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="etablissement" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">nom de l'établissement <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<input id="etablissement" type="text" class="form-control @error('etablissement') is-invalid @enderror" name="etablissement" value="{{ old('etablissement') }}" />
									@error('etablissement')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="ac_zone" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">académie / zone <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<?php
									$academies = ["Aix-Marseille", "Amiens", "Besançon", "Bordeaux", "Clermont-Ferrand", "Corse", "Créteil", "Dijon", "Grenoble", "Guadeloupe", "Guyane", "La Réunion", "Lille", "Limoges", "Lyon", "Martinique", "Mayotte", "Montpellier", "Nancy-Metz", "Nantes", "Nice", "Normandie", "Orléans-Tours", "Paris", "Poitiers", "Reims", "Rennes", "Strasbourg", "Toulouse", "Versailles", "Wallis-et-Futuna", "Nouvelle-Calédonie", "Saint-Pierre-et-Miquelon", "Polynésie française"];
									$zones = ["AEFE - Afrique Australe et Orientale", "AEFE - Afrique Centrale", "AEFE - Afrique Occidentale", "AEFE - Amérique du Nord", "AEFE - Amérique Latine Rythme Nord", "AEFE - Amérique Latine Rythme Sud", "AEFE - Asie-Pacifique", "AEFE - Europe Centrale et Orientale", "AEFE - Europe du Nord-Ouest et Scandinave", "AEFE - Europe du Sud-Est", "AEFE - Europe Ibérique", "AEFE - Maghreb Est", "AEFE - Maroc", "AEFE - Proche-Orient", "AEFE - Moyen-Orient", "AEFE - Océan Indien"];
									?>
									<select id="ac_zone" name="ac_zone" class="custom-select @error('ac_zone') is-invalid @enderror">
										<option value=""></option>
										@foreach($academies as $academie)
										<option value="{{$academie}}" @if(old('ac_zone') == $academie) selected  @endif>{{$academie}}</option>
										@endforeach
										@foreach($zones as $zone)
										<option value="{{$zone}}" @if(old('ac_zone') == $zone) selected  @endif>{{$zone}}</option>
										@endforeach
										<option value="autre">autre</option>
									</select>
									@error('ac_zone')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="ville" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">ville <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<input id="ville" type="text" class="form-control @error('ville') is-invalid @enderror" name="ville" value="{{ old('ville') }}" />
									@error('ville')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="pays" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">pays <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<input id="pays" type="text" class="form-control @error('pays') is-invalid @enderror" name="pays" value="{{ old('pays') }}" />
									@error('pays')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="nb_participants" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
									<div class="text-uppercase">nombre d'élèves susceptibles <sup class="text-danger">*</sup></div>
									<div class="text-uppercase pr-2">de participer</div>
									<div class="text-dark small font-italic pr-2 pt-1" style="opacity:0.5">une vague estimation suffit dans un premier temps, ce nombre peut être mis à jour ultérieurement</div>
								</label>
								<div class="col-md-6">
									<input id="nb_participants" type="text" class="form-control @error('nb_participants') is-invalid @enderror" name="nb_participants" value="{{ old('nb_participants') }}" />
									@error('nb_participants')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="rounded p-3 mb-4 small" style="border:1px solid #ced4da">
								
								<div class="text-dark font-italic" style="opacity:0.5">optionnel</div>

								<div class="form-group row">
									<label for="twitter_orga" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
										<div class="text-uppercase pr-2">compte 𝕏</div>
									</label>
									<div class="col-md-6">
										<input id="twitter_orga" type="text" class="form-control form-control-sm" name="twitter_orga" value="{{ old('twitter_orga') }}" placeholder="https://x.com/pierredupont" />
									</div>
								</div>

								<div class="form-group row">
									<label for="mastodon_orga" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
										<div class="text-uppercase pr-2">compte Mastodon</div>
									</label>
									<div class="col-md-6">
										<input id="mastodon_orga" type="text" class="form-control form-control-sm" name="mastodon_orga" value="{{ old('mastodon_orga') }}"  placeholder="https://mastodon.social/@pierredupont" />
									</div>
								</div>							

								<div class="form-group row">
									<label for="linkedin_orga" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
										<div class="text-uppercase pr-2">compte LinkedIn</div>
									</label>
									<div class="col-md-6">
										<input id="linkedin_orga" type="text" class="form-control form-control-sm" name="linkedin_orga" value="{{ old('linkedin_orga') }}"  placeholder="https://www.linkedin.com/in/pierredupont/" />
									</div>
								</div>	

								<div class="form-group row">
									<label for="twitter_etab" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
										<div class="text-uppercase pr-2">compte 𝕏 de l'établissement</div>
									</label>
									<div class="col-md-6">
										<input id="twitter_etab" type="text" class="form-control form-control-sm" name="twitter_etab" value="{{ old('twitter_etab') }}" placeholder="https://x.com/lfitokyo" />
									</div>
								</div>

								<div class="form-group row">
									<label for="mastodon_etab" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
										<div class="text-uppercase pr-2">compte Mastodon de l'établissement</div>
									</label>
									<div class="col-md-6">
										<input id="mastodon_etab" type="text" class="form-control form-control-sm" name="mastodon_etab" value="{{ old('mastodon_etab') }}" placeholder="https://mastodon.social/@lfitokyo" />
									</div>
								</div>							

								<div class="form-group row mb-0">
									<label for="linkedin_etab" class="col-md-6 col-form-label text-md-right text-info" style=";line-height:1">
										<div class="text-uppercase pr-2">compte LinkedIn de l'établissement</div>
									</label>
									<div class="col-md-6">
										<input id="linkedin_etab" type="text" class="form-control form-control-sm" name="linkedin_etab" value="{{ old('linkedin_etab') }}" placeholder="https://www.linkedin.com/company/international-french-school-in-tokyo/" />
									</div>
								</div>	
							
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">mot de passe <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" />
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="password-confirm" class="col-md-6 col-form-label text-md-right text-info">
									<div class="text-uppercase">confirmation du mot de passe <sup class="text-danger">*</sup></div>
								</label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" />
								</div>
							</div>

							<div class="form-group row pt-3">
								<label for="password-confirm" class="col-md-6 text-right"><span class="badge badge-warning small" style="padding-top:5px;">RGPD</span></label>
								<div class="col-md-6">
									<div class="form-check">
										<input id="checkbox1" class="form-check-input" style="cursor:pointer" type="checkbox" />
										<label class="form-check-label text-monospace small text-justify pr-1 text-muted" style="padding-top:2px;">
											J'autorise ce site à conserver les données transmises via ce formulaire. Ces données peuvent être supprimées à tout moment en sélectionnant "supprimer ce compte" dans la console.
										</label>
									</div>
								</div>
							</div>

							<div class="form-group row pt-2">
								<label for="password-confirm" class="col-md-6 text-right"></label>
								<div class="col-md-6">
									<div class="form-check">
										<input id="checkbox2" class="form-check-input" style="cursor:pointer" type="checkbox" />
										<label class="form-check-label text-monospace small text-justify pr-1 text-muted" style="padding-top:2px;">
											Je confirme avoir indiqué mon <u>adresse professionnelle</u> et non pas mon adresse personnelle.
										</label>
									</div>
								</div>
							</div>							

							<div class="form-group row pt-3">
								<div class="col-md-6 offset-md-5">
									<button type="submit" id="inscription" class="btn btn-success" disabled>inscrire l'établissement</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div><!-- container -->

	<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox1 = document.getElementById('checkbox1');
        const checkbox2 = document.getElementById('checkbox2');
        const submitBtn = document.getElementById('inscription');

        function checkCheckboxes() {
            // Le bouton est activé seulement si les deux cases à cocher sont sélectionnées
            if (checkbox1.checked && checkbox2.checked) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        // Attacher l'événement 'change' aux checkboxes pour surveiller leur état
        checkbox1.addEventListener('change', checkCheckboxes);
        checkbox2.addEventListener('change', checkCheckboxes);
    });
	</script>
	
	@include('inc-bottom-js')

</body>
</html>
