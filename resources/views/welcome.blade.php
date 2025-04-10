@include('inc-top')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('inc-meta')
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>

	<div class="container mt-4 mb-5">

		<div class="row mb-5">

			<div class="col-md-4 text-center">
				<img src="{{ asset('img/ndc2025.png') }}" width="280" />
			</div>

			<div class="col-md-5 text-center">
				<div class="mt-2 mb-3">
                    <div class="text-monospace text-danger font-weight-bold" style="font-size:24px">SCRATCH <span style="color:silver;">&#8231;</span> PYTHON</div>
                    <div class="text-center"><span style="margin-left:10px;"><img src="{{ asset('img/affiche/scratch.png') }}" width="45" /></span><span style="margin-left:60px;"><img src="{{ asset('img/affiche/python.png') }}" width="45" /></span></div>
                </div>
				<div class="font-weight-bold text-monospace" style="font-size:16px;color:#261b0c;">6h pour coder un jeu</div>
				<div class="text-monospace font-weight-bold" style="font-size:12px;color:gray">~ 9<sup>e</sup> édition ~</div>
				<div class="mt-3 mb-3 text-monospace font-weight-bold" style="font-size:17px;color:#4cbf56">mai - juin 2025</div>
			</div>

		</div>

		<div class="row mb-4">

			<div class="col-md-9 text-center">				
				<?php
				/*
				<p class="text-center">
					<a class="btn btn-success btn-lg text-monospace font-weight-bold" href="/ndc2024" role="button">JEUX 2024</a>
				</p>
				*/
				?>

				<p class="text-center">
					<a class="btn btn-success" href="register" role="button"><img src="{{ asset('img/icon-green-flag.svg') }}" width="12" class="mr-2" /> inscrire un établissement</a>
				</p>
				
				<p class="text-center mt-3 small">
					<span style="font-weight:bold;color:#d35400">{{ 28 + App\Models\User::count(); }}</span>
					<span class="text-monospace" style="color:silver"> établissements inscrits</span>
					<span class="ml-3 " style="font-weight:bold;color:#d35400">{{ App\Models\User::sum('nb_participants'); }}</span>
					<span class="text-monospace" style="color:silver"> élèves</span>
					<span class="ml-3 " style="font-weight:bold;color:#d35400">{{ App\Models\User::distinct()->count('ville'); }}</span>
					<span class="text-monospace" style="color:silver"> villes</span>
					<span class="ml-3 " style="font-weight:bold;color:#d35400">{{ App\Models\User::distinct()->count('pays'); }}</span>
					<span class="text-monospace" style="color:silver"> pays</span>					
				</p>
			</div>

		</div><!-- row -->

		<div class="row">

			<div class="col-md-9">

				<p class="text-monospace text-justify">
					La <b style="color:#2c3e50">Nuit du Code</b> est un <b style="color:#cf63cf">marathon de programmation</b> durant lequel les élèves, par équipes de deux ou trois, ont <b style="color:#cf63cf">6h<sup style="cursor:help;color:gray;padding-left:2px;" data-html="true" data-toggle="tooltip" data-placement="top" title="ou moins pour les élèves de cycle 3"><i class="fas fa-question-circle fa-xs"></i></sup> pour coder un jeu</b> avec <a href="https://scratch.mit.edu/" target="_blank"><img src="{{ asset('img/scratch-logo.svg') }}" /></a> ou <a href="https://www.python.org/" target="_blank"><img src="{{ asset('img/python-logo.svg') }}" /></a>.
				</p>

				<div class="text-center mt-2 mb-3">
					<a class="btn btn-primary mr-2" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/SCRATCH/01-introduction/" role="button">entraînement scratch</a>
					<a class="btn btn-primary ml-2" href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/01-presentation/" role="button">entraînement python / pyxel</a>
				</div>

				<p class="text-monospace text-justify">
					Peuvent participer: tous les établissements scolaires français situés en France ou à l'étranger ainsi que tous les établissements scolaires francophones où qu'ils soient. Les catégories vont du cours moyen au post-bac en passant par le collège et le lycée. Chaque établissement peut inscrire autant d'élèves qu'il le souhaite. Les inscriptions sont gratuites.
				</p>

				<iframe style="border-radius:5px" width="100%" height="250px" frameborder="0" allowfullscreen src="https://umap.openstreetmap.fr/en/map/nuit-du-code-2025_1111860"></iframe>		

				<div class="text-monospace">
					Six catégories :
					<ul class="text-monospace">
						<li>Scratch: CM1-6<sup>e</sup>, 5<sup>e</sup>-3<sup>e</sup> et Lycée</li>
						<li>Python: NSI Première, NSI Terminale et post-bac</li>	
					</ul>
				</div>

				<p class="text-monospace text-justify">
					Afin de réduire au maximum l'investissement nécessaire pour organiser la <b style="color:#2c3e50">Nuit du Code</b> dans les établissements, tous les documents, ressources, tutoriels, supports... sont fournis.
				</p>

				<p class="text-monospace text-justify">
					L'an dernier, pour l'édition 2024, 464 établissements se sont inscrits. Soit plus de 11500 élèves de 346 villes et 49 pays.
				</p>

				<p class="text-monospace  text-justify mt-4">
					<u>Organisation de l'édition 2025</u>
					<ul class="text-monospace text-justify">
						<li class="mb-3"><span class="text-primary font-weight-bold">Septembre 2024 - fin avril 2025</span> : Inscriptions</li>
						<li class="mb-3"><span class="text-primary font-weight-bold">Janvier - mai 2025</span> : Préparatifs / Entraînements / Sélections</li>
						<li class="mb-3"><span class="text-primary font-weight-bold">Mai - juin 2025</span> : Chaque établissement organise sa <b style="color:#2c3e50">Nuit du Code</b> entre <b style="color:#4cbf56">le 28 avril et le 31 mai 2025</b> selon ses ressources et ses contraintes. Les établissements qui ne prévoient pas de proposer des jeux pour la sélection internationale peuvent organiser la <b style="color:#2c3e50">Nuit du Code</b> <b style="color:#4cbf56">jusqu'au 27 juin</b>.</li>
						<li class="mb-3"><span class="text-primary font-weight-bold">Mi-juin 2025</span> : Annonce des jeux de la sélection "<b style="color:#2c3e50">Nuit du Code 2025</b>"</li>
					</ul>
				</p>
				<div class="text-right">
					<a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/01-presentation/" class="btn btn-light btn-sm text-monospace"  role="button" style="font-size:70%" target="_blank"> plus de détails</a>
				</div>

				<div class="text-center mt-5">
					<img src="{{ asset('img/labyrinthe.gif') }}" width="37.5%" class="img-fluid rounded mr-2" />
					<img src="{{ asset('img/space.gif') }}" width="50%" class="img-fluid rounded ml-2" />
				</div>

				<div class="text-center mt-3">
					<img src="{{ asset('img/garden.gif') }}" width="50%" class="img-fluid rounded mr-2" />
					<img src="{{ asset('img/soldat.gif') }}" width="37.5%" class="img-fluid rounded ml-2" />
				</div>

				<p class="text-monospace  text-justify mt-5">
					La <b style="color:#2c3e50">Nuit du Code</b> se déroule forcément la nuit ? Non, heureusement. Chaque établissement organise sa <b style="color:#2c3e50">Nuit du Code</b> en fonction de ses ressources et de ses contraintes. Le matin, l'après-midi, le soir, en semaine, le week-end, c'est selon.
				</p>
				<p class="text-monospace  text-justify mt-2">
					Alors, pourquoi la <b style="color:#2c3e50"><u>Nuit</u> du Code</b> ? Car, lors des premières éditions, les établissements de la zone Asie-Pacifique se retrouvaient à Taipei le temps d'un week-end riche en rencontres et aventures (grâce à Alexis Kauffmann, Jean-Yves Labouche, Jean-Yves Vesseau, Andria Spring et toutes les personnes qui participaient à l'organisation). Le marathon de programmation débutait à 18h pour se finir à minuit. De nuit donc.
				</p>

			</div>

			<div class="col-md-3 text-center">

				<div class="mb-5">
				<a class="btn btn-outline-secondary btn-sm" style="opacity:0.4;margin:2px 0px 0px 4px" href="login" role="button">se connecter</a>
				</div>

				<div class="bouton mt-1">
					<a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/01-presentation/" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">présentation</text>
							</g>
						</svg>
					</a>
				</div>

				<div class="bouton mt-1">
					<a href="https://nuitducode.github.io/ndc-diaporama-presentation/" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">diaporama</text>
							</g>
						</svg>
					</a>
				</div>

				<div class="bouton">
					<a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/02-organisation/" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">organisation</text>
							</g>
						</svg>
					</a>
				</div>

				<div class="bouton">
					<a href="/affiche-generateur">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">affiches</text>
							</g>
						</svg>
					</a>
				</div>

				<div class="bouton">
					<a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/03-communication-et-goodies/" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">"goodies"</text>
							</g>
						</svg>
					</a>
				</div>
				<!--
				<div class="bouton">
					<a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/regles-conseils/" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">règles et conseils</text>
							</g>
						</svg>
					</a>
				</div>
			-->

				<div class="bouton">
					<a href="/editions-en-video">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">éditions en vidéo</text>
							</g>
						</svg>
					</a>
				</div>			

				<div class="bouton mb-3">
					<a href="/jeux-ndc">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">jeux ndc</text>
							</g>
						</svg>
					</a>
				</div>

				<!--
				<div class="bouton mb-4">
					<a href="images">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#cf63cf" stroke="#bd42bd" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">logos & affiches</text>
							</g>
						</svg>
					</a>
				</div>
			-->

				<div class="bouton mt-2">
					<a href="https://github.com/nuitducode/ORGANISATION-2025/discussions" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" width="150" viewBox="0 0 241 58">
							<g aria-label="scratchbox" font-size="1.5em" color="#ffffff" fill="#ffffff" font-family="Nunito" font-weight="400" letter-spacing="0" style="line-height:1.25" word-spacing="0">
						    	<path fill="#9966ff" stroke="#774dcb" d="M0.5 4.5a4 4 0 0 1 4-4h8c2 0 3 1 4 2l4 4c1 1 2 2 4 2h12c2 0 3-1 4-2l4-4c1-1 2-2 4-2h188a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4h-188c-2 0-3 1-4 2l-4 4c-1 1-2 2-4 2h-12c-2 0-3-1-4-2l-4-4c-1-1-2-2-4-2h-8a4 4 0 0 1-4-4z"/>
								<text x="0.7em" y="1.6em">discussions</text>
							</g>
						</svg>
					</a>
				</div>

				<br />
				<a href="https://mastodon.social/@nuitducode" target="_blank">
					<button type="button" class="btn btn-light btn-sm text-muted ml-1 mr-1 pt-2">
						<i class="fa-brands fa-mastodon"></i>
					</button>
				</a>
				<a href="https://x.com/nuitducode" target="_blank">
					<button type="button" class="btn btn-light btn-sm text-muted ml-1 mr-1 pt-2">
						<i class="fa-brands fa-square-x-twitter"></i>
					</button>
				</a>
				<br />
				<br />						
				<br />						
				<div class="text-monospace small pl-4 pr-4" style="color:#4782b5;text-align:justify">L'Association des Enseignantes et Enseignants d'Informatique de France (AEIF) soutient cette action permettant à des élèves de se retrouver pour programmer un jeu dans une ambiance conviviale.</div>
				<div class="text-align:center;"><a href="https://aeif.fr" target="_blank" data-toggle="tooltip" data-placement="top" title="Association des Enseignantes et Enseignants d'Informatique de France"><img src="{{ asset('img/aeif.png') }}" width="100" /></a></div> 
			</div>

		</div><!-- row -->

	</div><!-- container -->

	@include('inc-footer')
	@include('inc-bottom-js')

</body>
</html>
