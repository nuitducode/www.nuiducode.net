<?php
if (isset($_GET['v'])) {
	$tuto = '<iframe id="tuto_iframe" class="video" src="https://www.youtube.com/embed/' . $_GET['v'] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
if (isset($_GET['yt'])) {
	$tuto = '<iframe id="tuto_iframe" class="video" src="https://www.youtube.com/embed/' . $_GET['yt'] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
if (isset($_GET['pdf'])) {
	$tuto = '<iframe id="tuto_iframe" src="https://docs.google.com/gview?url=' . $_GET['pdf'] . '&embedded=true" style="width:100%;height:1500px" frameborder="0"></iframe>';
}
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <title>Atelier Scratch</title>
    
    <style>
        html,body {
          height: 100%;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 10px 1fr;
            height:100%;
        }
        .gutter-col {
            grid-row: 1/-1;
            cursor: col-resize;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAeCAYAAADkftS9AAAAIklEQVQoU2M4c+bMfxAGAgYYmwGrIIiDjrELjpo5aiZeMwF+yNnOs5KSvgAAAABJRU5ErkJggg==');
            background-color: rgb(229, 231, 235);
            background-repeat: no-repeat;
            background-position: 50%;
        }
        .gutter-col-1 {
            grid-column: 2;
        }
        .video {
          aspect-ratio: 16 / 9;
          width: 100%;
        }
    </style>

</head>

<body>

    <div class="grid">
        <div style="overflow-y: scroll;direction:rtl;">
            <div style="direction:ltr;">

                <div class="container mt-4 mb-5">
                	<div class="row">
                		<div class="col-md-12 text-left">
                			<a href="{{ URL::to('/') }}"><img src="{{ asset('img/nav-home.svg') }}" width="40" /></a>
                            <span class="ml-3 text-monospace font-weight-bold">L'ATELIER SCRATCH <sup class="text-info" data-html="true" data-toggle="tooltip" data-placement="right" title="Espace pour apprendre et expérimenter sans avoir besoin d'un compte Scratch. Attention, il n'est pas possible de sauvegarder les travaux en ligne. Il est donc nécessaire d'importer / sauvegarder les travaux à chaque session. Voir menu &ldquo;Fichier&rdquo; de Scratch."><i class="fas fa-question-circle"></i></sup></span>
                		</div>
                	</div>
                </div>

				<div id="tuto">
					<?php echo $tuto ?>
				</div>

            </div>
        </div>
        <div class="gutter-col gutter-col-1"></div>
        <div>
            <iframe src="https://nuitducode.github.io/scratch/master/" style="border:none;width:100%;height:99%" title="scratch"></iframe>
        </div>
    </div>


    <script src="https://unpkg.com/split-grid/dist/split-grid.js"></script>
    <script>
    Split({
        minSize: 200,
        columnGutters: [{
            track: 1,
            element: document.querySelector('.gutter-col-1'),
        }],
    })
    </script>

    @include('inc-bottom-js')
</body>
</html>
