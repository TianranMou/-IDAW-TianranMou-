<?php
session_start();

// Check if there's a choose of style
if (isset($_GET['css'])) {
    $style = $_GET['css'];
    setcookie('preferred_style', $style, time() + (86400 * 30), "/");
} else {
    $style = isset($_COOKIE['preferred_style']) ? $_COOKIE['preferred_style'] : 'style1';
}

$css_file = $style . '.css';

$users = array('TianranMou' => '123456789');

$login = "anonymous";
$errorText = "";
$successfullyLogged = false;

if(isset($_POST['login']) && isset($_POST['password'])) {
    $tryLogin = $_POST['login'];
    $tryPwd = $_POST['password'];

    if(array_key_exists($tryLogin, $users) && $users[$tryLogin] == $tryPwd) {
        $successfullyLogged = true;
        $login = $tryLogin;
        $_SESSION['login'] = $login;
    } else {
        $errorText = "Incorrect username or password";
    }
} else {
    $errorText = "Please use the login form";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $successfullyLogged ? 'Welcome' : 'Login Error'; ?></title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($css_file); ?>">
</head>
<body>
    <?php if($successfullyLogged): ?>
        <h1>Welcome, <?php echo htmlspecialchars($login); ?>!</h1>
        <p>Logged in as: <?php echo htmlspecialchars($_SESSION['login']); ?></p>
        <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <h1>Login Error</h1>
        <p><?php echo htmlspecialchars($errorText); ?></p>
        <p><a href="login.php">Try again</a></p>
    <?php endif; ?>

    <h2>Input Information:</h2>
    <p>Username: <?php echo htmlspecialchars(isset($_POST['login']) ? $_POST['login'] : ''); ?></p>
    <p>Password: <?php echo str_repeat('*', strlen(isset($_POST['password']) ? $_POST['password'] : '')); ?></p>
</body>
</html>