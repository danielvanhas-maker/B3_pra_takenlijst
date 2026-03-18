<?php require_once __DIR__.'/../backend/conn.php'; ?>
<?php
if(session_status() == PHP_SESSION_NONE){
    // Start Session it is not started yet
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
    <title>Tasks</title>
</head>

<body>

    <?php require_once '../header.php'; ?>
    <?php require_once '../backend/conn.php';
    $queryNotDone = "SELECT * FROM task WHERE status = 0";
    $statementTaskNotDone = $conn->prepare($queryNotDone);
    $statementTaskNotDone->execute();
    $tasksNotDone = $statementTaskNotDone->fetchAll(PDO::FETCH_ASSOC);
    $queryDone = "SELECT * FROM task WHERE status = 1";
    $statementTaskDone = $conn->prepare($queryDone);
    $statementTaskDone->execute();
    $tasksDone = $statementTaskDone->fetchAll(PDO::FETCH_ASSOC);
    ?>

<div class="container">

    <h2>Not Done Tasks</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Department</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php foreach ($tasksNotDone as $taskNotDone): ?>
            <tr>
                <td><?= htmlspecialchars($taskNotDone['title']) ?></td>
                <td><?= htmlspecialchars($taskNotDone['description']) ?></td>
                <td><?= htmlspecialchars($taskNotDone['department']) ?></td>
                <td>Not Done</td>
                <td><a href="edit.php?id=<?= $taskNotDone['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $taskNotDone['id']; ?>"class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
        </div>
<div class="container">
    <h2>Done Tasks</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Department</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php foreach ($tasksDone as $taskDone): ?>
            <tr>
                <td><?= htmlspecialchars($taskDone['title']) ?></td>
                <td><?= htmlspecialchars($taskDone['description']) ?></td>
                <td><?= htmlspecialchars($taskDone['department']) ?></td>
                <td>Done</td>
                <td><a href="edit.php?id=<?= $taskDone['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $taskDone['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>

</div>


</body>
</html> 