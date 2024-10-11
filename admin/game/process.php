<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';


if (isset($_POST["post_sent"]) && ($_POST["post_sent"] == "toto")){
    if ($_POST["game_id"] == 0){
        $stmt = $db->prepare("INSERT INTO table_game (game_name, game_description, game_editor, game_price) VALUES (:game_name, :game_description, :game_editor, :game_price)");
        $stmt->execute([":game_name" => $_POST["game_name"],
                                ":game_description" => $_POST["game_description"],
                                ":game_editor" => $_POST["game_editor"],
                                ":game_price" => $_POST["game_price"]]);
    } else {
        $stmt = $db->prepare("UPDATE table_game SET game_name = :game_name, game_description = :game_description, game_editor = :game_editor, game_price = :game_price WHERE game_id = :game_id");
        $stmt->bindValue(":game_name", $_POST["game_name"]);
        $stmt->bindValue(":game_description", $_POST["game_description"]);
        $stmt->bindValue(":game_editor", $_POST["game_editor"]);
        $stmt->bindValue(":game_price", $_POST["game_price"]);
        $stmt->bindValue(":game_id", $_POST["game_id"]);

        $stmt->execute();
    }
}
redirect("index.php");