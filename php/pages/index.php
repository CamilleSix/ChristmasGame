<?php
    $allGames = $this->json->getFile('games') ;

    $gameList = "" ;
    $stepNumber = 1 ;
    $currentStep = false ;
//href='jeu/{$url}'
    foreach ($allGames AS $url => $game){
        if (!empty($game->solved)) {
            $gameList .= "
    <div class='game solvedGame'>
    <div class='gameImage ibv' style='background-image: url(images/games-thumbnails/{$url}.png)'></div>
    <span class='ibv w70'>
    <strong class='db'>Etape {$stepNumber}</strong>
    {$game->name}
    </span>
    
    </div>
    ";

        } elseif ($currentStep == false){
            $currentStep = true ;
            $gameList .= "
    <div class='game currentStep'>
    <div class='gameImage ibv' style='background-image: url(images/games-thumbnails/{$url}.png)'></div>
    <span class='ibv w70'>
    <strong class='db'>Etape {$stepNumber}</strong>
    {$game->name}
    </span>
    <iframe src='jeu-iframe/{$url}'>
    
    </iframe>
    </div>
    ";
        } else {
            $gameList .= "
    <div class='game futurGame'>
    <div class='gameImage ibv' style='background-image: url(images/games-thumbnails/{$url}.png)'></div>
    <span class='ibv w70'>
    <strong class='db'>Etape {$stepNumber}</strong>
    {$game->name}
    </span>
    </div>
    ";
        }
        $stepNumber++;
    }
    $html = str_replace('{gamesList}', $gameList, $html) ;

