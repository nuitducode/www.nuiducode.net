<?php
/*
// GENERATION DES DONNEES
// Scratch
$jeux_scratch = [
    "C3" => [110, 1900, 460, 1902, 992, 973, 1766, 1701],
    "C4" => [1722, 1112, 1606, 511, 1940, 1040, 1981, 1952],
    "LY" => [1380, 687, 1039, 1577]
];

foreach($jeux_scratch AS $cat => $jeux){
    $n = 1;
    foreach($jeux AS $id){
        $jeu = App\Models\Game::where([['id', '=', $id]])->first();
        $etablissement = App\Models\User::where([['id', '=', $jeu->etablissement_id]])->first();
        $jeu_scratch = json_decode(file_get_contents("https://api.scratch.mit.edu/projects/".$jeu->scratch_id));
        echo htmlentities('$'.$cat.'_'.$n.'=["'.$jeu->scratch_id.'", "'.$jeu->nom_equipe.'", "'.$etablissement->etablissement.'<br />'.$etablissement->ville.' - '.$etablissement->pays.'", "'.addslashes(nl2br($jeu_scratch->instructions)).'"];')."<br />";
        $n++;
    }
}

// Python
$jeux_python = [
    "PI" => [1308, 1696, 1394, 421, 1424, 997, 1303, 178],
    "POO" => [1756, 1409, 1170, 1709, 1748, 1745, 740, 1783]
];

foreach($jeux_python AS $cat => $jeux){
    $n = 1;
    foreach($jeux AS $id){
        $jeu = App\Models\Game::where([['id', '=', $id]])->first();
        $files = File::files(storage_path("app/public/fichiers_pyxel/".$jeu->etablissement_jeton.'-'.$jeu->python_id));
        $etablissement = App\Models\User::where([['id', '=', $jeu->etablissement_id]])->first();
        echo htmlentities('$'.$cat.'_'.$n.'=["'.$jeu->etablissement_jeton.'-'.$jeu->python_id.'", "'.$jeu->nom_equipe.'", "'.$etablissement->etablissement.'<br />'.$etablissement->ville.' - '.$etablissement->pays.'", "'.basename($files[0]).'", "'.basename($files[1]).'", "'.addslashes(nl2br($jeu->documentation)).'"];')."<br />";
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
    <meta property="og:title" content="Nuit du Code 2023 - Sélection internationale" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée." />
    <meta property="og:url" content="https://www.nuitducode.net/ndc2023" />
    <meta property="og:image" content="{{ asset('img/open-graph-selection.png') }}" />
    <meta property="og:image:alt" content="Nuit du Code" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@nuitducode">
    <meta name="twitter:creator" content="@nuitducode">
    <meta name="twitter:title" content="Nuit du Code 2023 - Sélection internationale">
    <meta name="twitter:description" content="Marathon de programmation Scratch / Python - 6h pour créer un jeu. CM / Collège / Lycée.">
    <meta name="twitter:image" content="{{ asset('img/open-graph-selection.png') }}">

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

    <title>Nuit du Code 2023 | La sélection internationale</title>
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
                        <img src="{{ asset('img/ndc2023.png') }}" width="280" />
                        <div class="font-weight-bold mt-2" style="font-size:12px;color:gray">~ 7<sup>e</sup> édition ~</div>
                        <div class="font-weight-bold" style="font-size:17px;color:#261b0c;">Les jeux 2023!</div>
                        <p class="mt-2 text-monospace small" style="text-align:justify">Toutes catégories confondues, plus de 3000 jeux ont été créés lors cette 7<sup>e</sup> édition de la Nuit du Code. Vous trouverez, ci-dessous, la sélections des jeux 2023. Bravo aux élèves et à leurs enseignants. Amusez-vous bien!</p>
                    </div>                    
                </div>

                <div class="mt-3 pt-2 pb-2 text-center text-monospace sticky-top" style="background-color:#f8fafc">
                    <?php
                    // Catégories
                    $categories = ['C3' => 'Scratch CM1 > 6<sup>e</sup>', 'C4' => 'Scratch 5<sup>e</sup> > 3<sup>e</sup>', 'LY' => 'Scratch Lycée', 'PI' => 'Python NSI 1<sup>re</sup>', 'POO' => 'Python NSI Tle'];
                    foreach ($categories AS $balise => $categorie) {
                        echo '<a class="btn btn-success btn-sm mb-1 ml-1 mr-1" href="#'.$balise.'" role="button">'.$categorie.'</a>';
                    }
                    ?>
                </div>

                <?php           
                $C3_1=["846349500", "Prime Time", "French American School of Puget Sound<br />Mercer Island - États-Unis d'Amérique", "Cliquer sur le bouton Jouer pour commencer. Après que tu es dedans le jeu clique espace pour changer de plateforme, essaie d’éviter les pics, est les scies. Si tu touche les pics ou les scie tu morte. Quand tu mort tu peux cliquer sur le bouton retournes pour aller à la écrans maison ou cliquer sur le bouton rejouer pour rejouer."];
                $C3_2=["859197964", "Equipe 4", "Lycée Alexandre Yersin<br />Hanoï - Vietnam", "Les instructions dans le jeux<br /> Z pour ne pas faire le tutoriel"];
                $C3_3=["849838919", "KimonPapatheofanis", "Lycée Franco Hellénique Eugène Delacroix<br />Athènes - Grèce", "Français:<br /> Flèche gauche pour aller à gauche<br /> Flèche droite pour aller à droite<br /> Espace ou souris pressée pour tirer. <br /> A pour Auto Tir Oui/Non<br /> N pour changer d\'arme <br /> English:<br /> Right/ Left arrow keys to go left/right.<br /> Space/ Mouse down to shoot.<br /> A to turn on/ off auto shoot<br /> N to change weapon."];
                $C3_4=["859134522", "equipe 1", "Lycée Alexandre Yersin<br />Hanoï - Vietnam", "Français :<br /> Pour convaincre la reine, il faut que vous récupérez tous les pièces et TUER les monstres. Attention, ils peuvent vous attaquer. Si vous touchez le coeur alors, vous aurez +15 HP.<br /> Voici les bouttons pour jouer :<br /> - espace : sauter<br /> - flèche droite : avancer<br /> - flèche gauche : reculer<br /> - W : attaquer (-3 HP), attendre 3 sec pour réutiliser<br /> - X : attaque (-1 HP), attendre 1 sec pour réutiliser<br /> <br /> English :<br /> To assassinate the queen, you have to earn every coins and kill every monsters. Be careful, they will attack you. If you touch the heart, you will have +15 HP.<br /> Here\'s some buttons to play :<br /> - space : jump<br /> - right arrow : go forward<br /> - left arrow : go backward<br /> - W : attack (-3 HP), 3 sec cooldown<br /> - X : attack (-1 HP), 1 sec cooldown"];
                $C3_5=["854125750", "Team JEI", "Lycée Français International de Tokyo<br />Tokyo - Japon", "Le but de ce jeu est d\'attraper la pièce puis le diamant sans se faire toucher par les bombes, les poubelles, les torpilles et faîtes attention à l\'electro qui tire des décharges ! <br /> Pour déplacer le poisson rouge, utiliser les flèches de votre clavier. <br /> (Pour aller en haut, appuyez sur la flèche du haut.<br /> Pour aller en bas, appuyer sur la flèche du bas.<br /> Pour aller a gauche, appuyer sur la flèche à gauche.<br /> Pour aller à droite, appuyez sur la flèche de droite.) <br /> Pour attraper un objet (la pièce et le diamant), allez dessus. <br /> Vous disposez seulement de deux vies. <br /> Bonne chance et amusez-vous bien ! <br /> "];
                $C3_6=["853962259", "Groupe 6eme", "Collège Marcel Pagnol<br />Asuncion - Paraguay", "Avec les flèches droite et gauche, on bouge dans ces directions et avec la flèche haute, il saute. et si vous cliquez sur lui, il change de couleur.<br /> parfois il faut cliquez deux fois le drapeau."];
                $C3_7=["857445064", "CANDY CRUSH", "Collège Vauquelin<br />Toulouse - France", "Duel dans le cosmos<br /> <br /> But de jeu: Eviter les tirs de l\'adversaire et lui tirant également dessus.<br /> <br /> Usage:<br /> <br /> Drapeau vert: lancer le jeu<br /> <br /> Flèche droite: aller à droite <br /> <br /> Flèche gauche: aller à gauche <br /> <br /> Flèche du haut: aller en haut <br /> <br /> Flèche du bas: aller en bas <br /> <br /> Espace: Tirer<br /> <br /> Personnages:<br /> <br /> Vous: astronaute bleu<br /> <br /> Adversaire: astronaute rouge<br /> <br /> Pour gagner: Tirer 9 fois sur l\'adversaire sans se faire toucher. Si vous vous faites toucher 3 fois par l\'adversaire, vous perdez."];
                $C3_8=["857290231", "Pollution Océan ZWNQ", "Ecole Internationale PACA<br />Manosque - France", "CLICK THE GREEN FLAG TWICE<br /> CLICKER 2 FOIS LE DRAPEAU VERT<br /> <br /> English ~<br /> You are the little purple fish, use the arrow keys to move.<br /> - Collect the most coins! (+1 coins)<br /> - Do not touch the other fish (-0.5 lives)<br /> - Do not touch any other dangerous things (-0.5 lives)<br /> - Keep an eye out for diamonds! (+10 coins)<br /> Good luck!<br /> P.S. You will evolve over time...<br /> <br /> Français ~<br /> Tu es le petit poisson violet, utilise les flèches droite et gauches pour bouger.<br /> - Collectionne le plus de pièces ( +1 pièces )<br /> - Evite les autres poissons ( -0.5 cœur )<br /> - Evite tous les dangers ( -0.5 cœur )<br /> - Garde un œil ouvert pour les diamants! ( +10 pièces )<br /> Bonne chance!<br /> Note: Tu évoluera au bout de quelque temps..."];
                $C4_1=["857215301", "Dungeon Fighter", "Ecole Internationale PACA<br />Manosque - France", "CLICK GREEN FLAG TWICE<br /> ---Dungeon Fighter---<br /> CONTROLS<br /> Arrow keys - Movement<br /> Space - Attack<br /> X - Interact<br /> <br /> You have 3 Lives, and your goal is to win the diamond by killing the boss! <br /> <br /> -BOSS-<br /> 15 Health, Spawns minions at 5 and 10 health.<br /> <br /> -DOOR-<br /> Get to the door to get to next level.<br /> <br /> Enemies: Cannon, Pig, Pig bomb, and Pig King<br /> "];
                $C4_2=["854917850", "Akina's Speedstars", "Ecole du Nord<br />Mapou - Maurice", "Bienvenu dans \"The Last Knight Of The Line\" !<br /> Dans ce jeu, vous devrez fuir un ogre qui essaye de vous manger tout en esquivant les ennemis qui essayent de vous tuer<br /> <br /> Comment jouer :<br /> Prenez garde de bien appuyer DEUX FOIS sur le drapeau vert avant de commencer<br /> Appuyez sur espace pour commencer<br /> Appuyez sur la touche flèche de haut pour monter<br /> Appuyez sur la touche flèche de bas pour descendre<br /> Appuyez sur la touche flèche de bas pour lancer une épée toutes les 15 secondes"];
                $C4_3=["857030895", "lyceemoliere13", "Lycée Molière<br />Rio de Janeiro - Brésil", "-----------------------Fish Game------------------------------------Il faut que vous obtenez le plus de points possible sans mourir!_<br /> -Choisis le poisson que tu veux_<br /> -Utilise la souris pour se mouvementer_<br /> -Évite les bombes_"];
                $C4_4=["850632990", "The Halscripteurs", "Collège St Joseph<br />Chantonnay - France", "Le but du jeu est d’arriver à la fin.<br /> <br /> Pour passer un niveau, il faut prendre la clé pour ouvrir la porte et y entrer.<br /> <br /> Pour se déplacer on peut utiliser :<br /> -La flèche de droite pour aller à droite.<br /> -La flèche de gauche pour aller à gauche.<br /> -La flèche du haut pour sauter.<br /> <br /> Penser à récupérer les deux bonus même s’ils ne sont pas indispensables pour gagner.<br /> "];
                $C4_5=["861073085", "Yoshi 1", "IRF du Proche-Orient<br />Beyrouth - Liban", "Voir les instructions pour jouer"];
                $C4_6=["854177647", "Knight Solo", "Lycée Français René Descartes<br />Phnom Penh - Cambodge", "Appuyez deux fois sur le drapeau vert 2 fois (due à un beug)<br /> Utiliser les flèche pour bouger et la touche espace pour sauter:<br /> -Fleche droit: Aller à droite<br /> -Fleche gauche: Aller à gauche<br /> -Fleche haut: Sauter<br /> -ESPACE: Attaquer<br /> --------------------------------------------------------------------<br /> Terminer la platform sans mourir et rapporter le plus de point possible. <br /> Si vous arrivez à trouver la princesse. Tuez l\'à et un démon apparaitra. Vous devez tuez le plus de démon possible avant qu\'ils ne vous tue. "];
                $C4_7=["863320177", "KNIGHTS-5", "LF Chateaubriand<br />Rome - Italie", "KNIGHT- A PLATFORMER⚔️<br /> ___________________________________________<br /> <br /> FR: plus bas<br /> <br /> EN: In this platformer, you will have to pass all the levels to save Guenievre, the queen.<br /> Controls: Arrows to move.<br /> Space to shot.<br /> ___________________________________________<br /> <br /> FR: Dans ce jeu de platforme, il faut réussir tous les niveaux pour sauver Guenièvre, la reine.<br /> Controles: Flèches directionnelles pour bouger.<br /> Touche espace pour tirer."];
                $C4_8=["853252242", "Magnesium", "Lycée Français de San Francisco<br />San francisco - États-Unis d'Amérique", "Double click the green flag (occasional glitches occur)<br /> -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-<br /> W/A/d or arrow keys to move<br /> S or down arrow to dash<br /> Space key to attack<br /> -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-<br /> Kill the demons minions to save the princess and return to the kingdom<br /> <br /> <br /> HAVE FUN!"];
                $LY_1=["856210818", "The Baguettes", "Collège Elhuyar, Lycée Cassin<br />Hasparren, Bayonne - France", "Bienvenue sur Door it, vous êtes un nain maître des clés.<br /> Mais vous n\'êtes pas le maître des portes; <br /> il vous faudra vous déplacez dans un donjon infesté d\'ennemi, de pièges, de portes et de briques, utilisez l\'environnement à votre avantage.<br /> "];
                $LY_2=["851699002", "AL MONOD", "lycee Jacques Monod<br />Saint Jean de Braye - France", "FR : Le but du jeu est d\'empêcher les boites d\'écraser le personnage et d\'éviter qu\'elles touchent le haut de l\'écran, sinon on perd.<br /> <br /> -Espace : préparer une bombe<br /> -Relâcher Espace : relâcher la bombe (on peut perdre en se faisant exploser par la bombe)<br /> -Flèche de droite : aller à droite<br /> -Flèche de gauche : aller à gauche<br /> -Flèche de haut : sauter<br /> <br /> EN : The goal of the game is to prevent the boxes from crushing A and to prevent them from touching the top of the screen, otherwise we lose.<br /> <br /> -Space: prepare a bomb<br /> -Release Space: release the bomb (you can lose by being blown up by the bomb)<br /> -Right arrow: move right<br /> -Left arrow: go left<br /> -Up arrow: jump"];
                $LY_3=["854158299", "Lets Goat", "Lycée Français de Séoul<br />Séoul - Corée", "Votre but est de libérer Guenièvre qui a été capturée par un dangereux démon. Utilisez les flèches pour pouvoir vous déplacer, la touche espace pour attaquer (longtemps pour une attaque lourde). Pour passer au niveau suivant, il faut tuer le (ou un des) monstre(s) et toucher le mur de droite, et pour gagner le jeu, il faut tuer le boss démon. <br /> <br /> Lorsque vous mourez, resettez le jeu pour recommencer."];
                $LY_4=["856870785", "Lyceemoliere2", "Lycée Molière<br />Rio de Janeiro - Brésil", "Fish Thank est un jeu interactif contenu par des baiacu et des poissons colore.<br /> Pour commencer le jeu, cliquer sur Play et tirer (avec le bouton d\'espace et à l\'aide de la souris pour cibler ) sur les bombes et sur les tonneau pour protéger les poissons.<br /> Dès que deux poissons sont morts c\'est GAME OVER!<br /> Pour être champion votre score final doit être de 200 points.<br /> A votre tour, bonne chance!!! <br /> "];
                $PI_1=["xf38-q42m", "LES FISCHOU (Ilyes OMARI & Antoine RAMBOUR)", "Lycée Robert de Luzarches<br />Amiens - France", "images.pyxres", "jeux fischou.py", "BIENVENUE SUR NOTRE JEU NOMMÉE \" Fisho\"<br /> Le but du jeu est de manger le plus de poisson possible dans le temps imparti qui est d\'une minute et donc de faire le meilleur score possible. A chaque dix poissons mangés; on augmente notre niveau et on passe au niveau supérieur en se transformant en un poisson plus gros. Les poissons à manger apparaissent par la droite et notre poisson apparait par la gauche. On peut déplacer notre poisson partout sur l\'écran de jeu grâce au flèches de direction sur le clavier. Pour arrêter le jeu on peut appuyer sur la touche A."];
                $PI_2=["bqp5-7zaj", "Arthur Eliott", "Lycée Marguerite de Valois<br />Angoulême - France", "ndc.py", "theme.pyxres", "BEAT EAT (thème: le plus gros gagne) un jeu à 2, le premier qui mange jusqu\'à l\'explosion remporte la partie !<br /> Mouvements : Joueur 1 (ZQSD), Joueur 2 (flèches directionnelles)"];
                $PI_3=["48yg-ptrl", "BaguetTechs", "Lycée International de Valbonne<br />Valbonne - France", "ndc.py", "theme.pyxres", "NUIT DU CODE - 2023 - Tanks on Ice<br /> Valentin Huber, Samuel Minonne, Nolhan Brulé<br /> <br /> I - Our idea<br /> <br /> We decided to pick the “Le dernier à l\'écran gagne” theme and make our own graphics.<br /> We created a game where two players play against each other, using the same keyboard. They are going to drive tanks on ice, and their goal is going to be to eject the enemy tank from the ice, or to reduce its HP from 10 to 0.<br /> <br /> The drivers will have to choose between two drive modes. One is an axial mode, and enables the drivers to go any direction. The other is a rotational mode, with the possibility to turn by 45 degrees, and to shoot while going backward.<br /> <br /> II - Controls<br /> To choose your drive mode, it is possible to click on the yellow button. To launch the game, click on the button “Play”.<br /> <br /> The red tank uses the numpad with the keys “8” and “5” to go forward and backwards, and the keys “4” and “6” to turn, “0” to shoot.<br /> The green one uses the keys z, q, s and d in the same pattern, space to shoot.<br /> <br /> The axial drive uses the keys “z”,”q”, “s”, “d” and “8”,”4”,”5”, “6”, too, as well as the keys 7,9,3 and 1 to go diagonally with the numpad, and “a”,”e”,”c” and “w” with the other side of the keyboard.<br /> <br /> At the end of the game, it is possible to replay by pressing “r”"];
                $PI_4=["27cx-9vs2", "Smashing'out", "Lycée polyvalent Frédéric Joliot-Curie<br />Dammarie-les-Lys - France", "theme.pyxres", "v2.py", "Nous avons choisi de travailler sur le thème « Le dernier à l\'écran gagne ». <br /> Notre jeu est un jeu de combat de type « plateformer » qui se joue en 1 contre 1 à deux joueurs. <br /> Le but du jeu est de faire sorti r son adversaire de l’écran 3 fois, afin d’épuiser son nombre de vies qui est de trois. <br /> Chaque joueur peut se déplacer de droite à gauche : <br /> - « flèche de droite » pour aller à droite et « flèche de gauche » pour aller à gauche pour le joueur 1 <br /> - « d » pour aller à droite et « q » pour aller à gauche pour le joueur 2 <br /> Ils peuvent aussi sauter (flèche du haut pour le joueur 1 et espace pour le joueur 2 ou « b » à la manette ) et possèdent 2 sauts. <br /> Pour attaquer son adversaire, on peut effectuer deux types d’attaques : <br /> - L’attaque de corps à corps (flèche du bas pour le joueur 1 ou espace pour le joueur 2 ou « a » à la manette ) <br /> - L’attaque à distance ( ctrl pour le joueur 1 ou a pour le joueur 2 ou « x » à la manette ) <br /> Chaque joueur est associé à un pourcentage. Plus ce pourcentage est élevé, plus le joueur est projeté loin par les attaques de son ennemi. Les projectiles infligent 5% et les attaques de corps à corps infligent 10%."];
                $PI_5=["cen6-kv75", "Adam_Ghali_Sami", "Lycée Paul Valéry<br />Meknès - Maroc", "ndc.py", "ressources.pyxres", "Le menu principal vous permet de choisir entre différents modes de jeu :<br /> PLAY : Affrontez vos amis dans des combats de sumo.<br /> d: pour voir la documentation.<br /> <br /> <br /> <br /> <br /> <br /> Règles du jeu:<br /> Utiliser les touches ZQD pour le personnage n°1 et les flèches ← ↑ → pour le personnage n°2.<br /> Utiliser ↓ ou S pour pousser votre adversaire.<br /> Entrez dans l\'arène et préparez-vous à affronter vos amis dans des combats de sumo passionnants.<br /> Pour gagner, poussez votre adversaire hors du ring ou faites-le tomber pour remporter la victoire.<br /> Le joueur qui remporte le plus de rounds devient le champion du mode multijoueur.<br /> Pour quitter la page, utilisez la touche “Echap”<br /> <br /> <br /> <br /> <br /> Conseils pour jouer :<br /> Étudiez les mouvements de votre adversaire pour anticiper ses actions.<br /> Utilisez les bords du ring à votre avantage pour pousser votre adversaire hors du ring.<br /> Restez concentré et réactif pour réagir rapidement aux mouvements de votre adversaire.<br /> Maintenant que vous connaissez les règles de SUMO CLASH, préparez-vous à plonger dans l\'action et à profiter au maximum de ce jeu passionnant !"];
                $PI_6=["x83p-36dg", "Skymask", "Lycée Français International de Tokyo<br />Tokyo - Japon", "4.pyxres", "ndc.py", "Le but du jeu est d\'avoir le plus de score possible en esquivant les blocs.<br /> Avec les flèches haut et bas, on peut faire bouger le bonhomme en haut et en bas.<br /> Puis, a chaque fois que le score atteint un multiple de 10, vous passez au niveau suivant et la vitesse augmente.<br /> Il sera plus difficile de les esquiver mais vous avez des super pouvoirs.<br /> Toute les 3 secondes vous pouvez avec la touche:<br /> \"a\" efface quelques blocs en longueur<br /> \"s\" efface quelques blocs en hauteur<br /> \"d\" efface quelques gros blocs carres"];
                $PI_7=["xf38-d53b", "Équipe de choc", "Lycée Robert de Luzarches<br />Amiens - France", "2.pyxres", "ndc.py", "Personnages :<br /> - Joueur féminin<br /> - Fantômes (ennemis)<br /> Récit/contexte :<br /> Le joueur, munis du pouvoir de voler dans les airs, se doit d\'éliminer les fantômes qui souhaitent envahir un village proche. <br /> Nous avons décidé de représenter un personnage féminin car ce jeu est une métaphore aux violences faites aux femmes de nos jours. Le village ici représente les droits des femmes que les gens essaient de défendre aujourd\'hui et les fantômes représentent les individus qui s\'en prennent à ces femmes. Bien que des hommes aussi défendent ces droits de nos jours, ici le jeu montre un personnage féminin en héroïne.<br /> Règles :<br /> 30 ennemis vont apparaître et vous allez devoir tous les éliminer avant qu\'un des leurs n\'arrive jusqu\'à vous ! Vous ne pourrez bouger que verticalement. Le nombre d\'ennemis restants sera affiché en haut à gauche de votre écran.<br /> Commandes :<br /> Tirer --> Espace<br /> Bouger en haut --> flèche du haut<br /> Bouger en bas --> flèche du bas"];
                $PI_8=["pxe8-ecxp", "Faure, Ponthieu, Zarie", "Lycée Gustave JAUME<br />Pierrelatte - France", "ndc.py", "theme.pyxres", "Survive The Hord est un jeu de plateforme entre 2 joueurs ou le but est d ‘avoir un meilleur score que l’adversaire. Pour augmenter son score on peut survivre le plus longtemps possible ou alors d’éliminer des ennemis en leur tirant dessus.<br /> <br /> <br /> <br /> <br /> <br /> Touche joueur 1 : Z = sauter<br /> <br /> D = aller vers la droite<br /> <br /> Q = aller vers la gauche<br /> <br /> F = tirer<br /> <br /> Touche joueur 2 : Fleche du haut = sauter<br /> <br /> Fleche de droite = aller à droite<br /> <br /> Fleche de gauche = aller à gauche<br /> <br /> Fleche du bas = tirer<br /> <br /> <br /> <br /> Le joueur étant le dernier sur le tapis gagne ! (Il y a une compétition bonus avec le score affiché à la fin)"];
                $POO_1=["42be-sek3", "TyranKorp2", "Lycée Van Gogh<br />Aubergenville - France", "2_edit.pyxres", "main.py", "Notre jeu est un \"platformer\" où le but est de finir les 3 niveaux le plus rapidement possible. Il faut récupérer la clé de chaque niveau avant d\'atteindre la porte permettant d\'accéder au niveau suivant.<br /> <br /> Les déplacements latéraux se font avec les touches Q et D ainsi que les flèches directionnelles. Le saut se fait avec la barre espace.<br /> Pour s\'accrocher aux blocs verts, il faut maintenir la touche Z ou la flèche du haut."];
                $POO_2=["g7jx-u3c8", "LES CRAKITOS", "Collège Elhuyar, Lycée Cassin<br />Hasparren, Bayonne - France", "5.pyxres", "ndc.py", "Dans ce jeu vous pouvez controler le joueur avec Z,Q,S et D et vous attaquez avec J. Le but du jeu est de trouver le coffre tout en évitant ou en tuant les ennemies. Attention la difficulté augmente ! Avec une génération de monde aléatoire une adaptation sera nécessaire"];
                $POO_3=["zrnl-82lw", "Les 2 Neurones", "lycée Jean Guéhenno<br />fougères - france", "main.py", "my_resource.pyxres", "Nom : Death Journey<br /> Flèches gauche et droite pour bouger<br /> Espace pour sauter<br /> H pour interagir"];
                $POO_4=["x3c6-wkem", "MOUTON CORP", "Lycée Jean Monnet<br />JOUE LES TOURS - FRANCE", "NDC.py", "theme.pyxres", "Bienvenue dans BLOB STORY...<br /> <br /> Dans ce jeu, vous et votre adversaire incarnerez des BLOBs, créatures magiques de la forêt verte. Quel est l\'objectif de ce jeu, nous direz-vous ? Manger la plus grande quantité de pommes afin de devenir le roi des BLOBs, le plus gros... Pour vous déplacer dans cet univers, 2 possibilités s\'offrent à vous : déplacez-vous avec les touches flèches du clavier pour le BLOB bleu, ou avec les touches Z, Q, S et D pour le BLOB jaune.<br /> Attention, vous augmentez de taille après avoir mangé 4 pommes ! Cela vous ralentira cependant un peu, dans le but de laisser une chance à votre adversaire d\'attraper les pommes suivantes également ! Vous pouvez augmenter de taille 3 fois au cours du jeu. Le premier joueur ayant mangé 16 pommes gagne donc la partie.<br /> Bon appétit et bon courage !"];
                $POO_5=["mfj3-lfx8", "Estraboise", "Lycée Évariste Galois<br />Sartrouville - France", "5.pyxres", "projet_NDC.py", "Bienvenue dans les ruines d\'un très ancien royaume.<br /> <br /> Vous êtes le fantôme habitant ce labyrinthe. Pour vous déplacer, utilisez les flèches du clavier afin de trouvez un trésor perdu au fil du temps. Etant un fantôme vous avez une vision limitée mais suite à un maléfice vous ne pouvez pas traverser les murs. ce trésor pourrait peut-être vous rendre vos pouvoirs, c\'est pourquoi vous devez le trouvez. Malheureusement il est fermé avec deux clefs éparpillées. Pour acceder aux labyrinthes qui conduisent au trésor il faut attraper les clefs.<br /> <br /> Bonne chance !!!<br /> <br /> - L\'équipe Estraboise -"];
                $POO_6=["2wnp-jx7m", "RPMVikator", "Lycée Kernanec<br />Marcq-en-Barœul - France", "my_resource.pyxres", "ndc.py", "Bonjour, voici notre jeu BombItKid<br /> <br /> Notre jeu peut se jouer à 4 personnes :<br /> L\'objectif du jeu est d\'être le dernier joueur en vie.<br /> Les joueurs peuvent s\'éliminer entre eux en posant des bombes.<br /> <br /> Les bombes cassent les murs (roche) et tuent les joueurs.<br /> Si une bombe explose à côté d\'une autre bombe, l\'explosion déclanche l\'explosion de l\'autre bombe.<br /> <br /> Un joueur peut poser au maximum une seule bombe à la fois.<br /> <br /> En modifiant la constante PLAYER_COUNT, vous pouvez définir le nombre de joueurs.<br /> En modifiant la constante TIME_BEFORE_EXPLOSION, vous pouvez modifier le nombre de frame avant que la bombe explose<br /> <br /> le direction des joueur : <br /> joueur 1:<br /> direction : <br /> z : permet de monter <br /> s : permet d\'aller en bas <br /> q : permet d\'aller a gauche <br /> d : permet d\'aller en a droite <br /> a : pose la bombe <br /> <br /> joueur 2:<br /> direction : <br /> y : permet de monter <br /> h : permet d\'aller en bas <br /> g : permet d\'aller a gauche <br /> j : permet d\'aller en a droite <br /> t : pose la bombe <br /> <br /> joueur 3:<br /> direction : <br /> o: permet de monter <br /> l : permet d\'aller en bas <br /> k : permet d\'aller a gauche <br /> m : permet d\'aller en a droite <br /> i : pose la bombe<br /> <br /> joueur 4:<br /> direction : <br /> num8 : permet de monter <br /> num5 : permet d\'aller en bas <br /> num4 : permet d\'aller a gauche <br /> num6 : permet d\'aller en a droite <br /> num7 : pose la bombe"];
                $POO_7=["pt4u-x2dz", "LesNerds", "Lycée Marseilleveyre<br />MARSEILLE - France", "2.pyxres", "ndc.py", "Un chasseur de trésor s\'aventure dans les contrées lointaines. Déplacez-vous avec habileté grâce aux flèches du clavier. Ramassez les clés, puis ouvrez les portes pour progresser dans les profondeurs de la Terre. Mais prenez garde à la malédiction du temps ! Celle-ci pourrait mettre un terme à votre aventure. Ramassez les diamants sacrés du temps. En absorbant leur énergie, vous pourrez contrer la malédiction."];
                $POO_8=["zade-2zp6", "Grootys", "Ensemble Baudimont Saint Charles<br />Arras - France", "NDC.py", "theme.pyxres", "Jeu style street fighter, on choisit son personnage et on doit tuer l\'ennemi<br /> <br /> Pour Joueur 1 :<br /> Q pour aller à gauche<br /> D pour aller à droite<br /> Z pour sauter<br /> S pour s\'accroupir<br /> E pour attaque de corps à corps<br /> A pour attaque à distance<br /> <br /> Pour Joueur 2 :<br /> flèche de gauche pour aller à gauche<br /> flèche de droite pour aller à droite<br /> flèche du haut pour sauter<br /> flèche du bas pour s\'accroupir<br /> Rshift pour attaque à distance<br /> Contrôle droit pour attaquer au corps à corps"];

                $C3_jeux = [$C3_1, $C3_2, $C3_3,$C3_4,$C3_5,$C3_6,$C3_7,$C3_8];
                $C4_jeux = [$C4_1, $C4_2, $C4_3,$C4_4,$C4_5,$C4_6,$C4_7,$C4_8];
                $LY_jeux = [$LY_1, $LY_2, $LY_3,$LY_4];
                $PI_jeux = [$PI_1, $PI_2, $PI_3,$PI_4,$PI_5,$PI_6,$PI_7,$PI_8];
                $POO_jeux = [$POO_1, $POO_2, $POO_3,$POO_4,$POO_5,$POO_6,$POO_7,$POO_8];

                shuffle($C3_jeux);
                shuffle($C4_jeux);
                shuffle($LY_jeux);
                shuffle($PI_jeux);
                shuffle($POO_jeux);

                $scratch_categories = [
                    "C3" => ["titre" => "SCRATCH<br />Sélection Cycle 3<br />(CM1 > 6<sup>e</sup>)", "description" => "\"Cycle 3\" (élèves du CM1 à la 6<sup>e</sup>)", "jeux" => $C3_jeux],
                    "C4" => ["titre" => "SCRATCH<br />Sélection Cycle 4<br />(6<sup>e</sup> > 3<sup>e</sup>)", "description" => "\"Cycle 4\" (élèves de la 6<sup>e</sup> à la 3<sup>e</sup>)", "jeux" => $C4_jeux],
                    "LY" => ["titre" => "SCRATCH<br />Sélection Lycée<br />(Seconde > Terminale)", "description" => "\"Lycée\" (élèves de la Seconde à la Terminale)", "jeux" => $LY_jeux]
                ];


                foreach($scratch_categories AS $balise => $scratch_categorie){
                    ?>

                    <div id="{{$balise}}" class="row pt-5">
                        <div class="col-md-3">
                            <h2 class="text-monospace" style="text-transform: capitalize;">{!! $scratch_categorie['titre'] !!}</h2>
                            <p class="text-monospace text-muted" style="font-size:70%;color:silver"><i>L'ordre d'affichage des jeux est aléatoire</i></p>
                        </div>
                  
                        <div class="col-md-9 pt-3">
                            <?php
                            foreach($scratch_categorie['jeux'] AS $jeu){
                                ?>
                                <div class="row mt-2">
                                    <div class="col-lg-4 order-md-2">
                                        <h3 class="text-dark pt-0 mt-0 mb-1">{{ $jeu[1] }}</h3>
                                        <div class="text-monospace text-muted small">{!! $jeu[2] !!}</div>
                                        <button type="button" class="btn btn-info mt-2" onClick="document.getElementById({{ $jeu[0] }}).innerHTML='<iframe src=\'https://scratch.mit.edu/projects/{{ $jeu[0] }}/embed\' width=\'485\' height=\'402\' frameborder=\'0\' scrolling=\'no\' style=\'border-radius:5px\'></iframe>'">lancer / recharger le jeu</button>
                                        <div class="mt-3 text-monospace text-muted mb-2" style="font-size:70%">Si le jeu ne s'affiche pas correctement,<br />vous pouvez l'ouvrir dans un autre<br />onglet en cliquant <a href="https://scratch.mit.edu/projects/{{ $jeu[0] }}" target="_blank">ici</a>.</div>
                                    </div>                                     
                                    <div class="col-lg-8 order-md-1">
                                        <div id="{{ $jeu[0] }}" style="padding:0px 0px 0px 0px;"><img src="https://cdn2.scratch.mit.edu/get_image/project/{{ $jeu[0] }}_480x360.png" class="img-fluid" style="border-radius:4px;" width="100%" /></div>
                                        <div class="small text-monospace text-left" style="margin-top:10px;border:1px solid silver; padding:10px;border-radius:4px; background-color:white;">
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
                    "PI" => ["titre" => "PYTHON<br />Sélection Première NSI", "description" => "\"Première NSI\"", "jeux" => $PI_jeux],
                    "POO" => ["titre" => "PYTHON<br />Sélection Terminale NSI", "description" => "\"Terminale NSI\"", "jeux" => $POO_jeux]
                ];


                foreach($python_categories AS $balise => $scratch_categorie){
                    ?>

                    <div id="{{$balise}}" class="row pt-5">
                        <div class="col-md-3">
                            <h2 class="text-monospace" style="text-transform: capitalize;">{!! $scratch_categorie['titre'] !!}</h2>
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
                                    <div id="warning_{{$balise}}-{{$i}}" class="pl-4 pr-1 mt-2 mb-1 text-monospace text-danger text-left" style="font-size:75%;display:none;">
                                        <ul class="m-0 p-0">
                                            <li>ne pas cliquer en dehors du cadre du jeu après avoir cliqué sur "click to start" afin de ne pas perdre les commandes (souris / clavier).</li>
                                            <li>ne pas cliquer sur le mode plein écran après avoir cliqué sur "click to start".</li>
                                        </ul>
                                    </div>
                                    <div class="mb-2">
                                        <button type="button" class="btn btn-info mt-2" onClick="document.getElementById('player_{{$balise}}-{{$i}}').innerHTML='<iframe src=\'/ndc/evaluation-pyxel-player/{{ Crypt::encryptString($jeu[0]) }}\' width=\'100%\' height=\'100%\' frameborder=\'0\' scrolling=\'no\'></iframe>';document.getElementById('warning_{{$balise}}-{{$i}}').style.display='block';">lancer / recharger le jeu</button>  
                                        <button type="button" class="mt-2 btn btn-light ml-3 pl-3 pr-3" onclick="fullscreen('player_{{$balise}}-{{$i}}')" data-toggle="tooltip" data-placement="top" data-title="mode plein écran"><i class="fas fa-expand"></i></i></button> 
                                    </div>

                                    <div class="mt-3 text-monospace text-muted mb-2" style="font-size:70%">
                                        Si le jeu ne s'affiche pas correctement, vous pouvez utiliser ce <a data-toggle="collapse" href="#collapse_{{$balise}}-{{$i}}" role="button" aria-expanded="false" aria-controls="collapse_{{$i}}">code Python</a>.
                                    </div>

                                    <div class="collapse mb-4" id="collapse_{{$balise}}-{{$i}}">
<pre class="m-0"><code id="htmlViewer" style="color:rgb(216, 222, 233); font-weight:400;background-color:rgb(46, 52, 64);background:rgb(46, 52, 64);display:block;padding: 1.5em;border-radius:5px;"><span style="color:rgb(129, 161, 193); font-weight:400;">import</span> requests, os
code = <span style="color:rgb(163, 190, 140); font-weight:400;">'{!! $jeu[0] !!}'</span>
site = <span style="color:rgb(163, 190, 140); font-weight:400;">'https://www.nuitducode.net'</span>
url = site + <span style="color:rgb(163, 190, 140); font-weight:400;">'/storage/fichiers_pyxel/'</span> + code
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
                                            Pour installer un environnement Python + Pyxel, voir la <a href="https://nuit-du-code.forge.apps.education.fr/DOCUMENTATION/PYTHON/02-installation/" target="_blank">documentation</a>.
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-8 order-md-1">
                                    <div class="text-center">
                                        <div id="player_{{$balise}}-{{$i}}" class="rounded pt-1 mb-1" style="aspect-ratio:1/1;background-color:#202224;">
                                            <img src="{{ asset('img/pyxel_evaluation.png') }}" style="position:relative;top:40%" />    
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
