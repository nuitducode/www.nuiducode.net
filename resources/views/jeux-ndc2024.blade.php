<?php

// GENERATION DES DONNEES
// Scratch
/*
$jeux_scratch = [
    "C3" => [908, 979, 410, 2108, 2592, 1623],
    "C4" => [2161, 983, 924, 2289, 2290, 812, 2127, 2585,1408],
    "LY" => [922, 484, 1797, 1383, 1967, 1804]
];

foreach($jeux_scratch AS $cat => $jeux){
    $n = 1;
    foreach($jeux AS $id){
        $jeu = App\Models\Game::where([['id', '=', $id]])->first();
        $etablissement = App\Models\User::where([['id', '=', $jeu->etablissement_id]])->first();
        
        echo htmlentities('$'.$cat.'_'.$n.'=["'.$jeu->scratch_id.'", "'.$jeu->nom_equipe.'", "'.$etablissement->etablissement.'<br />'.$etablissement->ville.' - '.$etablissement->pays.'", "'.addslashes(nl2br($jeu->documentation)).'"];')."<br />";
        $n++;
    }
}

exit;
*/



/*
// Python
$jeux_python = [
    //"PI" => [],
    //"POO" => [],
	"PI" => [1368, 1954, 1227, 1840, 2342, 2474, 2568, 1487, 110, 477, 115, 125, 2141],
];

foreach($jeux_python AS $cat => $jeux){
    $n = 1;
    foreach($jeux AS $id){
        $jeu = App\Models\Game::where([['id', '=', $id]])->first();
        $files = File::files(storage_path("app/public/depot-jeux/python/".$jeu->etablissement_jeton.'/'.$jeu->python_id));
        $etablissement = App\Models\User::where([['id', '=', $jeu->etablissement_id]])->first();
		$file_0 = isset($files[0])?basename($files[0]):'';
		$file_1 = isset($files[1])?basename($files[1]):'';
        echo htmlentities('$'.$cat.'_'.$n.'=["'.$jeu->etablissement_jeton.'-'.$jeu->python_id.'", "'.$jeu->nom_equipe.'", "'.$etablissement->etablissement.'<br />'.$etablissement->ville.' - '.$etablissement->pays.'", "'.$file_0.'", "'.$file_1.'", "'.addslashes(nl2br($jeu->documentation)).'"];')."<br />";
        $n++;
    }
}

exit;
*/
?>

@include('inc-top')
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.svg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <!-- <script src="https://kit.fontawesome.com/692fbff6c4.js" crossorigin="anonymous"></script> -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Open Graph -->
    <meta property="og:title" content="Nuit du Code 2024 - Sélection internationale" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée / Post-bac." />
    <meta property="og:url" content="https://www.nuitducode.net/ndc2024" />
    <meta property="og:image" content="{{ asset('img/open-graph-selection-2024.png') }}" />
    <meta property="og:image:alt" content="Nuit du Code" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@nuitducode">
    <meta name="twitter:creator" content="@nuitducode">
    <meta name="twitter:title" content="Nuit du Code 2024 - Sélection internationale">
    <meta name="twitter:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée / Post-bac.">
    <meta name="twitter:image" content="{{ asset('img/open-graph-selection-2024.png') }}">

    <!-- Matomo - données anonymisées - pas de cookies - RGPD -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//www.awame.net/matomo/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '10']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->  

    <title>Nuit du Code 2024 | La sélection internationale</title>
