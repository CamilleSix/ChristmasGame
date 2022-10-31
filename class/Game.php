<?php class Game extends Page{

    public function __construct() {
        $this->searchPath = 'games' ;
        parent::__construct() ;
        $this->setGameTitle() ;
        $this->isGame = false ;

    }


    public function setGameTitle(){

        $this->title = $this->pageConfig->name ;
        $this->content = "
<nav class='backToIndex'><a href='../'>".svg("chevron-left", "#545454")."Retourner à la liste des jeux</a></nav>
<article class='ibv w70'>
<h1>{$this->pageConfig->name}</h1>
<div class='gameDescription'>{$this->pageConfig->description}</div>
</article><ul class='ibv w30 scoreList'>
<li>Bonne réponse : <strong class='green'>+{$this->pageConfig->score->win} ".svg("rabbit", "#2ea17a")."</strong></li>
<li>Mauvaise réponse : <strong class='red'>-{$this->pageConfig->score->loose} ".svg("rabbit", "#851e36")."</strong></li>
</ul>
<section class='game'>
".$this->content."
</section>" ;

    }

    function gameForm():string{
        if (empty($this->pageConfig->input->kind)){
            $this->pageConfig->input->kind = 'text' ;
        }
        if (empty($this->pageConfig->input->placeholder)){
            $this->pageConfig->input->placeholder = 'Ma réponse' ;
        }
        return "
<form action='submit-game' method='POST'>
<input class='defaultButton solutionInput ibv' type='{$this->pageConfig->input->kind}' placeholder='{$this->pageConfig->input->placeholder}'>
<button class='gameSubmit defaultButton ibv' type='submit'>".svg("check", "#FFF")." Valider</button>
</form>" ;
    }
}