<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

$title = "Index";
$h1 = "index";
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/header.php';
?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Promotion</th>
                        <th scope="col">Prix après réduction</th>
                        <th scope="col">Catégorie(s)</th>
                        <th scope="col">Couleurs(s)</th>
                        <th scope="col">État</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Chaussons</td>
                        <td>25,99€</td>
                        <td>-20%</td>
                        <td>20,79€</td>
                        <td>Adulte</td>
                        <td>Bleu</td>
                        <td>En ligne</td>
                        <td>
                            <a href="#">
                                <i class='bx bx-show'></i>  
                            </a>
                            <a href="#">
                                <i class='bx bx-edit'></i>
                            </a>
                            <a href="#">
                                <i class='bx bx-trash'></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <form action="#">
                <button type="submit" value="Add Item" class="main-button">
                    <i class='bx bx-add-to-queue'></i>
                    <span>Ajouter un article</span>
                </button>
            </form>
        </div>
    </main>
</body>
</html>