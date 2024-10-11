<?php
session_start();

// 检查样式的 cookie
if (isset($_COOKIE['css'])) {
    $css = $_COOKIE['css'];
} else {
    $css = 'style1'; // 默认样式
}

// 用户是否已登录
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="<?php echo $css; ?>.css">
</head>
<body>
    <h1>Bienvenue sur ma page d'accueil, <?php echo $_SESSION['login']; ?> !</h1>

    <!-- 样式选择表单 -->
    <form id="style_form" action="index.php" method="GET">
        <label for="css">Choisissez un style :</label>
        <select name="css" id="css">
            <option value="style1" <?php if ($css == 'style1') echo 'selected'; ?>>Style 1</option>
            <option value="style2" <?php if ($css == 'style2') echo 'selected'; ?>>Style 2</option>
        </select>
        <input type="submit" value="Appliquer">
    </form>

    <p><a href="logout.php">Se déconnecter</a></p>
</body>
</html>




