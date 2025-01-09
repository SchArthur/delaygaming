<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';


if (isset($_GET["id"]) && is_numeric($_GET["id"])){
    $game_manager = new GameManager();
    $game = new Game($game_manager->selectOne($_GET["id"]));
    $game_manager->delete($game);
}

redirect("index.php");