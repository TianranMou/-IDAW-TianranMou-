<?php
session_start();

// 模拟用户数据库
$users = array(
    'TianranMou' => 'mtr1234567890'
);

// 获取登录信息
$login = isset($_POST['login']) ? $_POST['login'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// 检查登录信息
if (isset($users[$login]) && $users[$login] == $password) {
    $_SESSION['login'] = $login;
    header('Location: index.php'); // 登录后重定向到 index.php
} else {
    echo "<h1>Erreur de login ou de mot de passe</h1>";
    echo '<a href="login.php">Réessayer</a>';
}
?>

