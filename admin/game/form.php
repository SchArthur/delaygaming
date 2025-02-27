<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

$title = "Ajout d'article";
$h1 = "Ajout d'article";
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/header.php';


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    if ($row = (new GameManager())->selectOne($_GET["id"])) {
        $game = new Game($row);

        $button_value = "Modifier";
    }
} else {
    $game = new Game();

    $button_value = "Ajouter";
}

// var_dump($game);
?>
<div class="container-fluid">
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-10 ajout_article">
                <div class="row">
                    <!-- Texte -->
                    <div class="col-4">
                        <div>
                            <label for="game_name">Nom du jeu</label><br />
                            <input type="text" id="game_name" name="game_name" value="<?= $game->getName(); ?>" required
                                autocomplete="off" />
                        </div>
                        <hr>
                        <div>
                            <label for="game_description">Description</label><br />
                            <textarea name="game_description" id="game_description" cols="30"
                                rows="10"><?= $game->getDescription(); ?></textarea>
                        </div>
                        <hr>
                    </div>
                    <!-- Données -->
                    <div class="col-4">
                        <div>
                            <label for="game_image">Image principale</label><br />
                            <input type="file" name="game_image" id="game_image"
                                accept="image/png, image/jpeg, image/gif, image/webp" require />
                        </div>
                        <div>
                            <label for="game_editor">Editor</label><br />
                            <input type="text" name="game_editor" id="game_editor" value="<?= $game->getEditor(); ?>"
                                required autocomplete="off" />
                        </div>
                        <hr>
                        <div>
                            <label for="game_price">Prix</label><br />
                            <input type="number" id="game_price" name="game_price" min="0.00" step="0.01"
                                value="<?= $game->getPrice(); ?>" required autocomplete="off" />
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
                <input type="hidden" id="game_id" name="game_id" value="<?= $game->getId(); ?>">
                <input type="submit" value="<?= $button_value; ?>" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
</div>
</main>
</body>

</html>