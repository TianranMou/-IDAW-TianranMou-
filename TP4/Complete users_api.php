<?php
require_once("init_pdo.php");

function get_users($db) {
    $sql = "SELECT * FROM users";
    $exe = $db->query($sql);
    $res = $exe->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function get_user($db, $id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

function create_user($db, $data) {
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':name' => $data['name'],
        ':email' => $data['email']
    ]);
    return $db->lastInsertId();
}

function update_user($db, $id, $data) {
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':name' => $data['name'],
        ':email' => $data['email']
    ]);
}

function delete_user($db, $id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

function setHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");
}

setHeaders();

// Responses
switch($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = get_user($pdo, $_GET['id']);
            if ($result) {
                echo json_encode($result);
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
            $userId = create_user($pdo, $data);
            http_response_code(201);
            echo json_encode(["message" => "User created successfully", "id" => $userId]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Unable to create user. Data is incomplete."]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_GET['id']) && !empty($data['name']) && !empty($data['email'])) {
            if (update_user($pdo, $_GET['id'], $data)) {
                echo json_encode(["message" => "User updated successfully"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "User not found"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Unable to update user. Data is incomplete."]);
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
            echo json_encode(["message" => "Unable to delete user. No ID provided."]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>