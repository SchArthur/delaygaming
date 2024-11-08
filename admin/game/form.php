<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

$title = "Ajout de formation";
$h1 = "Ajout de formation";
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/header.php';

$game_name = "";
$game_description = "";
$game_editor = "";
$game_price = 0;
$game_id = 0;
$game_image = "";

$button_value = "Ajouter";

if (isset($_GET["id"]) && is_numeric($_GET["id"])){
    $stmt = $db->prepare("SELECT * FROM table_game WHERE game_id = :id");
    $stmt->execute([":id" => $_GET["id"]]);

    if ($row = $stmt->fetch()){
        $game_name = $row["game_name"];
        $game_description = $row["game_description"];
        $game_editor = $row["game_editor"];
        $game_price = $row["game_price"];
        $game_id = $row["game_id"];
        $game_image = $row["game_image"];

        $button_value = "Modifier";
    }
}
?>
            <div class="container-fluid">
                <form action="process.php" method="POST">
                    <div class="row">
                        <div class="col-10 ajout_article">
                            <div class="row">
                                <!-- Texte -->
                                <div class="col-4">
                                    <div>
                                        <label for="game_name">Nom du jeu</label><br/>
                                        <input type="text" id="game_name" name="game_name" value="<?= hsc($game_name); ?>" required autocomplete="off"/>                                      
                                    </div>
                                    <hr>
                                    <div>
                                        <label for="game_description">Description</label><br/>
                                        <textarea name="game_description" id="game_description" cols="30" rows="10"><?= hsc($game_description); ?></textarea>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Données -->
                                <div class="col-4">
                                    <div>
                                        <label for="game_image">Image principale</label><br/>
                                        <input type="file" name="game_image" id="game_image" value="<?= hsc($game_image); ?>" require/>
                                    </div>
                                    <div>
                                        <label for="game_editor">Editor</label><br/>
                                        <input type="text" name="game_editor" id="game_editor" value="<?= hsc($game_editor); ?>" required autocomplete="off"/>
                                    </div>
                                    <hr>
                                    <div>
                                        <label for="game_price">Prix</label><br/>
                                        <input type="number" id="game_price" name="game_price" min="0.00" step="0.01" value="<?= hsc($game_price); ?>" required autocomplete="off"/>
                                        <span>€</span>
                                    </div>
                                    <hr>
                                </div>
                                <!-- INFOS -->
                                <div class="col-4">
                                    <div>
                                        <label for="game_type">Type :</label>
                                        <select name="game_type" id="game_type">
                                            <option value="0">Jeu</option>
                                            <option value="1">DLC</option>
                                        </select>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="hidden" id="post_sent" name="post_sent" value="toto">
                            <input type="hidden" id="game_id" name="game_id" value="<?= hsc($game_id); ?>">
                            <input type="submit" value="<?= $button_value; ?>" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>