<?php

function redirect($path){
    header("Location:".$path);
    exit();
}

function hsc($string){
    if (is_null($string)){
        return "";
    }else{
        return htmlspecialchars($string);
    }
}