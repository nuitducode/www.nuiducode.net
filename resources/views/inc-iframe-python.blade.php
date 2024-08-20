<div class="text-center">

	<div  class="rounded pt-1 mb-1" style="aspect-ratio:1/1;background-color:#202224;">
		<img src="{{ asset('img/pyxel_evaluation.png') }}" style="position:relative;top:40%" />    
	</div>
	
	<div id="warning_{{$jeu->id}}" class="pl-4 pr-1 mb-1 text-monospace text-danger text-left" style="font-size:75%;display:none;">
		<ul class="m-0 p-0">
			<li>ne pas cliquer en dehors du cadre du jeu après avoir cliqué sur "click to start" afin de ne pas perdre les commandes (souris / clavier).</li>
			<li>ne pas cliquer sur le mode plein écran après avoir cliqué sur "click to start".</li>
		</ul>
	</div>
	
	<button type="button" class="mt-3 btn btn-primary btn-sm" onClick="this.previousElementSibling.previousElementSibling.innerHTML='<iframe id=\'player_{{$jeu->id}}\' src=\'/ndc/evaluation-pyxel-player/{{ Crypt::encryptString($jeu->etablissement_jeton . '-' . $jeu->python_id) }}\' width=\'100%\' height=\'100%\' frameborder=\'0\' scrolling=\'no\'></iframe>';document.getElementById('warning_{{$jeu->id}}').style.display='block';">lancer / recharger le jeu</button> 
	
	<button type="button" class="mt-3 btn btn-light btn-sm ml-3 pl-3 pr-3" onclick="fullscreen('player_{{$jeu->id}}')" data-toggle="tooltip" data-placement="right" data-title="mode plein écran"><i class="fas fa-expand"></i></i></button> 

	<div class="mt-4 mb-2 text-monospace small" style="text-align:justify;color:silver">Si le jeu ne s'affiche pas correctement, vous pouvez utiliser ce <a data-toggle="collapse" href="#collapse_{{$jeu->id}}" role="button" aria-expanded="false" aria-controls="collapse_{{$jeu->id}}">code Python</a>.</div>

	<div class="collapse mb-4" id="collapse_{{$jeu->id}}">	

<pre class="m-0 text-left"><code id="htmlViewer" style="color:rgb(216, 222, 233); font-weight:400;background-color:rgb(46, 52, 64);background:rgb(46, 52, 64);display:block;padding: 1.5em;border-radius:5px;"><span style="color:rgb(129, 161, 193); font-weight:400;">import</span> requests, os
codes = <span style="color:rgb(163, 190, 140); font-weight:400;">'{{$jeu->etablissement_jeton}}/{{$jeu->python_id}}'</span>
site = <span style="color:rgb(163, 190, 140); font-weight:400;">'https://www.nuitducode.net'</span>
url = site + <span style="color:rgb(163, 190, 140); font-weight:400;">'/storage/depot-jeux/python/'</span> + codes
@foreach($files as $file)
<span style="color:rgb(129, 161, 193); font-weight:400;">{{pathinfo($file, PATHINFO_EXTENSION)}}</span> = requests.<span style="color:rgb(129, 161, 193); font-weight:400;">get</span>(url + <span style="color:rgb(163, 190, 140); font-weight:400;">'/{{basename($file)}}'</span>)
with <span style="color:rgb(129, 161, 193); font-weight:400;">open</span>(<span style="color:rgb(163, 190, 140); font-weight:400;">'{{basename($file)}}'</span>, <span style="color:rgb(163, 190, 140); font-weight:400;">'wb'</span>) <span style="color:rgb(129, 161, 193); font-weight:400;">as</span> file:
    file.write(<span style="color:rgb(129, 161, 193); font-weight:400;">{{pathinfo($file, PATHINFO_EXTENSION)}}</span>.content)
@endforeach
@foreach($files as $file)
@if(pathinfo($file, PATHINFO_EXTENSION) == 'py')
print(<span style="color:rgb(129, 161, 193); font-weight:400;">py</span>.content.<span style="color:rgb(129, 161, 193); font-weight:400;">decode</span>())
os.system(<span style="color:rgb(163, 190, 140); font-weight:400;">'pyxel run "{{basename($file)}}"'</span>)
@endif
@endforeach
</code></pre>

		<div class="text-monospace text-muted p-2" style="text-align:justify;font-size:70%;">
			Copier-coller ce code dans un environnement Python possédant la bibliothèque <a href="https://github.com/kitao/pyxel/" target="_blank">Pyxel</a> pour lancer le jeu.<br />
			Pour installer un environnement Python + Pyxel, voir la <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/02-installation/" target="_blank">documentation</a>.
		</div>
	</div>

	<div class="mb-2 text-left text-monospace small" style="color:silver">Afficher les <a data-toggle="collapse" href="#fichiers_{{$jeu->id}}" role="button" aria-expanded="false" aria-controls="fichiers_{{$jeu->id}}">fichiers</a>.</div>

	<div class="collapse mb-4" id="fichiers_{{$jeu->id}}">
		<ul class="list-group text-left small text-monospace">
		@foreach($files as $file)
			<?php
			if(pathinfo($file, PATHINFO_EXTENSION) == 'py') {
				$fichier_py = $file;
			}
			?>
			<li class="list-group-item d-flex justify-content-between align-items-center p-2 pl-3 pr-3">
				{{basename($file)}}
				<a href="/storage/fichiers_pyxel/{{$jeu->etablissement_jeton}}-{{$jeu->python_id}}/{{basename($file)}}" class="text-secondary" download><i class="fa-solid fa-circle-arrow-down"></i></a>
			</li>
		@endforeach
		</ul>
	</div>

	<div class="mt-2 small text-monospace text-left" style="overflow-wrap: break-word;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
		{!! nl2br(e($jeu->documentation)) !!}
	</div>

</div>
