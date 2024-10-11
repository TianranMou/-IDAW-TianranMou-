<?php
session_start();

// 检查用户是否登录
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// 检查并应用风格
if (isset($_COOKIE['css'])) {
    $cssFile = $_COOKIE['css'];
} else {
    $cssFile = "style1.css"; // 默认风格
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="<?php echo $cssFile; ?>">
</head>
<body>
    <h1>Bienvenue sur ma page d'accueil, <?php echo $_SESSION['login']; ?> !</h1>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>



