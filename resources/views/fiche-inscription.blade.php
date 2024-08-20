@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('inc-meta')
    <title>{{ config('app.name', 'Laravel') }} | console</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-3 mb-5">
		<div class="row">

            <div class="col-md-2 mt-4">
                <a class="btn btn-light btn-sm" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
			</div>

			<div class="col-md-10">

				@if (session('status'))
					<div class="text-success text-monospace text-center pb-4" role="alert">
						{{ session('status') }}
					</div>
				@endif

    			<div class="row mb-5">
                    <div class="col-md-12">

                        <h1>Fiche d'inscription</h1>

                        <table class="table table-hover table-borderless text-monospace">
                            <tr>
                                <td class="text-center"><i class="fas fa-address-card"></i></td>
                                <td class="text-muted">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><i class="fas fa-briefcase"></i></td>
                                <td class="text-muted">{{ Auth::user()->titre }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><i class="fas fa-at"></i></td>
                                <td class="text-muted">{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><i class="fas fa-school"></i></td>
                                <td class="text-muted">{{ Auth::user()->etablissement }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><i class="fas fa-map-marked"></i></td>
                                <td class="text-muted">{{ Auth::user()->ac_zone }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><i class="fas fa-city"></i></td>
                                <td class="text-muted">{{ Auth::user()->ville }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><i class="fas fa-globe-americas"></i></td>
                                <td class="text-muted">{{ Auth::user()->pays }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><i class="fas fa-users"></i></td>
                                <td class="text-muted">{{ Auth::user()->nb_participants }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></td>
                                <td class="text-muted">{{ Auth::user()->twitter_orga }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><path d="M433 179.1c0-97.2-63.7-125.7-63.7-125.7-62.5-28.7-228.6-28.4-290.5 0 0 0-63.7 28.5-63.7 125.7 0 115.7-6.6 259.4 105.6 289.1 40.5 10.7 75.3 13 103.3 11.4 50.8-2.8 79.3-18.1 79.3-18.1l-1.7-36.9s-36.3 11.4-77.1 10.1c-40.4-1.4-83-4.4-89.6-54a102.5 102.5 0 0 1 -.9-13.9c85.6 20.9 158.7 9.1 178.8 6.7 56.1-6.7 105-41.3 111.2-72.9 9.8-49.8 9-121.5 9-121.5zm-75.1 125.2h-46.6v-114.2c0-49.7-64-51.6-64 6.9v62.5h-46.3V197c0-58.5-64-56.6-64-6.9v114.2H90.2c0-122.1-5.2-147.9 18.4-175 25.9-28.9 79.8-30.8 103.8 6.1l11.6 19.5 11.6-19.5c24.1-37.1 78.1-34.8 103.8-6.1 23.7 27.3 18.4 53 18.4 175z"/></svg></td>
                                <td class="text-muted">{{ Auth::user()->mastodon_orga }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/></svg></td>
                                <td class="text-muted">{{ Auth::user()->linkedin_orga }}</td>
                            </tr>                            
                            <tr>
                                <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm297.1 84L257.3 234.6 379.4 396H283.8L209 298.1 123.3 396H75.8l111-126.9L69.7 116h98l67.7 89.5L313.6 116h47.5zM323.3 367.6L153.4 142.9H125.1L296.9 367.6h26.3z"/></svg></td>
                                <td class="text-muted">{{ Auth::user()->twitter_etab }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><path d="M433 179.1c0-97.2-63.7-125.7-63.7-125.7-62.5-28.7-228.6-28.4-290.5 0 0 0-63.7 28.5-63.7 125.7 0 115.7-6.6 259.4 105.6 289.1 40.5 10.7 75.3 13 103.3 11.4 50.8-2.8 79.3-18.1 79.3-18.1l-1.7-36.9s-36.3 11.4-77.1 10.1c-40.4-1.4-83-4.4-89.6-54a102.5 102.5 0 0 1 -.9-13.9c85.6 20.9 158.7 9.1 178.8 6.7 56.1-6.7 105-41.3 111.2-72.9 9.8-49.8 9-121.5 9-121.5zm-75.1 125.2h-46.6v-114.2c0-49.7-64-51.6-64 6.9v62.5h-46.3V197c0-58.5-64-56.6-64-6.9v114.2H90.2c0-122.1-5.2-147.9 18.4-175 25.9-28.9 79.8-30.8 103.8 6.1l11.6 19.5 11.6-19.5c24.1-37.1 78.1-34.8 103.8-6.1 23.7 27.3 18.4 53 18.4 175z"/></svg></td>
                                <td class="text-muted">{{ Auth::user()->mastodon_etab }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg></td>
                                <td class="text-muted">{{ Auth::user()->linkedin_etab }}</td>
                            </tr>
                        </table>

                        <a class="btn btn-primary mt-3" href="{{ route('fiche-inscription-modifier_get') }}" role="button">modifier</a>

    				</div>
    			</div>
            </div>
        </div>
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
