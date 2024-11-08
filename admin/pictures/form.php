<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/protection.php';

$title = "Ajout d'image";
$h1 = "Ajout d'image'";

$button_value = "Ajouter";
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/header.php';

?>
            <div class="container-fluid">
                <form action="traitement.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                        <div class="col-10 ajout_article">
                            <div class="row">
                                <!-- Texte -->
                                <div class="col-4">
                                    <input type="file">
                                </div>
                                <!-- Données -->
                                <div class="col-4">
                                    
                                </div>
                                <!-- INFOS -->
                                <div class="col-4">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="hidden" id="post_sent" name="post_sent" value="toto">
                            <input type="submit" value="<?= $button_value; ?>" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>