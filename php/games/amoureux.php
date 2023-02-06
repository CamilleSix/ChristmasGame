<?php

$elements = ["Les gâteaux", "Le Nutella", "Fluff", "La philosophie","Le boudin", "Tim Burton","Les chevaux", "L'Eurovision",
    "Les cactus", "Les champignons", "Nigirigon", "Les poivrons","Les tubes disco", "La meringue", "Les poils", "Le cinéma coréen","Elon Musk", "La noix de coco", "Les nez crochus", "Céline Dion", "La réglisse", "Luna Lovegood"] ;
$loveList = '' ;
foreach ($elements AS $element){
    $loveList .= "<div class='pick ibv'><span class='like'>👍</span><span class='name tac'>$element</span><span class='dislike'>👎</span></div>" ;
}

$html = str_replace('{loveList}', $loveList, $html) ;
?>