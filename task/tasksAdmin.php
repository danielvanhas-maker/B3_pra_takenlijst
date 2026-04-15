<?php require_once __DIR__.'/../backend/conn.php'; ?>
<?php
if(session_status() == PHP_SESSION_NONE){
    // Start Session it is not started yet
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../index.php?msg=$msg");
    exit;
}
if (!isset($_SESSION['user_admin']))
    {
    header("Location: tasks.php");
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
<a href="tasksPersonal.php">Naar persoonlijke taken</a>

<?php 
$queryNotDone = "SELECT * FROM task WHERE status = 'Not Done'"; 
$statementTaskNotDone = $conn->prepare($queryNotDone); 
$statementTaskNotDone->execute(); 
$tasksNotDone = $statementTaskNotDone->fetchAll(PDO::FETCH_ASSOC); 

$queryInReview = "SELECT * FROM task WHERE status = 'In Review'"; 
$statementTaskInReview = $conn->prepare($queryInReview); 
$statementTaskInReview->execute(); 
$tasksInReview = $statementTaskInReview->fetchAll(PDO::FETCH_ASSOC);   

$queryDone = "SELECT * FROM task WHERE status = 'Done'"; 
$statementTaskDone = $conn->prepare($queryDone); 
$statementTaskDone->execute(); 
$tasksDone = $statementTaskDone->fetchAll(PDO::FETCH_ASSOC); 
?>
<div class="row">

<div class="taskContainer">
    <h2>Te Doen</h2>
    <table>
        <tr>
            <th>Titel</th>
            <th>Beschrijving</th>
            <th>Afdeling</th>
            <th>Status</th>
            <th>Deadline</th>
            <th colspan="2">Acties</th>
        </tr>

        <?php foreach ($tasksNotDone as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= htmlspecialchars($task['department']) ?></td>
                <td>Te Doen</td>
                <td><?= $task['deadline']?></td>
                <td><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class="taskContainer">
    <h2>Task In Review</h2>
    <table>
        <tr>
            <th>Titel</th>
            <th>Beschrijving</th>
            <th>Afdeling</th>
            <th>Status</th>
            <th>Deadline</th>
            <th colspan="2">Acties</th>
        </tr>

        <?php foreach ($tasksInReview as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= htmlspecialchars($task['department']) ?></td>
                <td>In Review</td>
                <td><?= $task['deadline']?></td>
                <td><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class="taskContainer">
    <h2>Voltooid</h2>
    <table>
        <tr>
            <th>Titel</th>
            <th>Beschrijving</th>
            <th>Afdeling</th>
            <th>Status</th>
            <th>Deadline</th>
            <th colspan="2">Acties</th>
        </tr>

        <?php foreach ($tasksDone as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= htmlspecialchars($task['department']) ?></td>
                <td>Voltooid</td>
                <td><?= $task['deadline']?></td>
                <td><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

</div>

</body>
</html>



