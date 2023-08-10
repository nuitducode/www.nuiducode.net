@include('inc-top')
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STUDIO PYXEL</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('img/favicon.svg') }}">

    <!-- Font Awesome -->
	<link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Styles -->
	<link href="{{ asset('public-pyxel/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('public-pyxel/css/custom.css') }}" rel="stylesheet">

	<meta http-equiv="cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />   
</head>
<body>

	<div class="container mt-4">
		<div class="row">

            <div class="col-md-2 pt-4">
				<a class="btn btn-light btn-sm" href="/pyxel/studio/{{$token_private}}/" role="button"><i class="fas fa-arrow-left"></i></a>
			</div>       

			<div class="col-md-6 font-monospace">

                <h1>Importer un fichier .pyxres</h1>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
                @endif
            
                <form action="{{ route('file-upload', [$token_private]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
        
                    <div class="mb-3">
                        <input 
                            type="file" 
                            name="file" 
                            id="inputFile"
                            class="form-control @if($errors->any()) is-invalid @endif" required />
        
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="text-danger">{{$error}}</div>
                            @endforeach
                        @endif                     
                    </div>

                    <div class="mb-3">
                        <input type="hidden" name="token_private" value="{{$token_private}}" />
                        <button type="submit" class="btn btn-primary ps-4 pe-4"><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                    </div>
            
                </form>            

			</div>

	</div>

	@include('inc-bottom-js')

</body>
</html>
