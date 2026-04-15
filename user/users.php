<?php require_once __DIR__.'/../backend/conn.php'; ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../login.php?msg=$msg");
    exit;
}
    $query = "SELECT * FROM user";
    $statement = $conn->prepare($query);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="nl">
<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
    <title>Users</title>
</head>

<body>
<?php require_once '../header.php'; ?>

<div class="row">

<div class="taskContainer">
    <table>
        <tr>
            <th>naam</th>
            <th>admin</th>
            <th>afdeling</th>
            <th colspan="2">Acties</th>
        </tr>

    <?php foreach ($user as $userAccount): ?>
        <tr>
            <td><?= htmlspecialchars($userAccount['name']) ?></td>
            <td><?= htmlspecialchars($userAccount['isAdmin']) ?></td>
            <td><?= htmlspecialchars($userAccount['userFunction']) ?></td>
            <td class="Actions"><a href="edit.php?id=<?= $userAccount['id']; ?>" class="edit">Edit</a></td>
            <td class="Actions"><a href="delete.php?id=<?= $userAccount['id']; ?>" class="delete">Delete</a></td>
        </tr>
    <?php endforeach ?>
    </table>
</div>
</div>
</body>
</html>