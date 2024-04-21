@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('inc-meta')
    <title>{{ config('app.name', 'Laravel') }} | console</title>
</head>
<body>

    @include('inc-nav-console')

	<div class="container mt-4 mb-5">
        <div class="row">

            <div class="col-md-2">
                <a class="btn btn-light btn-sm mb-4" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
            </div>

            <div class="col-md-10">

                <?php
                $display_enregistrement = "block";
                $display_evaluation = "block";
                if (request()->get('p') == 'enregistrement'){
                    $display_evaluation = "none";
                }
                if (request()->get('p') == 'evaluation'){
                    $display_enregistrement = "none";
                }

                if(request()->segment(2) == 'ndc') $type='Nuit du Code';
                if(request()->segment(2) == 'sltn') $type='Sélections';
                if(request()->segment(2) == 'bas') $type='Bas à sable';

                $jeton = Auth::user()->jeton;
                // salt eleve : 'hez'
                // salt enseignant : 'jwa'
                $token_eleve = $jeton[3].'h'.$jeton[2].'e'.$jeton[1].'z'.$jeton[0];
                $token_enseignant = $jeton[3].'j'.$jeton[2].'w'.$jeton[1].'a'.$jeton[0];
                ?>

                <h1 class="m-0 p-0">{{$type}}</h1>
                @if (request()->segment(2) == 'ndc')
                <div class="text-danger text-monospace small">Ne pas utiliser cette section avant la date de la NDC.</div>
                @endif
                @if (request()->segment(2) == 'sltn')
                <div class="text-info text-monospace small">Cette section peut être utilisée pour organiser des sélections.</div>
                @endif
                @if (request()->segment(2) == 'bas')
                <div class="text-danger text-monospace small">Cette section peut être utilisée pour se familiariser avec les outils ou faire des tests.</div>
                @endif

                <!-- ============ -->
                <!-- LIENS DEPOTS -->
                <!-- ============ -->
                <div id="enregistrement" style="display:{{$display_enregistrement}}">
                    <h2>Enregistrement des jeux</h2>
                    Lien à fournir aux équipes pour qu'elles enregistrent leurs jeux sur le site:
                    <div class="mt-1 p-2 text-center">
                        <a href="/{{request()->segment(2)}}/{{strtoupper(Auth::user()->jeton)}}" class="text-monospace text-success" target="_blank">https://www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper(Auth::user()->jeton)}}</a>
                    </div>
                </div>


                <!-- ================= -->
                <!-- LIENS EVALUATIONS -->
                <!-- ================= -->
                <div id="evaluation" style="display:{{$display_evaluation}}">
                    <h2>Évaluation par les élèves</h2>
                    Lien à fournir aux élèves pour l'évaluation des jeux:
                    <div class="p-3 text-center">
                        <a href="/{{request()->segment(2)}}/{{strtoupper($token_eleve)}}" class="text-monospace  text-success" target="_blank">https://www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper($token_eleve)}}</a>
                    </div>
                    <div  class="text-justify mt-2">
                        Par équipe, les élèves évaluent les jeux des équipes appartenant à une catégorie différente de la leur. Le croisement des catégories sera défini par les organisateurs et communiqué aux élèves. Il est préférable que cette évaluation soit faite sous la surveillance des organisateurs pour éviter toute erreur de manipulation (évaluations multiples, équipes qui évaluent leurs propres jeux...). Les évaluations peuvent être organisées juste après la fin de l'événement ou un autre jour.
                    </div>

                    <h2 class="mt-4">Évaluation par les enseignants</h2>
                    Lien à fournir aux enseignants pour l'évaluation des jeux:
                    <div class="p-3 text-center">
                        <a href="/{{request()->segment(2)}}/{{strtoupper($token_enseignant)}}" class="text-monospace text-success" target="_blank">https://www.nuitducode.net/{{request()->segment(2)}}/{{strtoupper($token_enseignant)}}</a>
                    </div>
                </div>

            </div>

        </div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

</body>
</html>
