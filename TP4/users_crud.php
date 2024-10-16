<?php
require_once('config.php');

$pdo = new PDO("mysql:host="._MYSQL_HOST.";dbname="._MYSQL_DBNAME.";charset=utf8", _MYSQL_USER, _MYSQL_PASSWORD);

// Create
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email']]);
}

// Update
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['id']]);
}

// Delete
if (isset($_POST['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}

// Read
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <style>
        .edit-form { display: none; }
    </style>
    <script>
        function toggleEditForm(id) {
            var form = document.getElementById('edit-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <h1>Users</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <button onclick="toggleEditForm(<?= $user['id'] ?>)">Modifier</button>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="submit" name="delete" value="Supprimer">
                </form>
                <form id="edit-form-<?= $user['id'] ?>" class="edit-form" method="post">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    <input type="submit" name="update" value="Sauvegarder">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter un utilisateur</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="submit" name="add" value="Ajouter">
    </form>
</body>
</html>