<div class="text-center">
	
	<div id="player_{{$jeu->id}}" class="pt-1 mb-1" style="border-radius:4px;width:100%;height:420px;background-color:#855CD6;">
		<img src="{{ asset('img/scratch-cat.png') }}" style="width:100px;position:relative;top:30%" />    
	</div>										

	<button type="button" class="btn btn-primary btn-sm mt-3" onClick="this.previousElementSibling.innerHTML='<iframe id=\'iframe_{{$jeu->id}}\'  src=\'https://turbowarp.org/embed?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{strtolower($etablissement_jeton)}}/{{$jeu->scratch_id}}.sb3\' width=\'100%\' height=\'402\' allowtransparency=\'true\' frameborder=\'0\' scrolling=\'no\'></iframe>'">lancer / recharger le jeu</button>

	<button type="button" class="mt-3 btn btn-light btn-sm ml-3 pl-3 pr-3" onclick="fullscreen('iframe_{{$jeu->id}}')" data-toggle="tooltip" data-placement="right" data-title="mode plein écran"><i class="fas fa-expand"></i></i></button> 

	<div class="mt-4 mb-2 text-monospace small" style="text-align:justify;color:silver">Si vous voulez voir le code ou si le jeu ne s'affiche pas correctement, vous pouvez l'ouvrir dans un autre onglet en cliquant sur <a href="https://turbowarp.org?project_url=www.nuitducode.net/storage/depot-jeux/scratch/{{strtolower($etablissement_jeton)}}/{{$jeu->scratch_id}}.sb3" target="_blank">ici</a>.</div>

	<div class="mt-2 small text-monospace text-left" style="overflow-wrap: break-word;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
		{!! nl2br(e($jeu->documentation)) !!}
	</div>
	
</div>