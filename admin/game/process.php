<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

//Chemin vers le fichier upload
$path = $_SERVER["DOCUMENT_ROOT"] . "/upload/";

//Format d'image de dimension
$img_format = [
    "lg_" => ["width" => 1200, "height" => 900, "crop" => false],
    "md_" => ["width" => 800, "height" => 600, "crop" => false],
    "sm_" => ["width" => 400, "height" => 400, "crop" => true],
    "xs_" => ["width" => 200, "height" => 150, "crop" => false]
    ] ;
    
/* 
if(isset($_FILES["game_image"])){
    if(isset($_FILES["game_image"]) && $_FILES["game_image"]["error"] == 0){
        $extension = strtolower(pathinfo($_FILES["game_image"]["name"], PATHINFO_EXTENSION));
        $extensions = ["jpg", "jpeg", "gif", "png", "webp"];

        
        if (str_replace("jpg","jpeg", $extension) != str_replace("image/", "",$_FILES["game_image"]["type"])){
            rickRoll(); // A remplacer par un vrai message d'erreur
        } else {
            if(!in_array($extension, $extensions)){
                rickRoll(); // A remplacer par un vrai message d'erreur
            }
        }

        $image = $_POST["game_name"];
        $image = cleanFilename($image);
        $image = checkFilename($image);

        $file = $image . "." . $extension;

        move_uploaded_file($_FILES["game_image"]["tmp_name"], $path . $file);

        $src_file = $file;
        
        foreach ($img_format as $folder => $info){

            $dest_width = $info["width"];
            $dest_height = $info["height"];
            $crop = $info["crop"];

            if ($sizes = getimagesize($path . $src_file)){  
                
                $src_width = $sizes[0];
                $src_height = $sizes[1];
            } else {
                exit();
            }

            if ($src_width > $dest_width || $src_height > $dest_height) {
                if (!$crop) {
                    if ($src_width > $src_height) {
                        // Image au format PAYSAGE
                        $dest_height = round($src_height * $dest_width / $src_width);
                    } else {
                        // Image au format PORTRAIT
                        $dest_width = round($src_width * $dest_height / $src_height);
                    }
                }
            } else {
                $dest_height = $src_height;
                $dest_width = $src_width;

                // Dans le cas où l'image est plus petite que la taille demandée, on ne crop pas.
                $crop = false;
            }

            // Créer une image à la nouvelle dimension
            $dest = imagecreatetruecolor($dest_width, $dest_height);

            switch ($extension){
                case "jpeg":
                case "jpg":
                    $src = imagecreatefromjpeg($path . $src_file);
                    break;
                case "png":
                    $src = imagecreatefrompng($path . $src_file);
                    break;
                case "gif":
                    $src = imagecreatefromgif($path . $src_file);
                    break;
                case "webp":
                    $src = imagecreatefromwebp($path . $src_file);
                    break;
                default:
                    exit();   
                }

                
            if (!$crop){
                imagecopyresampled($dest, $src,0,0,0,0,$dest_width, $dest_height, $src_width, $src_height);
            } else {
                if ($src_width > $src_height){
                    //PAYSAGE
                    imagecopyresampled($dest,$src, 0,0, round(($src_width - $src_height) / 2), 0,$dest_width, $dest_height, $src_height, $src_height);
                } else {
                    //PORTRAIT
                    imagecopyresampled($dest,$src, 0,0, 0, round(($src_height - $src_width) / 2),$dest_width, $dest_height, $src_width, $src_width);
                }
            }

            imagewebp($dest, $path . $folder . $image . ".webp", 100);

            if (!$crop){
                $extension = "webp";
                $src_file = $folder . $image . "." . $extension;
            }
        }

        deleteFile($path . $file);
    }
}
 */

if (isset($_POST["post_sent"]) && ($_POST["post_sent"] == "toto")){

    if(isset($_POST["game_id"]) && $_POST["game_id"] > 0){
        if ($row = $stmt->fetch()){
            $game = new Game($row);
        } else {
            $game = new Game();
        }
    } else {
        $game = new Game();
    }

    $game->hydrate($_POST);

    /* if ($_POST["game_id"] == 0){
        $stmt = $db->prepare("INSERT INTO table_game (game_name, game_description, game_editor, game_price, game_type, game_image) VALUES (:game_name, :game_description, :game_editor, :game_price, :game_type, :game_image)");
        $stmt->execute([":game_name" => $_POST["game_name"],
                                ":game_description" => $_POST["game_description"],
                                ":game_editor" => $_POST["game_editor"],
                                ":game_price" => $_POST["game_price"],
                                ":game_type" => $_POST["game_type"],
                                ":game_image" => $image . ".webp" ]);
    } else {
        $stmt = $db->prepare("UPDATE table_game SET game_name = :game_name, game_description = :game_description, game_editor = :game_editor, game_price = :game_price, game_type = :game_type, game_image = :game_image WHERE game_id = :game_id");
        $stmt->bindValue(":game_name", $_POST["game_name"]);
        $stmt->bindValue(":game_description", $_POST["game_description"]);
        $stmt->bindValue(":game_editor", $_POST["game_editor"]);
        $stmt->bindValue(":game_price", $_POST["game_price"]);
        $stmt->bindValue(":game_id", $_POST["game_id"]);
        $stmt->bindValue(":game_type", $_POST["game_type"]);
        $stmt->bindValue(":game_image", $image . ".webp");

        $stmt->execute();
    } */
}
redirect("index.php");
?>