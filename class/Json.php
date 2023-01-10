<?php

class Json
{
    public $savedFile = [] ;

    public function getFile(string $name){

        if (!isset($this->savedFile[$name])) {
            $content = json_decode(file_get_contents("json/{$name}.json"));
        } else{
            $content = $this->savedFile[$name] ;
        }

      return $content ;
    }

}