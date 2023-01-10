<?php class Game extends Page{

    public function __construct() {
        $this->searchPath = 'games' ;
        parent::__construct() ;
        $this->setGameTitle() ;
        $this->isGame = false ;

    }

    public function menu(){
        $this->menu = "" ;
    }

    public function setGameTitle(){

        $this->title = $this->pageConfig->name ;
        $this->content = "
<article class='ibv w70'>
<h1>{$this->pageConfig->name}</h1>
<div class='gameDescription'>{$this->pageConfig->description}</div>
</article>
<section class='game'>
".$this->content."
</section>" ;

    }

    function gameForm():string{
     /*   if (empty($this->pageConfig->input->kind)){
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
     */
        return '' ;
    }
}