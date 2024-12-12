<?php

function redirect($path)
{
    header("Location:" . $path);
    exit();
}

function rickRoll()
{
    redirect("https://www.youtube.com/watch?v=xvFZjo5PgG0");
}

function hsc($string)
{
    if (is_null($string)) {
        return "";
    } else {
        return htmlspecialchars($string);
    }
}

function cleanFilename($file_name)
{
    // A améliorer
    // htmlentities(); -> a regarder
    $tabKO = [" ", "'", '"', "é", "è", "ê", "ë", "ñ", "ç", "à"];
    $tabOK = ["_", "_", "_", "e", "e", "e", "e", "n", "c", "a"];
    $resultat = str_replace($tabKO, $tabOK, strtolower($file_name));
    return $resultat;
}

function checkFilename($file_name)
{
    global $img_format;
    $prefix = array_key_first($img_format);
    $result = $file_name;

    $cpt = 1;
    while (file_exists($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $result . ($cpt > 1 ? "_(" . $cpt . ")" : "") . ".webp")) {
        $cpt++;
    }

    return $result . ($cpt > 1 ? "_(" . $cpt . ")" : "");
}

function deleteFile($fullpath)
{
    if (file_exists($fullpath)) {
        unlink($fullpath);
    }
}

spl_autoload_register("loadClass");

function loadClass($className)
{
    $file = $_SERVER["DOCUMENT_ROOT"] . "/class/" . $className . ".class.php";
    if (file_exists($file)) {
        require_once $file;
    }
}