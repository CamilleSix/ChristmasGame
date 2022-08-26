<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once "class/Page.php";
require_once "class/Game.php";
require_once "class/Json.php";
require_once "fonctions/svgs.php";


if (!empty($_GET['game'])) {
    $page = new Game();
} else {
    $page = new Page();
}

echo $page->output() ;