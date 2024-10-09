<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heure actuelle</title>
    <style>
        /* 设置页面高度，使其占满整个屏幕 */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center; /* 水平居中 */
            align-items: center; /* 垂直居中 */
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* 背景色可以根据需要修改 */
        }

        h1, p {
            margin: 0;
            text-align: center; /* 文本居中 */
        }

        p {
            font-size: 2em; /* 调整时间显示的字体大小 */
            color: #333; /* 调整字体颜色 */
        }
    </style>
</head>
<body>
    <div>
        <h1>Heure actuelle :</h1>
        <p>
            <?php
            date_default_timezone_set('Europe/Paris'); // 设置时区
            echo date('H:i:s'); // 输出当前时间
            ?>
        </p>
    </div>
</body>
</html>
