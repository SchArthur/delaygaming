<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';
$title = "Jeux";
$h1 = "Liste des jeux";
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/header.php';

$stmt = $db->prepare("SELECT * FROM table_game");
$stmt->execute();


$recordset = $stmt->fetchAll();
?>
            <div>
                <div class="container-fluid">
                    <div class="row search_row">
                        <div class="col-3 search_col">
                            <div>
                                <input type="checkbox" id="online_article" name="online_article">
                                <label for="online_article">Article en ligne</label>
                            </div>
                        </div>
                        <div class="col-3 search_col">
                            <h2 class="h4">Recherche</h2>
                            <hr>
                            <form action="index.php" method="GET">
                                <div>
                                    <label for="game_name">Nom de l'article :</label>
                                    <br/>
                                    <input type="search" id="game_name" name="game_name">
                                </div>
                                <div>
                                    <label for="game_editor">Nom de l'éditeur :</label>
                                    <br/>
                                    <input type="search" id="game_editor" name="game_editor">
                                </div>
                                <div>
                                    <input type="hidden" name="search" value="1" id="search">
                                    <input type="submit" value="Chercher" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                        <div class="col-3 search_col">
                            
                        </div>
                        <div class="col-3 search_col">
                            <form action="form.php">
                                <button type="submit" value="Add Item" class="main-button">
                                    <i class='bx bx-add-to-queue'></i>
                                    <span>Ajouter un jeu</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="crud_table table">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Editeur</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recordset as $row){
                        $item = new Game($row);
                        ?>
                        <tr>
                            <td><?= $item->getName(); ?></td>
                            <td><?= hsc($row["game_editor"]); ?></td>
                            <td><?= hsc($row["game_price"]) . ' €'; ?></td>
                            <td><?= hsc($row["game_status"]); ?></td>
                            <td><?= hsc($row["game_type"]); ?></td>
                            <td>
                                <a href="#">
                                    <i class='bx bx-show'></i>  
                                </a>
                                <a href="form.php?id=<?= hsc($row["game_id"]); ?>">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a href="delete.php?id=<?= hsc($row["game_id"]); ?>">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>