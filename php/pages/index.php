<?php
$allGames = $this->json->getFile('games') ;

$gameList = "" ;
$stepNumber = 1 ;
$currentStep = false ;

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
        $_GET['game'] = $url ;

        $gameObject = new Game() ;

        $gameHTML = $gameObject->output(true) ;
        $this->css = array_merge( $this->css,$gameObject->css) ;


        $gameList .= "
    <div class='game currentStep'>
    <div class='gameImage ibv' style='background-image: url(images/games-thumbnails/{$url}.png)'></div>
    <span class='ibv w70'>
    <strong class='db'>Etape {$stepNumber}</strong>
    {$game->name}
    </span>
    <span class='creator'>
    <strong>Créateur :</strong>
    {$game->creator}
    </span>
    <div id='game'>
    {$gameHTML}

    <form action='form/valid-game/{$url}' method='POST'>
    <input type='text' name='solution' placeholder='Réponse' class='solutionInput defaultButton ibv'>
    <button class='gameSubmit defaultButton ibv'>".svg("check", "#FFF")." Valider</button>
    </form>
    </div>
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

