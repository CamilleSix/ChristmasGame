<?php

class Page
{
    public $json ;
    public $meta;
    public $title ;

    public $menu;
    public $score = 0 ;

    public $content ;

    public $footer;
    public $css = ["mandatory"] ;
    public $beforePath = '' ;
    public $script ;

    public $pageId = 'index' ;
    public $pageConfig ;

    public $searchPath = 'pages' ;
    public $isGame = false ;

    public function __construct() {

        $this->json = new Json() ;
        $this->pageAccess() ;

    }

    public function menu(){
        $this->menu = "
<nav class='scoreMenu'>
<a href='historique' class='score defaultButton'><span>{$this->score}</span> ".svg("rabbit", "white")."</a>
<a href='historique'>Choisir mon cadeau</a>
".svg("question-circle", "red")."
</nav>
" ;
    }


    public function pageAccess(){

        $file = 'pages' ;
        if ($this->isGame){
            $this->pageId = $_GET['page'] ;

        } elseif (!empty($_GET['game'])) {
            $this->beforePath = "../" ;
            $this->pageId = $_GET['game'];
            $file = 'games' ;
        }

        $access = $this->json->getFile($file) ;

        if (isset($access->{$this->pageId})){
            $this->pageConfig =$access->{$this->pageId} ;
            $this->buildPageHtml() ;
        } else {
            $this->content ="Cette page n'existe pas" ;
        }

    }

    function buildPageHtml(){

        $html = file_get_contents("html/{$this->searchPath}/{$this->pageId}.html") ;

        if (file_exists("php/{$this->searchPath}/{$this->pageId}.php")){

            require_once "php/{$this->searchPath}/{$this->pageId}.php" ;
        }

        if (file_exists("css/{$this->searchPath}/{$this->pageId}.css")){
            $this->css[] = "{$this->searchPath}/{$this->pageId}" ;
        }

        $this->content = $html ;
    }

    function gameForm():string{
        return '' ;
    }

    public function output():string{
        $this->menu();
        $css = "" ;

        foreach ($this->css AS $stylesheet){
            $css .= "<link rel='stylesheet' href='{$this->beforePath}css/{$stylesheet}.css'>" ;
        }

        $this->content .= $this->gameForm() ;


        return "
<!doctype html>
<html lang='fr'>
        <head>
          <title>{$this->title}</title>
          <meta charset='utf-8'>
          {$this->meta}
          {$css}
        </head>
    <body>
        {$this->menu}
        {$this->content}
        {$this->footer}
    </body>
</html>
" ;
    }

}
