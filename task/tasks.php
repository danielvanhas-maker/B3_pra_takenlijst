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


$view = $_GET['view'] ?? 'department';

if ($view === 'personal') {
    $filterColumn = 'userId';
    $filterValue = $_SESSION['user_id'];
} else {
    $filterColumn = 'department';
    $filterValue = $_SESSION['user_department'];
}

function fetchTasks($conn, $status, $filterColumn, $filterValue) {
    $query = "SELECT * FROM task 
              WHERE status = :status 
              AND $filterColumn = :value";

    $stmt = $conn->prepare($query);
    $stmt->execute([
        'status' => $status,
        'value' => $filterValue
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$tasksNotDone = fetchTasks($conn, 'Not Done', $filterColumn, $filterValue);
$tasksInReview = fetchTasks($conn, 'In Review', $filterColumn, $filterValue);
$tasksDone = fetchTasks($conn, 'Done', $filterColumn, $filterValue);
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

<div class="center-link">
    <a href="tasks.php?view=department">Sector taken</a> |
    <a href="tasks.php?view=personal">Persoonlijke taken</a>
</div>

<?php
if (isset($_GET['msg'])) {
    echo "<div class='msg'>" . htmlspecialchars($_GET['msg']) . "</div>";
}
?>

<div class="row">

<div class="taskContainer">
    <h2>Not Done Tasks</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Department</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php foreach ($tasksNotDone as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= htmlspecialchars($task['department']) ?></td>
                <td>Not Done</td>
                <td><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class="taskContainer">
    <h2>Tasks In Review</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Department</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php foreach ($tasksInReview as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= htmlspecialchars($task['department']) ?></td>
                <td>In Review</td>
                <td><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class="taskContainer">
    <h2>Done Tasks</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Department</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php foreach ($tasksDone as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= htmlspecialchars($task['department']) ?></td>
                <td>Done</td>
                <td><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

</div>

</body>
</html>