<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon CV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- 左侧导航栏 -->
        <nav>
            <img src="GARFIELD0.jpg" alt="Garfield Image">
            <div class="info-text">
                <p><strong>Tianran Mou</strong></p>
                <p><strong>Date de naissance :</strong> 01/05/2001</p>
                <p><strong>Portable :</strong> +86 18555508899</p>
                <p><strong>E-mail :</strong> tianranmou@gmail.com</p>
                <p><strong>Adresse :</strong> No. 11, Voie 3, Rue de Wenhua, District de Heping, Shenyang, Province du Liaoning</p>
            </div>

            <!-- 调用动态菜单 -->
            <?php
            require_once('template_menu.php');
            renderMenuToHTML($currentPageId);
            ?>
        </nav>
        <div class="content">
