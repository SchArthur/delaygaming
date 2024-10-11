<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

$stmt = $db->prepare("INSERT INTO table_game (game_name, game_description, game_editor, game_price) VALUES (:game_name, :game_description, :game_editor, :game_price)");

if (isset($_POST["post_sent"]) && ($_POST["post_sent"] == "toto")){
    $stmt->execute([":game_name" => $_POST["game_name"],
                            ":game_description" => $_POST["game_description"],
                            ":game_editor" => $_POST["game_editor"],
                            ":game_price" => $_POST["game_price"]]);
}
redirect("index.php");