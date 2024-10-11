<?php
session_start();
session_unset();
session_destroy();
setcookie('css', '', time() - 3600, "/"); // 删除样式cookie
header("Location: login.php");
exit();
?>
