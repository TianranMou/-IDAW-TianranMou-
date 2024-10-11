<?php
session_start();

// Check if there's a style selection
if (isset($_GET['css'])) {
    $style = $_GET['css'];
    setcookie('preferred_style', $style, time() + (86400 * 30), "/");
} else {
    $style = isset($_COOKIE['preferred_style']) ? $_COOKIE['preferred_style'] : 'style1';
}

$css_file = $style . '.css';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($css_file); ?>">
</head>
<body>
    <h1>Login</h1>
    <form action="connected.php" method="POST">
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Connect">
        </div>
    </form>
</body>
</html>