</head>
<body>
    
    <div class="container mb-5">
		<div class="row">

			<div class="col-md-12">

                <div class="row text-monospace mt-4">
                    <div class="col-md-3 text-left">
                        <a class="btn btn-light btn-sm" href="/jeux-ndc" role="button"><i class="fas fa-arrow-left"></i></a>
                    </div>                    
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('img/ndc2024.png') }}" width="280" />
                        <div class="font-weight-bold mt-2" style="font-size:12px;color:gray">~ 8<sup>e</sup> édition ~</div>
                        <div class="font-weight-bold" style="font-size:17px;color:#261b0c;">Les jeux 2024!</div>
                        <p class="mt-2 text-monospace small" style="text-align:justify">Toutes catégories confondues, plus de 4000 jeux ont été créés lors cette 8<sup>e</sup> édition de la Nuit du Code. Vous trouverez, ci-dessous, la sélections des jeux 2024. Bravo aux élèves et à leurs enseignants. Amusez-vous bien!</p>
						<div class="mt-2 text-monospace text-success small text-center">Rappel: ces jeux ont été créés en 6h seulement</div>
						
						<div class="mt-3 mb-4 text-monospace small text-center" style="color:silver;">
							<?php
							$twitter_text = urlencode("Nuit du Code 2024: la sélection internationale \n ➡️ www.nuitducode.net/ndc2024 \n\n #NDC2024 #Scratch #Python #NSI #SNT \n @nuitducode");
							$mastodon_text = urlencode("Nuit du Code 2024: la sélection internationale \n ➡️ www.nuitducode.net/ndc2024/ \n\n #NDC2024 #Scratch #Python #NSI #SNT \n @nuitducode@mastodon.social");
							?>
							Partagez cette page sur <a href="https://mastodonshare.com/?text={{$mastodon_text}}" target="_blank">Mastodon</a> et/ou <a href="https://twitter.com/intent/tweet?text={{$twitter_text}}" target="_blank">Twitter</a>.
						</div>							
						
                    </div>  
				
                </div>

                <div class="mt-3 pt-2 pb-2 text-center text-monospace sticky-top" style="background-color:#f8fafc">
                    <?php
                    // Catégories
                    //$categories = ['C3' => 'Scratch CM1 > 6<sup>e</sup>', 'C4' => 'Scratch 5<sup>e</sup> > 3<sup>e</sup>', 'LY' => 'Scratch Lycée', 'PI' => 'Python NSI 1<sup>re</sup>', 'POO' => 'Python NSI Tle'];
					$categories = ['C3' => 'Scratch CM1 > 6<sup>e</sup>', 'C4' => 'Scratch 5<sup>e</sup> > 3<sup>e</sup>', 'LY' => 'Scratch Lycée', 'P' => 'Python'];
                    foreach ($categories AS $balise => $categorie) {
                        echo '<a class="btn btn-primary btn-sm mb-1 ml-1 mr-1" href="#'.$balise.'" role="button">'.$categorie.'</a>';
                    }
                    ?>
                </div>

                <?php           
				$C3_1=["1041570777", "les lapins", "Lycée Français International de Tokyo<br />Tokyo - Japon", "Maintenant, nous sommes des policiers spatiaux. On a besoin de tuer les aliens qui sont des spaces invaders. Partons en mission!Quoi? Il y a un gros problème? Les aliens lancent des astéroïdes?! Si c\'est comme ça, faisons très attention et enfuyons des astéroïdes.Nous aussi, on a 2 items. Attention à ne pas rater les items et cette fois, partons vraiment en mission!!<br /> <br /> Comment jouer<br /> Faites bouger le vaisseau spatial avec le boutons droit et gauche.Le vaisseau tire les balles automatiquement. Il y a 3 types de balle: Ceux avec 1 balle et 1 degas, 2 balle et 2 degas, 3 balle et 3 degas. Les 5 aliens ont 30 vies ; Vous pouvez les remarquer vers le au haut de l\'écran. Ils vous lancent des astéroïdes toutes les 1 à 3 secondes. Ils avancent petit à petit, ci ils atteignent le bord, vous pouvez plus les tirer dessus. Après 20 secondes, un item pour guérir va tomber. Au bout de 30 secondes, un autre item pour tirer beaucoup plus rapidement va tomber. Vous avez 9 vies. Faites attention à ne pas toucher les astéroïdes et tuer les aliens."];
				$C3_2=["1041578047", "HetKStudios", "The École<br />New York - États-Unis d'Amérique", "Bienvenue dans l\'espace ! <br /> Ici, tu diriges un vaisseau avec la souris ou le pad de ton ordinateur.<br /> Tu peux tier en cliquant. <br /> Attention, les aliens sont très dangereux et il suffit qu\'un seul ne te touche pour que tu perdes le jeu.<br /> Tu dois donc être très rapide ! <br /> Bon courage !"];
				$C3_3=["1041577541", "MiLAm", "Collège Marcel Pagnol<br />Asuncion - Paraguay", "Vous etes poursuivi par les pirates !! Vite, il faut atteindre le drapeau !!<br /> Utilisez les fleches pour vous deplacer.<br /> Evitez TOUS les obstacles... Sinon... il faut tout recommencer...<br /> Bonne chance !!<br /> ......................................................................................................................................................................................................."];
				$C3_4=["1041577369", "Lilia Ghali Sami", "Elbilia Skolar Bouskoura<br />Casablanca - Maroc", "Bonjour, aujourd\'hui nous allons vous présenter notre jeu: Space shooter<br /> Nous avons été inspirés d\'un jeu que nous avons déjà connu.<br /> -----------------------------------------------------------------------------------------------------<br /> * Voici les règles du jeu:<br /> <br /> 1:Vous êtes le vaisseau, votre rôle est de tuer les extraterrestres; sinon vous perdez<br /> 2:Pour bouger il faut vous déplacer grâce aux flèches directionnelles: droite, gauche, haut et bas <br /> 3:Pour tuer les EXT il faut appuyer sur la touche espace pour lancer un missile<br /> 4:Ne pas toucher les fantômes car chaque fantômes vous enlève une vie.<br /> 5:Et surtout: Amusez vous bien!!!!!!!<br /> <br /> La galaxie a besoin d\'aide, Sauvez la!!!"];
				$C3_5=["1041577026", "Blaster Game", "Collège ARIANE<br />Vernon - France", "Pour commencer à jouer, il faut cliquer sur Start. Le but est de tirer sur les astéroïdes avant d\'être détruit. Le joueur a 3 vies. Il peut récupérer des bonus pour guérir ou tirer de façon plus forte. Bon jeu !"];
				$C3_6=["1041578401", "Lorju", "Lycée français Jules Verne de Johannesburg<br />Johannesburg - Afrique du Sud", "Nom du jeu: l’Aventure de Renard <br /> <br /> <br /> Vous êtes un renard pilleur de tombes. <br /> <br /> Vous cherchez un trésor, mais attention aux ennemis placés tout le long. A la fin, vous devrez charmer le boss final en utilisant les bons mots. <br /> <br /> Pour vous déplacez à droite et à gauche, utilisez les flèches de droite et gauche. Pour voler, appuyez sur la barre espace et pour redescendre la gravité effectuera son travail. <br /> <br /> Pour commencer le jeu, appuyez sur le drapeau vert. Pour passer au niveau 2, activez le levier. Pour passer au niveau 3, passez par la porte. <br /> <br /> Si vous voulez être riches, récupérez les pièces en chemin mais gare aux pièges !"];
				
				$C4_1=["1042043929", "Eternal_CrazY", "Collège Paul Duez<br />Leforest - France", "Bien le bonjour Pirate en herbe !<br /> Imagine que tu es sur ta belle île civilisée quand, soudain, un invasion de Pirates maléfiques surgit à l\'horizon pour piller vos trésors !<br /> Ton sang ne fait qu\'un tour, tu enfiles tes bottes, montes sur ton bateau et tu vas remonter les bretelles de ces satanés voyous !<br /> <br /> ==============================Les Touches========================================<br /> <br /> Les touches sont très simples, diriges toi grâce à la souris et fais \"clique gauche\" pour lancer tes boulets de canons.<br /> <br /> Bonne chance, valeureux Pirate !<br /> <br /> =============================Les Différents Bateaux=================================<br /> <br /> Les bateaux ont des pouvoir différents :<br /> <br /> -Le bateau Vert : c\'est le plus simple des bateaux, il avance normalement et ne tires pas de boulets.<br /> <br /> -Le bateau Jaune : un bateau coriace qui avance trois fois plus vite que la normale<br /> <br /> -Le bateau Bleu : bateau assez résistant, nécessite 3 coups pour menez à ses fins<br /> <br /> -Le bateau Rouge : un bateau qui prend ses distances mais tire des boulets de canon<br /> <br /> -Le bateau Noir : c\'est le Boss des bateaux ! Étant très lent, il faut 10 coup pour le faire couler."];
				$C4_2=["1042043924", "La bombe VS Le fou", "Lycée Français René Descartes<br />Phnom Penh - Cambodge", "Votre camarade de bord a perdu la tête, il veut tous vous tuer ! et il est très tenace, il n’abandonne jamais !<br /> Pour l’arrêter, vous devrez lui faire exploser un maximum de bombes sous le nez avant que tous vos autres camarades soient morts. Pour cela appuyer sur:<br /> - Espace pour activer la bombe ( et commencer à bouger)<br /> - Q pour aller à droite<br /> - D pour aller à gauche<br /> - Z pour sauter<br /> La bombe met 7 secondes avant d’exploser.<br /> <br /> Faites attention aux bougies, elles feront exploser votre bombe immédiatement."];
				$C4_3=["1042043918", "lolipophfs", "Lycée Français de Séoul<br />Séoul - Corée du Sud", "PRÉSENTATION:<br /> Ce jeu est basé sur un pingouin, venu d\'une autre planète, qui ADORE les pièces en or et qui veut être milliardaire! Dans chacun des niveaux, le but est de survivre aux boulets de canon et aux bombes, tout en trouvant les clés pour obtenir les pièces. Bonne chance!<br /> <br /> MODE D\'EMPLOI DU JEU:<br /> Pour jouer ce jeu, contrôlez le pingouin grâce aux flèches sur le clavier (↑,↓,→,←, WASD ou QZSD) et déplacez les clés que vous venez d\'obtenir pour ouvrir les coffres, en déplaçant votre souris."];
				$C4_4=["1042043909", "Les tireurs d elites", "Collège les fontaines<br />Bouillargues - France", "Notre jeu est un jeu de tir pour lequel il faut tirer sur les aliens qui apparaissent en haut de la scène pour gagner le plus de points.<br /> Les touches à utiliser pour le bon fonctionnement du jeu sont :<br /> -La touche 0 pour (re)commencer. Lors de l’animation Game Over, pour recommencer, double cliquez sur 0.<br /> -La touche flèche droite pour le déplacement droit de l’avion spatio-galactique.<br /> -La touche flèche gauche pour le déplacement gauche de l’avion spatio-galactique.<br /> -La touche flèche haute pour l’utilisation des missiles.<br /> -La touche espace pour augmenter ou diminuer le volume des sons.<br /> Il existe de nombreux avantages comme la mallette de soins qui apparaît tous les 15 aliens tués, le bouclier qui apparait tous les 50 aliens tués et l’amélioration de l’artillerie qui apparait tous les 100 aliens tués, doublant l’attaque. <br /> Pour voir votre record, attendez le début de l\'animation.<br /> Bon jeu !"];
				$C4_5=["1042043881", "Humains en pain", "Collège les fontaines<br />Bouillargues - France", "Bienvenues sur ce jeu de survie en joueur contre ennemis !<br /> Votre objectif est de survivre face aux différents bateaux ennemis. Vous pouvez tourner votre bateau avec la flèche de gauche et la flèche de droite et avancez et reculez avec la flèche du haut et la flèche du bas. Vous pouvez aussi tirer à votre gauche et à votre droite en appuyant sur Q ou D (retenez que vous ne pouvez tirer que toutes les 2 secondes). Pour éviter la noyade, réparez votre bateau en vous plaçant sur les planches qui apparaissent aléatoirement sur l\'eau.<br /> Bonne chance preux marin !"];
				$C4_6=["1042043903", "Friands au fromage", "Collège St Joseph<br />Chantonnay - France", "Bienvenue dans « Les aventures de MR. SLIME !»<br /> <br /> Ce jeu d’aventure où vous êtes un slime est fait pour vous divertir. Attraper la ou les pièce(s) pour passer au niveau suivant. Bonne chance ! <br /> Commandes : <br /> - Flèches droite et gauche pour se déplacer <br /> - Espace pour sauter<br /> Et attention, seules les pièces grise, jaune, les bonshommes de neige et l’éclair en bronze sont inoffensifs.<br /> Certaines choses tuent en un seul coup le joueur. A vous de tout découvrir.<br /> Amusez-vous ! <br /> Développement :<br /> - Niveau 1 : Pablo (Niveau du marteau piqueur)<br /> - Niveau 2 : Dorian (Niveau du lanceur d’escargot)<br /> - Niveau 3 : Anatole (Niveau enneigé)<br /> <br /> <br /> La team des friands au fromage."];
				$C4_7=["1042043895", "FADE_lfo", "Lycée Français d'Oslo<br />Oslo - Norvège", "Le but du jeu s\'agit d\'aider les aliens en récupérant les 4 power-UPS le plus vite possible.<br /> Déplacez vous avec les flèches du clavier ou les touches A, W, S et D. <br /> Il est important d\'éviter les missiles envoyés par les vaisseaux spaciaux, car si vous êtes touchés 3 fois, toutes vos vies sont perdues et c\'est game over !"];
				$C4_8=["1042043888", "Les sprinteurs", "Collège François Truffaut<br />Betton - France", "Aidez petit Renard a accomplir sa quête mais méfiez vous des autres animaux qui feront tout pour lui nuire...<br /> - Déplacez vous en utilisant les flèches du clavier pour aller de gauche a droite<br /> - Appuyez sur la touche espace pour sauter<br /> - Terminez les 6 niveaux et gagnez la partie en tuant le Rat Géant !"];
				$C4_9=["1042171086", "Taipei Equipe 2", "Lycée français de Taipei<br />Taipei - Taïwan", "Le but est de sauver tous les animaux, le problème est qu\' il y a plein de blocs qui les retiennent. Détruisez-les tous pour récupérer les 10 animaux en 1 min. Vous ne pouvez tirer qu\'une seule balle a la fois.<br /> - La flèche de droite pour aller à droite<br /> - La flèche de gauche pour aller à gauche<br /> - La touche espace pour tirer<br /> - La flèche du bas est pour lancer la clé au coffre, pour sauver le dernier animal"];
				
				$LY_1=["1042045612", "Les GOATs", "Lycée Français de Séoul<br />Séoul - Corée du Sud", "Mode d\'emploi :<br /> Flèches directionnelles pour se déplacer<br /> MAINTENIR ESPACE pour attaquer<br /> Pour passer au niveau suivant, il faut atteindre la porte. Attention aux ennemis ! Boitix le boiteux, Popex le teigneux et le fidèle canon de Bombix lui-même !<br /> Chaque niveau a été testé pour qu\'il puisse être remporté.<br /> ***<br /> Arrows to move<br /> HOLD SPACE to attack<br /> To get to the next level, reach the door. Beware of the enemies! Boitix the limping, Popex the stingy and the Bombix\'s canon itself!<br /> Each level has been tested and can be completed.<br /> ***<br /> Présentation :<br /> Vous êtes le plus terrible des pirates : Eduardo le Chauve ! Malheureusement, au large du Goatland, vous vous êtes fait kidnappé par le terrible Bombix ! Pourrez-vous vaincre contre cette bande de marins d\'eau douce ? A vous de voir!<br /> ***<br /> Presentation :<br /> You\'re the most dangerous of pirates : Eduardo the Bald! Unfortunately, you were kidnapped off the coast of Gotland by the terrible Bombix! Will you be able to win against this gang of fishmongers? It\'s all up to you!<br /> ***<br /> Enjoy the game!<br /> Bon jeu !<br /> <br /> Les GOATs"];
				$LY_2=["1042045602", "FDA team", "Lycée Jean Guéhenno<br />Fougères - France", "Jeu de plateforme, boss et accueil.<br /> Touche:<br /> -flèche droit :aller a droite<br /> -flèche gauche: aller a gauche<br /> -flèche du haut : sauter (ne peut plus sauter au boss)<br /> <br /> nous avons mélanger des style différent pour vous crée une expérience unique.<br /> ⚠️certaine plateforme sont trompeuse ;) ⚠️"];
				$LY_3=["1042045603", "Protector game", "Lycée Français de Berlin<br />Berlin - Allemagne", "Dans un futur lointain, la Terre est menacée par une invasion extraterrestre menée par les redoutables Zorvians. Vous incarnez le commandant Alex Vega, un pilote d\'élite à bord du \"Star Defender\", le dernier rempart de l\'humanité. Votre mission : repousser vague après vague de vaisseaux ennemis pour protéger la planète. La survie de la Terre repose sur vos compétences et votre détermination. Préparez-vous à défendre l\'humanité et à vaincre les envahisseurs !<br /> <br /> Déplace-toi avec les flèches de mouvement.<br /> Tire des lasers avec la touche espace.<br /> Ramasse des bonus pour t´aider dans ton aventure, tout en esquivant les astéroïdes et en te créant un passage en tuant les ennemis et en les évitant."];
				$LY_4=["1042045592", "Les JB", "Lycée Emile Duclaux<br />Aurillac - France", "Mission Comète<br /> <br /> Le but est de détruire les extraterrestres tout en évitant les comètes. <br /> <br /> Commandes : -pour se diriger, il faut utiliser les flèches du clavier.<br /> -pour tirer, il faut appuyer sur la touche espace.<br /> -pour attraper les bonus, il faut y passer dessus."];
				$LY_5=["1042045591", "Les Trois M", "Lycée Blaise Pascal<br />Rouen - France", "Description<br /> <br /> Bomber Pirates est un jeu de plateforme et de combat dans l’univers des pirates. L’objectif du joueur est de récupérer plus de gemme face au PNJ en 2 minutes. Le jeu offre une<br /> possibilité de combat avec des lancées de bombes.<br /> <br /> Mode d’emploi<br /> <br /> Déplacement Gauche-Droite: flèche de gauche et de droite<br /> Saut: flèche du haut<br /> Récupération des objets et des gemmes: aller dessus<br /> Lâcher un objet: touche 0 du pavé numérique<br /> Tirer au canon: aller au canon avec une bombe puis clic gauche"];
				$LY_6=["1042045584", "prograrenard", "Lycée Français de Berlin<br />Berlin - Allemagne", "Renardeau en Cavale<br /> **********************<br /> Grand Méchant a enlevé la famille de Renardeau. Il doit franchir plusieurs défis pour les retrouver. Mais attention ! Défis piégés !<br /> <br /> Pour bouger latéralement, on utilise les flèches droite-gauche et pour sauter, la flèche haut."];
				
				$PI_1=["l2af-lcbvr", "Dodo_Magique21", "Lycée Charles Peguy<br />Gorges - France", "4.pyxres", "app.py", "Univers choisie : 4<br /> Le but : Trouver 3 clé 🔑 de différente couleur et de sortir à la surface 🏕️ par les 3 portes 🚪 de <br /> couleurs lorsque tu a lancer le jeu 🎮 tout en faisant attention ⚠️ aux monstres 👹 qui <br /> pourrait s\'y cacher. 🤐<br /> <br /> Déplacement : Z pour monter 👆<br /> S pour descendre 👇<br /> Q pour aller a gauche 👈<br /> D pour aller a droite 👉"];
				$PI_2=["shfk-qslg7", "arachnophobia", "Lycée Blaise Pascal<br />Rouen - France", "3.pyxres", "app.py", "Dans ce jeu vous incarnez Thomas, une personne arachnophobe qui en a eu marre et a décidé de se débarrasser de toutes les araignées dans le monde.<br /> <br /> Pour se déplacer utilisez les touches Z, Q, S et D.<br /> Pour tirer maintenez la touche espace.<br /> Pour dash (déplacement à haute vitesse sur courte distance distance) appuyez sur E en maintenant une direction, il y a ~4-5 secondes entre chaque utilisations."];
				$PI_3=["rscb-jahcv", "The Robot", "Lycée Saint-André<br />Niort - France", "app.py", "", "Les JO pyxel 2024<br /> <br /> Voici notre projet de la nuit du code portant sur les JO. Nous avons créé 5 mini-jeux qui sont les tirs aux but, le lancer de poids, le lancer de javelo, le 100 mètres et le 110 mètres haies. Vous pouvez y accéder à l’aide du menu contenant deux pages. Vous pouvez naviguer entre les pages grâce aux flèches du clavier.<br /> Pour chaque jeu vous pouvez revenir au menu grâce à la touche M.<br /> <br /> Pour jouer ou relancer une partie du 110 mètres haies il vous suffit d’appuyer sur H : <br /> <br /> Le but du jeu est de tenir le plus longtemps sans mourir pour obtenir le score le plus élevé possible. Pour ne pas mourir il vous faut sauter par dessus les haies.<br /> <br /> Les commandes : Le personnage avance tout seul pour le faire sauter il vous suffit d’appuyer sur espace<br /> <br /> Pour jouer ou relancer une partie du 100 mètres haies il vous suffit d’appuyer sur J : <br /> <br /> Le but du jeu est d’aller le plus vite possible et de faire le meilleur temps. <br /> <br /> Les commandes : Pour faire accélérer le personnage il faut utiliser la barre espace. Plus vous appuyer vite plus le personnage ira vite<br /> <br /> Pour jouer ou relancer une partie de Tir au but il vous suffit d’appuyer sur T : <br /> <br /> Le but du jeu est de tirer dans le but sans que le gardien l’arrête<br /> <br /> Les commandes : Pour indiquer la direction de la balle utiliser la flèche que vous dirigez avec les flèches directionnelles du clavier.<br /> <br /> Pour jouer ou relancer une partie de lancer de javelot il vous suffit d’appuyer sur L : <br /> <br /> Le but du jeu est de lancer le javelot le plus loin possible.<br /> <br /> Les commandes : Il faut d’abord faire courir le personnage avec la touche directionnelle droite, puis lancer au bon moment le javelot. Trop tard et c’est game-over<br /> <br /> <br /> <br /> <br /> <br /> Pour jouer ou relancer une partie de lancer de poids haies il vous suffit d’appuyer sur R : <br /> <br /> Le but est de lancer le boulet le plus loin possible<br /> <br /> Les commandes : Appuyer simultanément sur les touche droite et gauche puis appuyer sur espace le plus proche de 150 (temps) pour lancer la boule le plus loin possible."];
				$PI_4=["dpmb-e63mh", "Funaratio", "Lycée Kernanec<br />Marcq-en-Barœul - France", "app.py", "theme2.pyxres", "(ce fichier est disponible en markdown sur https://f.dreamclouds.fr/nuitducode-2024/ )<br /> <br /> ⛏️ MIGHTY MINER<br /> Projet Nuit Du Code 2024 de Funasitien, Bugxit et Boss-MBD<br /> <br /> ℹ️ A propos du jeu<br /> Dans *MIGHTY MINER*, vous devez récupérer le plus de points possible en descendant dans la mine chercher des coffres - mais comme tout le monde vous ne savez pas voler.<br /> <br /> 🕹️ Controles<br /> Vous avez trois option quand vous ouvrez le jeu - *WASD*, *ZQSD* et *Flèches Directionnelles*. Vous pouvez changer à tout moment en appuyant sur *Entré* qui met le jeu en pause.<br /> <br /> 🗺️ Cartes<br /> 4 cartes sont disponibles. Vous pouvez changer de carte en utilisant la porte en bas du niveau. Chaque niveau est composé blocs; <br /> - Les blocs de terre, cassable par le joueur<br /> - Les tunnels, des espaces vides que le joueur peut traverser - mais pas survoler, il ne vole pas !<br /> - Les pierres, incasable par notre pauvre héro<br /> - Les coffres, qui augemente le score et offre deux secondes suplémentaires pour vivre dans la mine<br /> - Les Echelles, le seul moyen de remonter dans la mine<br /> - Les portes, qui permettent d\'accéder à un autre niveau"];
				$PI_5=["bej4-dqusg", "Les Cryptorchides", "Institut Saint Dominique<br />Pau - France", "3.pyxres", "app.py", "Bonjour à toi gamer,<br /> <br /> Ce jeu est une sorte de survivor.io, le but est de survivre le plus longtemps, tuer le plus de mouches, tuer le plus de mygales : être le/la meilleur(e) !<br /> <br /> Pour jouer c’est plutôt simple :<br /> - Z : Avancer <br /> - Q : Gauche<br /> - S : Reculer <br /> - D : Droite<br /> <br /> - Click droit : tirer <br /> - Curseur : viser<br /> - Attention, tu a un nombre de munitions limité, explore la carte pour en trouver<br /> - Explose les barils, tue des mouches et des mygales pour augmenter ton score<br /> - Tu peux tirer à travers les rochers, et les monstres peuvent passer par-dessus ceux-ci, par contre tu ne peux pas passer sur les rochers<br /> - S’il n’y a pas de rochers sur les bords, c’est que tu peux avancer sur la carte (attention, il faut avancer d’au moins une petite distance dans ta nouvelle portion de carte si tu veux revenir en arrière)<br /> <br /> Ne te laisse pas être mangé(e) et être tué(e) par les mygales !<br /> Soit le/la meilleur(e)…<br /> Bonne chance !"];
				$PI_6=["hyj7-uj6ae", "Les inseparables", "Lycée Pierre d'Aragon<br />Muret - France", "4.pyxres", "app.py", "Imaginez être dans une forêt pour un cueillette de champignons. Il faut d\'abord récupérer la clé pour entrer par la porte dans la forêt.<br /> Puis le but du jeu est de récupérer tous les champignons sans se faire toucher par un des lapins."];
				$PI_7=["4z8l-x5sy9", "voyageurs", "Saint Antoine<br />Phalsbourg - France", "40000.pyxres", "app.py", "Notre jeu s’intitule le voyageur. <br /> L’objectif est de récupérer les 20 clés.<br /> Si vous touchez les champignons, vous perdez une vie. <br /> utilisez la flèche de droite pour aller à droite<br /> utilisez la flèche de gauche pour aller à gauche<br /> utilisez la barre espace pour sauter, mais attention à ne pas tomber dans le vide...<br /> Il y a deux niveaux, pour réussir le 1e niveau vous devez récupérer les 11 clés présentes. Pour réussir le niveau 2 vous devez récupérer les 9 clés.<br /> Après quoi, vous décrocherez la victoire."];
				$PI_8=["g4sr-5sen9", "Spaceship", "Groupe scolaire St François d’Assise<br />Chambray-les-Tours - France", "1.pyxres", "app.py", "NUIT DU CODE<br /> <br /> ARGAUT Marie-France | JUIF Noé | GAUME Clément<br /> UNIVERS 1<br /> <br /> Description du jeu : Le vaisseau doit tirer sur les ennemies avant qu\'ils ne touchent le sol. Le vaisseau à 5 vies mais les perd un certain nombre de vies si un ennemie atteint le sol. Le but est d\'accumuler un maximum de score avant de mourir. <br /> Toutes les 15 secondes, les ennemis accélèrent.<br /> <br /> Contrôles : Z - déplacement vers le haut<br /> Q - déplacement vers la gauche<br /> S - déplacement vers le bas <br /> D - déplacement vers la droite<br /> ESPACE - tirer<br /> Echap - quitter le jeu en pleine partie<br /> CTRL – relancer la musique"];
				$PI_9=["jfuh-s6hxy", "Lemonish", "Lycée Le Verger<br />Sainte-Marie - France", "app.py", "theme2t.pyxres", "Vous incarnez une brave chercheuse de trésor qui n\'a pas peur du risque. <br /> Votre objectif est de ramasser 25 pièces pour gagner. Prenez garde aux dangers qui peuvent vous bloquer dans votre aventure et à la lave dans les profondeurs de la terre qui vous feront perdre de la vie.<br /> Vous avez 3 chances et vous ne pouvez pas remonter à la surface, utilisez donc les flèches de direction à bon escient.<br /> Bon courage chercheuse !"];
				$PI_10=["ejxc-g3n6c", "Totally_devs", "Lycée de la Vallée de Chevreuse<br />Gif-sur-Yvette - France", "4.pyxres", "app.py", "Au temps où les légendes contées par les anciens étaient de simples articles de journaux, où les seigneurs gouvernaient leurs terres d\'une main de fer, où les mages étaient de simples citoyens, Hildegarde s\'était bâtie une fortune grâce au crime et à la contrebande. Pour entreposer ses richesses, elle avait dirigé la construction d\'une bâtisse protégée par des sortilèges qui feraient pâlir le plus téméraire des voleurs. Mais le cours du temps est inarrêtable, et depuis plusieurs décennies, l\'influence des sortilèges sensés durer aussi longtemps qu\'existerait le monde s\'estompent. Cependant avec eux a aussi disparu la renommée des seigneurs d\'antan. Au détour d\'un sentier, un jeune métamorphe pose son regard sur une masure délabrée, vestige d\'un temps d\'abondance et de richesse. Les trésors qui s\'y trouvent le poussent inexorablement à traverser une prairie infestée de créatures belliqueuses et dévastée par des siècles de malédictions. <br /> <br /> <br /> Le joueur se déplace à l\'aide des flèches directionnelles, saute avec la flèche du haut, change d\'apparence en appuyant sur la flèche du bas. En mode humain, il frappe en effectuant une ruée en avant grâce à la barre espace et en mode champignon il saute beaucoup plus haut mais perd cette compétence. Le but est d\'arriver au drapeau situé à la fin du tableau afin d\'accéder au suivant en collectant les pièces et tuant les ennemis. Le jeu se termine une fois le drapeau damier atteint."];
				$PI_11=["nbzm-9ujen", "Slime Team", "Lycée Vaugelas - Lycée du Granier<br />Chambéry - France", "4.pyxres", "app.py", "# Slime Quest<br /> <br /> Par Gédéon Deveaux et Jules Courtiade-Vanin, la Slime Team.<br /> <br /> # Comment jouer<br /> <br /> Lancer le jeu, appuyer sur espace pour commencer.<br /> <br /> Pour se déplacer, utilisez les flèches et la barre espace pour sauter.<br /> <br /> Le but est de rammasser le plus de pièces ou d\'étoiles dans le temps imparti.<br /> Les pièces rapportent 1 point, l\'étoile argent 3 et l\'étoile dorée 5.<br /> <br /> N\'importe quelle collision recharge le saut (wall jump)."];
				$PI_12=["rc28-tsu5w", "AB2", "LGT Françoise Cabrini<br />Noisy-le-Grand - France", "4.pyxres", "app.py", "Nous avons choisi l\'univers 4. Notre jeu est un plateformer. <br /> Le but est donc d\'avancer au maximum vers la droite afin de terminer le niveau en prenant le drapeau rouge tout tentant de gagner un maximum de points.<br /> <br /> Système des touches:<br /> Q : se déplacer vers la gauche<br /> D : se déplacer vers la droite<br /> Espace : sauter<br /> <br /> La vie du joueur ainsi que ses points sont affichés en haut à gauche de l\'écran.<br /> Pour le système de points, une pièce jaune rapporte un point et un coffre rapporte dix points.<br /> La vie du joueur est bornée à deux et un coffre restaure une vie si nous n\'en avons plus qu\'une. <br /> Afin de rendre le jeu plus difficile, nous avons implémenté un type d\'ennemi (champignons) qui meurent uniquement si ils nous touchent et nous font perdre une vie que des piques argentés qui tuent instantanément le joueur (game over).<br /> Durant la partie, vous trouverez un mur de briques rouges. Afin de l\'ouvrir, il est nécessaire de trouver une clé rouge qui est cachée dans le niveau.<br /> Pour les joueurs les plus téméraires, il existe également des grottes qui recèlent de trésors et de pièces. N\'hésitez pas à vous y aventurer !"];
				$PI_13=["2rq5-pvlmn", "HellDevers", "IUT Orsay<br />Orsay - France", "3.pyxres", "app.py", "HellSpyders : Divers Redemption II : Fight the swarm !<br /> <br /> ------------------------------------------------------------<br /> ------------------------- A propos -------------------------<br /> ------------------------------------------------------------<br /> <br /> Etablissement : IUT d\'Orsay (niveau BUT 1)<br /> <br /> Nom de groupe : HellDevers<br /> <br /> Membres du groupe :<br /> <br /> |~~~~~~~~~~~~~~|<br /> | Alain SANDOZ |<br /> | Ash MERIENNE |<br /> | Naomie FAZER |<br /> |~~~~~~~~~~~~~~|<br /> <br /> ------------------------------------------------------------<br /> ----------------------- Présentation -----------------------<br /> ------------------------------------------------------------<br /> <br /> HellSpyders est un Shoot\'em Up de type défensif.<br /> <br /> Dans ce jeu, le joueur se met dans la peau d\'une araignée <br /> extraterrestre qui doit repousser des<br /> mouches, qui veulent se nourrir avec le nectar du nid.<br /> <br /> L\'araignée doit protéger son nid à tout prix ! La survie de <br /> son espèce en dépend.<br /> <br /> ------------------------------------------------------------<br /> ------------------------- Gameplay -------------------------<br /> ------------------------------------------------------------<br /> <br /> Le joueur se déplace en utilisant les touches Z,Q,S,D, et<br /> peut tirer des fils surpuissants avec le clic-gauche de la<br /> souris pour repousser et tuer les ennemis, les empêchant<br /> ainsi de s\'approcher du nid.<br /> <br /> Les fils sont envoyés dans la direction du viseur (qui <br /> lui-même suit la souris).<br /> <br /> ------------------------------------------------------------<br /> ------------------------ Power-ups -------------------------<br /> ------------------------------------------------------------<br /> <br /> Périodiquement, les bébés Spyders produisent un nectar<br /> permettant de solidifer le nid. Une fois récupéré par le<br /> joueur, le nectar d\'apparence verte rajoute 5 points de vie<br /> au nid.<br /> <br /> ------------------------------------------------------------<br /> ----------------------- Les mouches ------------------------<br /> ------------------------------------------------------------<br /> <br /> Les mouches se déplacent sur une ligne droite dans le but<br /> d\'atteindre le nid et se nourrir du nectar produit par les<br /> bébés."];
				

                $C3_jeux = [$C3_1, $C3_2, $C3_3, $C3_4, $C3_5, $C3_6];
                $C4_jeux = [$C4_1, $C4_2, $C4_3, $C4_4, $C4_5, $C4_6, $C4_7, $C4_8, $C4_9];
                $LY_jeux = [$LY_1, $LY_2, $LY_3, $LY_4, $LY_5, $LY_6];
                //$PI_jeux = [$PI_1, $PI_2, $PI_3,$PI_4,$PI_5,$PI_6,$PI_7,$PI_8,$PI_9,$PI_10,$PI_11];
                //$POO_jeux = [$POO_1];
				$P_jeux = [$PI_1, $PI_2, $PI_3, $PI_4, $PI_5, $PI_6, $PI_7, $PI_8, $PI_9, $PI_10, $PI_11, $PI_12, $PI_13];

                shuffle($C3_jeux);
                shuffle($C4_jeux);
                shuffle($LY_jeux);
                //shuffle($PI_jeux);
                //shuffle($POO_jeux);
				shuffle($P_jeux);

                $scratch_categories = [
                    "C3" => ["titre" => "SCRATCH<br />Sélection Cycle 3<br />(CM1 > 6<sup>e</sup>)", "description" => "\"Cycle 3\" (élèves du CM1 à la 6<sup>e</sup>)", "jeux" => $C3_jeux],
                    "C4" => ["titre" => "SCRATCH<br />Sélection Cycle 4<br />(6<sup>e</sup> > 3<sup>e</sup>)", "description" => "\"Cycle 4\" (élèves de la 6<sup>e</sup> à la 3<sup>e</sup>)", "jeux" => $C4_jeux],
                    "LY" => ["titre" => "SCRATCH<br />Sélection Lycée<br />(Seconde > Terminale)", "description" => "\"Lycée\" (élèves de la Seconde à la Terminale)", "jeux" => $LY_jeux]
                ];


                foreach($scratch_categories AS $balise => $scratch_categorie){
                    ?>

                    <div id="{{$balise}}" class="row pt-5">
                        <div class="col-md-3">
                            <h2 class="text-monospace" style="font-weight:bold;text-transform: capitalize;">{!! $scratch_categorie['titre'] !!}</h2>
                            <p class="text-monospace text-muted" style="font-size:70%;color:silver"><i>L'ordre d'affichage des jeux est aléatoire</i></p>
                        </div>
                  
                        <div class="col-md-9 pt-3">
                            <?php
                            foreach($scratch_categorie['jeux'] AS $jeu){
                                ?>
                                <div class="row mt-2">
								
                                    <div class="col-lg-4 order-md-2">
                                        <h3 class="text-dark pt-0 mt-0 mb-1">{{ $jeu[1] }}</h3>
                                        <div class="text-monospace text-muted small mb-2">{!! $jeu[2] !!}</div>

										<button type="button" class="btn btn-info" onClick="document.getElementById({{ $jeu[0] }}).innerHTML='<iframe id=\'iframe_{{$jeu[0]}}\' src=\'https://scratch.mit.edu/projects/{{$jeu[0]}}/embed\' width=\'100%\' height=\'402\' frameborder=\'0\' scrolling=\'no\' style=\'border-radius:5px\'></iframe>'">lancer / recharger le jeu</button>
 										
                                        <div class="mt-3 text-monospace text-muted mb-2" style="font-size:70%">Si le jeu ne s'affiche pas correctement,<br />vous pouvez l'ouvrir dans un autre<br />onglet en cliquant <a href="https://scratch.mit.edu/projects/{{ $jeu[0] }}" target="_blank">ici</a>.</div>
                                    </div> 
                                    
                                    <div class="col-lg-8 order-md-1">
                                        <div id="{{ $jeu[0] }}" style="padding:0px;">
											<img src="https://cdn2.scratch.mit.edu/get_image/project/{{ $jeu[0] }}_480x360.png" class="img-fluid" style="border-radius:4px;" width="100%" />
										</div>	
                                        <div class="small text-monospace text-left" style="overflow-wrap:break-word;margin-top:10px;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
                                            {!! $jeu[3] !!}
                                        </div>
                                    </div>
									
                                </div>

                                <br />
                                <br />
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }

                $python_categories = [
                    //"PI" => ["titre" => "PYTHON<br />Sélection Première NSI", "description" => "\"Première NSI\"", "jeux" => $PI_jeux],
                    //"POO" => ["titre" => "PYTHON<br />Sélection Terminale NSI", "description" => "\"Terminale NSI\"", "jeux" => $POO_jeux]
                    "P" => ["titre" => "PYTHON", "description" => "", "jeux" => $P_jeux]
                ];


                foreach($python_categories AS $balise => $scratch_categorie){
                    ?>

                    <div id="{{$balise}}" class="row pt-5">
                        <div class="col-md-3">
                            <h2 class="text-monospace" style="font-weight:bold;text-transform: capitalize;">{!! $scratch_categorie['titre'] !!}</h2>
                            <p class="text-monospace text-muted" style="font-size:70%;color:silver"><i>L'ordre d'affichage des jeux est aléatoire</i></p>
                        </div>
                  
                        <div class="col-md-9 pt-3">
                            <?php
                            $i = 0;
                            foreach($scratch_categorie['jeux'] AS $jeu){
                                $i++
                                ?>
                            <div class="row mt-4">


                                <div class="col-lg-4 order-md-2">
                                    <h3 class="text-dark pt-0 mt-0 mb-1">{{ $jeu[1] }}</h3>
                                    <div class="text-monospace text-muted small">{!! $jeu[2] !!}</div>

                                    <div class="mb-2">
										<?php
										$jeu_dossier = 'depot-jeux/python/'.str_replace("-", "/", $jeu[0]);
										?>
                                        <button type="button" class="btn btn-info mt-2" onClick="document.getElementById('player_{{$balise}}-{{$i}}').innerHTML='<iframe src=\'/jouer-pyxel-iframe/{{ Crypt::encryptString($jeu_dossier) }}\' width=\'100%\' height=\'100%\' frameborder=\'0\' scrolling=\'no\'></iframe>';document.getElementById('warning_{{$balise}}-{{$i}}').style.display='block';">lancer / recharger le jeu</button>  
                                        <button type="button" class="mt-2 btn btn-light ml-3 pl-3 pr-3" onclick="fullscreen('player_{{$balise}}-{{$i}}')" data-toggle="tooltip" data-placement="top" data-title="mode plein écran"><i class="fas fa-expand"></i></i></button> 
                                    </div>
									
									<div id="warning_{{$balise}}-{{$i}}" class="pl-4 pr-1 mt-3 mb-1 text-monospace text-danger text-left" style="font-size:75%;display:none;">
                                        <ul class="m-0 p-0">
                                            <li>ne pas cliquer en dehors du cadre du jeu après avoir cliqué sur "click to start" afin de ne pas perdre les commandes (souris / clavier).</li>
                                            <li>ne pas cliquer sur le mode plein écran après avoir cliqué sur "click to start".</li>
                                        </ul>
                                    </div>

                                    <div class="mt-3 text-monospace text-muted mb-2" style="font-size:70%">
                                        Si le jeu ne s'affiche pas correctement, vous pouvez utiliser ce <a data-toggle="collapse" href="#collapse_{{$balise}}-{{$i}}" role="button" aria-expanded="false" aria-controls="collapse_{{$i}}">code Python</a>.
                                    </div>

                                </div>
								
								<?php
								$cover_path = '/depot-jeux/python/'.str_replace("-", "/", $jeu[0]).'/'.$jeu[0].'.png';
								$cover_image = (File::exists(storage_path("app/public".$cover_path)))?asset('storage/'.$cover_path):asset('img/cover_pyxel.png');
								?>

                                <div class="col-lg-8 order-md-1">
                                    <div class="text-center">
                                        <div id="player_{{$balise}}-{{$i}}" class="rounded pt-1 mb-1" style="aspect-ratio:1/1;padding:0px;">
											<img src="{{ $cover_image }}" class="img-fluid" style="border-radius:4px;" width="100%" />											
                                        </div>
                                    </div> 
									
                                    <div class="collapse mb-4" id="collapse_{{$balise}}-{{$i}}">
<pre class="m-0"><code id="htmlViewer" style="color:rgb(216, 222, 233); font-weight:400;background-color:rgb(46, 52, 64);background:rgb(46, 52, 64);display:block;padding: 1.5em;border-radius:5px;"><span style="color:rgb(129, 161, 193); font-weight:400;">import</span> requests, os
site = <span style="color:rgb(163, 190, 140); font-weight:400;">'https://www.nuitducode.net'</span>
url = site + <span style="color:rgb(163, 190, 140); font-weight:400;">'/storage/depot-jeux/python/{!! str_replace("-", "/", $jeu[0]) !!}'</span>
<span style="color:rgb(129, 161, 193); font-weight:400;">py</span> = requests.<span style="color:rgb(129, 161, 193); font-weight:400;">get</span>(url + <span style="color:rgb(163, 190, 140); font-weight:400;">'/{!! $jeu[3] !!}'</span>)
with <span style="color:rgb(129, 161, 193); font-weight:400;">open</span>(<span style="color:rgb(163, 190, 140); font-weight:400;">'{!! $jeu[3] !!}'</span>, <span style="color:rgb(163, 190, 140); font-weight:400;">'wb'</span>) <span style="color:rgb(129, 161, 193); font-weight:400;">as</span> file:
    file.write(<span style="color:rgb(129, 161, 193); font-weight:400;">py</span>.content)
<span style="color:rgb(129, 161, 193); font-weight:400;">pyxres</span> = requests.<span style="color:rgb(129, 161, 193); font-weight:400;">get</span>(url + <span style="color:rgb(163, 190, 140); font-weight:400;">'/{!! $jeu[4] !!}'</span>)
<?php if($jeu[4] !== "") { ?>
with <span style="color:rgb(129, 161, 193); font-weight:400;">open</span>(<span style="color:rgb(163, 190, 140); font-weight:400;">'{!! $jeu[4] !!}'</span>, <span style="color:rgb(163, 190, 140); font-weight:400;">'wb'</span>) <span style="color:rgb(129, 161, 193); font-weight:400;">as</span> file:
    file.write(<span style="color:rgb(129, 161, 193); font-weight:400;">pyxres</span>.content)
<?php } ?>
print(<span style="color:rgb(129, 161, 193); font-weight:400;">py</span>.content.<span style="color:rgb(129, 161, 193); font-weight:400;">decode</span>())
os.system(<span style="color:rgb(163, 190, 140); font-weight:400;">'pyxel run "{!! $jeu[3] !!}"'</span>)
</code></pre>
                                        <div class="text-monospace text-muted p-2" style="text-align:justify;font-size:70%;">
                                            Copier-coller ce code dans un environnement Python possédant la bibliothèque <a href="https://github.com/kitao/pyxel/" target="_blank">Pyxel</a> pour lancer le jeu.<br />
                                            Pour installer un environnement Python + Pyxel, voir la <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/05-materiel-logiciels/" target="_blank">documentation</a>.
                                        </div>
                                    </div>									
									
                                    <div class="small text-monospace text-left" style="margin-top:10px;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
                                        {!! $jeu[5] !!}
                                    </div>
                                </div>                                
                            </div>
                            <br />
                            <br />
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }                
                ?>

            </div><!-- /col -->
        </div><!-- /row -->
	</div><!-- /container -->

    <script>
		function fullscreen(id) {
			var el = document.getElementById(id);
			if (el.requestFullscreen) {
				el.requestFullscreen();
			} else if (el.webkitRequestFullscreen) { /* Safari */
				el.webkitRequestFullscreen();
			} else if (el.msRequestFullscreen) { /* IE11 */
				el.msRequestFullscreen();
			}
		}
	</script> 

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>

	@include('inc-bottom-js')

</body>
</html>
