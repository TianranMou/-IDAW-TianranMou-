<?php
require_once('../config.php');

try {
    // connect MySQL
    $pdo = new PDO("mysql:host="._MYSQL_HOST.";port="._MYSQL_PORT, _MYSQL_USER, _MYSQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // load SQL 
    $sql = file_get_contents('sql/create_db.sql');

    
    $pdo->exec($sql);

    echo "Base de données initialisée avec succès !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>