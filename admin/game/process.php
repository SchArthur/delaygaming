<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

//Chemin vers le fichier upload
$path = $_SERVER["DOCUMENT_ROOT"] . "/upload/";

//Format d'image de dimension
$img_format = Game::IMG_FORMAT;


if (isset($_POST["post_sent"]) && ($_POST["post_sent"] == "toto")) {
    if (isset($_POST["game_id"]) && $_POST["game_id"] > 0) {
        if ($row = (new GameManager())->selectOne($_POST["game_id"])) {
            $game = new Game($row);
        } else {
            $game = new Game();
        }
    } else {
        $game = new Game();
    }
    
    $game->hydrate($_POST);

    if (isset($_FILES["game_image"])) {
        if (isset($_FILES["game_image"]) && $_FILES["game_image"]["error"] == 0) {
            $extension = strtolower(pathinfo($_FILES["game_image"]["name"], PATHINFO_EXTENSION));
            $extensions = ["jpg", "jpeg", "gif", "png", "webp"];


            if (str_replace("jpg", "jpeg", $extension) != str_replace("image/", "", $_FILES["game_image"]["type"])) {
                rickRoll(); // A remplacer par un vrai message d'erreur
            } else {
                if (!in_array($extension, $extensions)) {
                    rickRoll(); // A remplacer par un vrai message d'erreur
                }
            }

            if ($game->getImage() != "") {
                foreach (Game::IMG_FORMAT as $prefix => $data){
                    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $game->getImage())) {
                        unlink($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $game->getImage());
                    }
                }
            }

            $image = $_POST["game_name"];
            $image = cleanFilename($image);
            $image = checkFilename($image);

            $file = $image . "." . $extension;

            move_uploaded_file($_FILES["game_image"]["tmp_name"], $path . $file);

            $src_file = $file;

            foreach ($img_format as $prefix => $info) {

                $dest_width = $info["width"];
                $dest_height = $info["height"];
                $crop = $info["crop"];

                if ($sizes = getimagesize($path . $src_file)) {

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

                switch ($extension) {
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


                if (!$crop) {
                    imagecopyresampled($dest, $src, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
                } else {
                    if ($src_width > $src_height) {
                        //PAYSAGE
                        imagecopyresampled($dest, $src, 0, 0, round(($src_width - $src_height) / 2), 0, $dest_width, $dest_height, $src_height, $src_height);
                    } else {
                        //PORTRAIT
                        imagecopyresampled($dest, $src, 0, 0, 0, round(($src_height - $src_width) / 2), $dest_width, $dest_height, $src_width, $src_width);
                    }
                }

                imagewebp($dest, $path . $prefix . $image . ".webp", 100);

                if (!$crop) {
                    $extension = "webp";
                    $src_file = $prefix . $image . "." . $extension;
                }
            }

            deleteFile($path . $file);

            $game->setImage($image . ".webp");
        }
    }

    (new GameManager())->save($game);
}

redirect("index.php");
?>