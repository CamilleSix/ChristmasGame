<?php class Game extends Page{

    public function __construct() {
        $this->searchPath = 'games' ;
        parent::__construct() ;
        $this->setGameTitle() ;
        $this->isGame = false ;

    }


    public function setGameTitle(){

        $this->title = $this->pageConfig->name ;
        $this->content = "<h1>{$this->pageConfig->name}</h1>".$this->content ;

    }

    function gameForm():string{
        return "<form action='submit-game' method='POST'><input type='submit'></form>" ;
    }
}