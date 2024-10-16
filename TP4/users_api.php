<?php
require_once("config.php");

// connect to Mysql
$connectionString = "mysql:host=" . _MYSQL_HOST;
if(defined('_MYSQL_PORT')) {
    $connectionString .= ";port=" . _MYSQL_PORT;
}
$connectionString .= ";dbname=" . _MYSQL_DBNAME;
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit;
}

function get_users($db) {
    $sql = "SELECT * FROM users";
    $exe = $db->query($sql);
    return $exe->fetchAll(PDO::FETCH_OBJ);
}

function get_user($db, $id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

function create_user($db, $name, $email) {
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $db->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email]);
    return $db->lastInsertId();
}

function update_user($db, $id, $name, $email) {
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt = $db->prepare($sql);
    return $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email]);
}

function delete_user($db, $id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

function setHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}

setHeaders();

$method = $_SERVER["REQUEST_METHOD"];

switch($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $user = get_user($pdo, $_GET['id']);
            if ($user) {
                echo json_encode($user);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
            }
        } else {
            $result = get_users($pdo);
            echo json_encode($result);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['name']) && !empty($data['email'])) {
            $userId = create_user($pdo, $data['name'], $data['email']);
            http_response_code(201);
            echo json_encode(["message" => "User created successfully", "id" => $userId]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Name and email are required"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_GET['id']) && !empty($data['name']) && !empty($data['email'])) {
            if (update_user($pdo, $_GET['id'], $data['name'], $data['email'])) {
                echo json_encode(["message" => "User updated successfully"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID, name and email are required"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            if (delete_user($pdo, $_GET['id'])) {
                echo json_encode(["message" => "User deleted successfully"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "User ID is required"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

$pdo = null;
?>