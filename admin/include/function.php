<?php

function redirect($path){
    header("Location:".$path);
    exit();
}

function hsc($string){
    if (empty($string)){
        return "";
    }else{
        return htmlspecialchars($string);
    }
}