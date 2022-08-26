<?php
$allGames = $this->json->getFile('games') ;

$gameList = "" ;
foreach ($allGames AS $url => $game){
    $gameList .="
    <a class='game' href='jeu/{$url}'>
    <div class='gameImage' style='background-image: url(images/games-thumbnails/{$url}.png)'></div>
    <span>
    {$game->name}
    </span>
    </a>
    " ;
}
$html = str_replace('{gamesList}', $gameList, $html) ;

