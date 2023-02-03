<?php

$friends = ["Anna", "Florian", "Camille", "Eva", "Elza", "Thomas"] ;
$fileFormats = ["jpeg", "png", "jpeg", "jpeg", "jpeg", "jpg"] ;
$phoneList = '' ;
$options = '' ;

foreach ($friends AS $number => $name){
    $options .= "<option value='{$name}'>{$name}</option>" ;
}
foreach ($fileFormats AS $number => $format){

    $phoneList .= "<div class='ibv phoneParent'>
    <a class='phone' target='_blank' href='../images/games/spotify/".($number + 1).".{$format}' style='background-image: url(../images/games/spotify/".($number + 1).".{$format})'>

    </a>
    <label>
        <select>
            <option selected disabled>Aucun</option>
            {$options}
        </select>
    </label>
</div>" ;


}


$html = str_replace('{phoneList}', $phoneList, $html) ;
