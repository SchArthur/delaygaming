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
                                        <textarea name="game_description" id="game_description" cols="30" rows="10" value="<?= hsc($game_description); ?>"></textarea>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Données -->
                                <div class="col-4">
                                    <div>
                                        <label for="game_editor">Editeur</label><br/>
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
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="hidden" id="post_id" name="post_id" value="toto">
                            <input type="submit" value="Ajouter" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>