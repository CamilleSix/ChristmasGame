<?php

    class Page
    {
        public $json ;
        public $meta ;
        public $title ;

        public $menu;

        public $content ;
        protected $currentVersion = "0.1" ;

        public $footer;
        public $css = ["mandatory"] ;
        public $beforePath = '' ;
        public $js = [] ;

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
<img src='images/logo.svg' class='logo'>
</nav>
" ;
        }


        public function pageAccess(){

            $file = 'pages' ;

            if (!$this->isGame){

                if (!empty($_GET['page'])) {
                    $this->pageId = $_GET['page'];
                }

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

            if (!empty( $this->pageConfig->title)){
                $this->title = $this->pageConfig->title ;
            }


        }

        function buildPageHtml(){

            if(file_exists("html/{$this->searchPath}/{$this->pageId}.html")){
                $html = file_get_contents("html/{$this->searchPath}/{$this->pageId}.html") ;
            } else {
                $html = "" ;
            }


            if (file_exists("php/{$this->searchPath}/{$this->pageId}.php")){

                require_once "php/{$this->searchPath}/{$this->pageId}.php" ;
            }

            if (file_exists("css/{$this->searchPath}/{$this->pageId}.css")){
                $this->css[] = "{$this->searchPath}/{$this->pageId}" ;
            }

            if (file_exists("js/{$this->searchPath}/{$this->pageId}.js")){
                $this->js[] = "{$this->searchPath}/{$this->pageId}" ;
            }

            $this->content = $html ;
        }

        function gameForm():string{
            return '' ;
        }

        public function output($onlyBody = false):string{


            $this->menu();
            $css = "" ;

            $this->css = array_unique($this->css) ;
            foreach ($this->css AS $stylesheet){
                $css .= "<link rel='stylesheet' href='{$this->beforePath}css/{$stylesheet}.css?{$this->currentVersion}'>" ;
            }

            $this->js = array_unique($this->js) ;

            foreach ($this->js AS $script){
                $css .= "<script src='{$this->beforePath}js/{$script}.js?{$this->currentVersion}'></script>" ;
            }

            $this->content .= $this->gameForm() ;

            $bodyClass = '' ;

            if (!empty($_GET['framed'])){
                $bodyClass = 'inIframe' ;
            }

            if ($onlyBody == false){
                $this->displayNotification() ;

                return "
<!doctype html>
<html lang='fr' class='{$bodyClass}'>
        <head>
          <title>{$this->title} - Katchacha</title>
          <meta name='viewport' content='width=device-width, initial-scale=1' />
          <meta charset='utf-8'>
          {$this->meta}
          {$css}
         
            <link rel='apple-touch-icon' sizes='180x180' href='/apple-touch-icon.png'>
            <link rel='icon' type='image/png' sizes='32x32' href='/favicon-32x32.png'>
            <link rel='icon' type='image/png' sizes='16x16' href='/favicon-16x16.png'>
            <link rel='manifest' href='/site.webmanifest'>
            <meta name='msapplication-TileColor' content='#da532c'>
            <meta name='theme-color' content='#ffffff'>
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

        function newNotification($notificationId = 'Unknown', $isError = true){
            $messages = [
                "Unknown" =>["Erreur"],
                "goodSolution" =>["C'était vraiment facile après","Beau gosse", "Bien joué ♡", "Tu es si fort, et grand et beau", "Ouuuiiiii"],
                "noSolution" =>["Merci d'indiquer une solution, une case vide ça marche pas, looser"],
                "badSolution" =>["C'est pas ça, pourtant vraiment c'est facile", "Aucune chance que ce soit ça la solution srx", "C'est pas bon, pourtant même Fluff aurait trouvé ", "Looser", "Attend, tu étais sur de toi ?", "Non"]
            ] ;

            if ($isError == true) {
                $_SESSION['errors'][] = $messages[$notificationId][array_rand($messages[$notificationId])];
            } else {
                $_SESSION['notifications'][] = $messages[$notificationId][array_rand($messages[$notificationId])];
            }

        }
        function displayNotification(){
            if (!empty($_SESSION['errors']) || !empty($_SESSION['notifications'])){
                $errorList = "<ul class='notifications'>" ;
                if (!empty($_SESSION['errors'])) {
                    foreach ($_SESSION['errors'] as $error) {
                        $errorList .= "<li class='error'>{$error}</li>";
                    }
                }

                if (!empty($_SESSION['notifications'])) {
                    foreach ($_SESSION['notifications'] as $error) {
                        $errorList .= "<li class='notification'>{$error}</li>";
                    }
                }
                $errorList .="</ul>" ;
                $this->menu .= $errorList ;
                $_SESSION['errors'] = NULL ; // supprime les erreurs une fois affichées
                $_SESSION['notifications'] = NULL ;
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


        function stringToColor(string $string):string{
            $alreadyColors = ['Blanc' => 'e1e6e2', 'Gris' => '6e6e6e','Noir' => '292929','Vert' => '8bed61'] ;
            if (!empty($alreadyColors[$string])){
                $code = $alreadyColors[$string] ;
            } else {
                $code = dechex(crc32($string));
                $code = substr($code, 1, 6);
            }
            return '#'.$code;
        }

    }
