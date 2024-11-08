<?php

function redirect($path){
    header("Location:".$path);
    exit();
}

function rickRoll(){
    redirect("https://www.youtube.com/watch?v=xvFZjo5PgG0");
}

function hsc($string){
    if (is_null($string)){
        return "";
    }else{
        return htmlspecialchars($string);
    }
}

function cleanFilename($file_name){
    // A améliorer
    // htmlentities(); -> a regarder
    $tabKO = [" ", "'", '"', "é", "è", "ê", "ë", "ñ", "ç", "à"];
    $tabOK = ["_", "_", "_", "e", "e" ,"e", "e", "n", "c", "a"];
    $resultat = str_replace($tabKO, $tabOK, strtolower($file_name));
    return $resultat;
}

function checkFilename($file_name){
    $result = $file_name;

    $cpt = 1;
    while (file_exists($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $result . ($cpt>1 ? "_(" .$cpt. ")" : "") . ".webp")){
        $cpt++;
    }

    return $result . ($cpt>1 ? "_(" .$cpt. ")" : "");
}