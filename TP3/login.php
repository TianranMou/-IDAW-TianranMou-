<?php
session_start();

// 检查是否有提交的样式，并将其保存到 cookie 中
if (isset($_GET['css'])) {
    setcookie('css', $_GET['css'], time() + (86400 * 30), "/"); // 有效期30天
    $css = $_GET['css'];
} else if (isset($_COOKIE['css'])) {
    $css = $_COOKIE['css'];
} else {
    $css = 'style1'; // 默认样式
}

// 模拟用户数据库
$users = array(
    'TianranMou' => 'mtr1234567890',
);

$login = "";
$pwd = "";
$errorText = "";

// 检查表单提交
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $pwd = $_POST['password'];

    // 验证用户
    if (array_key_exists($login, $users) && $users[$login] == $pwd) {
        $_SESSION['login'] = $login;
        header("Location: index.php");
        exit;
    } else {
        $errorText = "Erreur de login/mot de passe";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- 加载用户选择的样式 -->
    <link rel="stylesheet" href="<?php echo $css; ?>.css">
</head>
<body>
    <h1>Connexion</h1>

    <?php if ($errorText != ""): ?>
        <p style="color: red;"><?php echo $errorText; ?></p>
    <?php endif; ?>

    <!-- 登录表单 -->
    <form id="login_form" action="login.php" method="POST">
        <table>
            <tr>
                <th>Login :</th>
                <td><input type="text" name="login" value="<?php echo $login; ?>"></td>
            </tr>
            <tr>
                <th>Mot de passe :</th>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Se connecter..."></td>
            </tr>
        </table>
    </form>

    <!-- 样式选择表单 -->
    <form id="style_form" action="login.php" method="GET">
        <label for="css">Choisissez un style :</label>
        <select name="css" id="css">
            <option value="style1" <?php if ($css == 'style1') echo 'selected'; ?>>Style 1</option>
            <option value="style2" <?php if ($css == 'style2') echo 'selected'; ?>>Style 2</option>
        </select>
        <input type="submit" value="Appliquer">
    </form>
</body>
</html>




