<?php
require_once('config.php');

$connectionString = "mysql:host=". _MYSQL_HOST;

if(defined('_MYSQL_PORT'))
    $connectionString .= ";port=". _MYSQL_PORT;

$connectionString .= ";dbname=". _MYSQL_DBNAME;
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$pdo = NULL;
try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $erreur) {
    echo 'Erreur de connexion : ' . $erreur->getMessage();
    exit;
}

if ($pdo) {
    try {
        $request = $pdo->prepare("select * from users");
        $request->execute();

        echo "<table border='1'>
        <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Email</th>
        </tr>";

        while($row = $request->fetch(PDO::FETCH_OBJ)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row->id) . "</td>";
            echo "<td>" . htmlspecialchars($row->name) . "</td>";
            echo "<td>" . htmlspecialchars($row->email) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } catch (PDOException $e) {
        echo "Erreur d'exécution de la requête : " . $e->getMessage();
    }
}

$pdo = null;
?>