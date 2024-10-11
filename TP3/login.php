<?php
session_start();

// 模拟用户数据库
$users = array(
    'TianranMou' => 'mtr1234567890',
);

// 处理登录请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (isset($users[$login]) && $users[$login] === $password) {
        $_SESSION['login'] = $login;

        // 设置样式 cookie
        if (isset($_POST['css'])) {
            setcookie('css', $_POST['css'], time() + 3600); // 设置一小时的cookie
        }
        header("Location: index.php");
        exit();
    } else {
        $error = "Login ou mot de passe incorrect";
    }
}

// 检查并应用风格
$cssFile = isset($_COOKIE['css']) ? $_COOKIE['css'] : "style1.css";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="<?php echo $cssFile; ?>">
</head>
<body>
    <h1>Connexion</h1>

    <?php if (isset($error)) echo "<p>$error</p>"; ?>

    <form action="login.php" method="POST">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <label for="css">Choisissez un style :</label>
        <select name="css" id="css">
            <option value="style1.css">Style 1</option>
            <option value="style2.css">Style 2</option>
        </select><br>

        <input type="submit" value="Se connecter...">
    </form>
</body>
</html>

