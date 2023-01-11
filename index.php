<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start() ;


    require_once "class/Page.php";
    require_once "class/Game.php";
    require_once "class/Json.php";
    require_once "fonctions/svgs.php";


    if (!empty($_GET['game'])) {
        $page = new Game();
    } else {
        $page = new Page();
    }

    if (!empty($_GET['form'])){
        $page->validGameSolution() ;
        header("Location: ../../");
    } else {
        echo $page->output() ;
    }
