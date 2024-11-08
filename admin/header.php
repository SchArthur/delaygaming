<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="/admin/js/bootstrap.bundle.min.js"></script>
    <title><?= $title; ?> | DelayGaming</title>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center">
        <a href="/admin/" class="align-self-stretch">
            <img src="/admin/image/logo/logo.png" alt="" title="">
        </a>
        <h1><?= $h1; ?></h1>
        <div>
            <span>Admin</span>
            <i class='bx bx-user-circle'></i>
            <a href="/admin/logout.php">Se déconnecter</a>
        </div>
    </header>
    <main>
        <nav class="sidebar">
            <a class="active" href="/admin/game/index.php">
                <span>Articles</span>
                <i class='bx bx-package'></i>
            </a>
            <a href="#" class="settings">
                <span>Paramètres</span>
                <i class='bx bx-cog'></i>
            </a>        
        </nav>
        <div class="content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/">Gestion du site</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Articles</li>
                </ol>
            </nav>