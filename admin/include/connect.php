<?php
session_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=delaygaming;charset=utf8", "root", "");
}catch(Exception $e){
    die($e->getMessage());
}