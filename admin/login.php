<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/function.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/admin/include/connect.php';

// && ne vérifie pas les deux opérations si la première est fausse.
// 'and' vérifie les deux systematiquement.
// idem pour || et 'or'.

$error = "";
if (!empty($_POST["user_email"]) && !empty($_POST["user_password"])){
    $stmt = $db->prepare("SELECT * FROM table_user WHERE user_email=:email");
    $stmt->execute([":email" => $_POST["user_email"]]);
    if ($row = $stmt->fetch()){
        if (password_verify($_POST["user_password"], $row['user_password'])){
            /* 
            session_start() avant d'utiliser des variables de session
            Ici, session_start() est dans 'connect.php', required au début de script.

            Associer une valeure à $_SESSION["logged"] permet de déconnecter l'utilisateur avant la fin de sa session.
             */
            $_SESSION["logged"] = "1";
            redirect("index.php");
        }
        //Erreur MDP
        $error = "Erreur de connexion";
    }
    //Erreur mail
    $error = "Erreur de connexion";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Login | DelayGaming</title>
</head>
<body>
    <img src="image/logo/logo.png" alt="" title="">
    <form class="form" action="login.php" method="POST">
        <?php if ($error != ""){?>
            <div><?= $error; ?></div>
        <?php } ?>
        <span class="input-span">
            <label for="user_email" class="label">Adresse E-mail</label>
            <input type="email" name="user_email" id="user_email" required/>
        </span>
        <span class="input-span">
            <label for="user_password" class="label">Mot de passe</label>
            <input type="password" name="user_password" id="user_password" required/>
        </span>
        <span class="span"><a href="forgot_pw.html">Mot de passe oublié?</a></span>
        <input class="submit" type="submit" value="Se connecter" />
    </form>
</body>
</html>