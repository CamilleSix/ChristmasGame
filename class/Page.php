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
<nav class='menu'>
<img src='images/logo.jpg' class='logo'>
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

        public function output($onlyBody = false):string{
            $this->menu();
            $css = "" ;

            foreach ($this->css AS $stylesheet){
                $css .= "<link rel='stylesheet' href='{$this->beforePath}css/{$stylesheet}.css'>" ;
            }

            $this->content .= $this->gameForm() ;

            $bodyClass = '' ;

            if (!empty($_GET['framed'])){
                $bodyClass = 'inIframe' ;
            }

            if ($onlyBody == false){
                $this->displayError() ;

                return "
<!doctype html>
<html lang='fr' class='{$bodyClass}'>
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
            }else {
                return "<div class='bodyContent'>{$this->content}</div>" ;
            }
        }

        function newError($errorId = 'Unknown', $errorSpecialText = NULL){
            $errors = [
                "Unknown" =>["Erreur"],
                "noSolution" =>["Merci d'indiquer une solution, une case vide ça marche pas, looser"],
                "badSolution" =>["C'est pas ça, pourtant vraiment c'est facile", "Aucune chance que ce soit ça la solution srx", "C'est pas bon, pourtant même Fluff aurait trouvé "]
            ] ;

            $_SESSION['errors'][] = $errors[$errorId][array_rand($errors[$errorId])] ;

        }
        function displayError(){
            if (!empty($_SESSION['errors'])){
                $errorList = "<ul class='errors'>" ;
                foreach ($_SESSION['errors'] AS $error){
                    $errorList .= "<li>{$error}</li>" ;
                }
                $errorList .="</ul>" ;
                $this->menu .= $errorList ;
                $_SESSION['errors'] = NULL ; // supprime les erreurs une fois affichées
            }
        }


        function stringToCleanUrl(string $string):string{
            $caracteres = array(
                'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', '@' => 'a',
                'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', '€' => 'e',
                'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
                'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'µ' => 'u',
                'Œ' => 'oe', 'œ' => 'oe', 'ç' => 'c',
                '$' => 's');

            $url = strtr($string, $caracteres);
            $url = preg_replace('#[^A-Za-z0-9]+#', '-', $url);
            $url = trim($url, '-');

            return strtolower($url);
        }

    }
