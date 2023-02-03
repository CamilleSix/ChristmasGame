<?php

$sha1 = '' ;

if (!empty($_POST['string'])){
    $sha1 = sha1($this->stringToCleanUrl($_POST['string']));

    $sha1 = "<div class='resultaSha1'>Résultat : $sha1</div>" ;
}

$html = str_replace('{sha1Result}', $sha1, $html) ;
