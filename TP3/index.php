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
$style_name = ($style == 'style1') ? 'Blue Style' : 'Red Style';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Style Selector</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($css_file); ?>">
</head>
<body>
    <div class="container">
        <header>
            <?php
            if(isset($_SESSION['login'])) {
                echo "<p>Logged in as: " . htmlspecialchars($_SESSION['login']) . " | <a href='logout.php'>Log out</a></p>";
            } else {
                echo "<p>Not logged in | <a href='login.php'>Log in</a></p>";
            }
            ?>
        </header>
        <main>
            <h1>Choose Your Preferred Style</h1>
            <form id="style_form" action="index.php" method="GET">
                <select name="css">
                    <option value="style1" <?php if($style == 'style1') echo 'selected'; ?>>Blue Style</option>
                    <option value="style2" <?php if($style == 'style2') echo 'selected'; ?>>Red Style</option>
                </select>
                <input type="submit" value="Apply" />
            </form>
            <p>Current style: <?php echo htmlspecialchars($style_name); ?></p>
        </main>
    </div>
</body>
</html>