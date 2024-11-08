<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

if(isset($_FILES["game_image"])){
    if(isset($_FILES["game_image"]) && $_FILES["game_image"]["error"] == 0){
        $extension = strtolower(pathinfo($_FILES["game_image"]["name"], PATHINFO_EXTENSION));
        $extensions = ["jpg", "jpeg", "gif", "png", "webp"];

        
        if (str_replace("jpg","jpeg", $extension) != str_replace("image/", "",$_FILES["game_image"]["type"])){
            rickRoll(); // A remplacer par un vrai message d'erreur
        } else{
            if(!in_array($extension, $extensions)){
                rickRoll(); // A remplacer par un vrai message d'erreur
            }
        }



        $game_image = $_POST["game_name"];
        $game_image = cleanFilename($game_image);
        $game_image = checkFilename($game_image);

        var_dump($_FILES["game_image"]);

        move_uploaded_file($_FILES["game_image"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . '/upload/' . $game_image . "." . $extension);
    }
}

exit();

if (isset($_POST["post_sent"]) && ($_POST["post_sent"] == "toto")){
    if ($_POST["game_id"] == 0){
        $stmt = $db->prepare("INSERT INTO table_game (game_name, game_description, game_editor, game_price, game_type) VALUES (:game_name, :game_description, :game_editor, :game_price, :game_type)");
        $stmt->execute([":game_name" => $_POST["game_name"],
                                ":game_description" => $_POST["game_description"],
                                ":game_editor" => $_POST["game_editor"],
                                ":game_price" => $_POST["game_price"],
                                ":game_type" => $_POST["game_type"]]);
    } else {
        $stmt = $db->prepare("UPDATE table_game SET game_name = :game_name, game_description = :game_description, game_editor = :game_editor, game_price = :game_price, game_type = :game_type WHERE game_id = :game_id");
        $stmt->bindValue(":game_name", $_POST["game_name"]);
        $stmt->bindValue(":game_description", $_POST["game_description"]);
        $stmt->bindValue(":game_editor", $_POST["game_editor"]);
        $stmt->bindValue(":game_price", $_POST["game_price"]);
        $stmt->bindValue(":game_id", $_POST["game_id"]);
        $stmt->bindValue(":game_type", $_POST["game_type"]);

        $stmt->execute();
    }
}
redirect("index.php");
?>