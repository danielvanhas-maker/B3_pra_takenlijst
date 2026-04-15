<?php require_once __DIR__.'/../backend/conn.php'; ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../index.php?msg=$msg");
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
              AND $filterColumn = :value
              AND deadline IS NOT NULL
              ORDER BY deadline";
              
    $stmnt = $conn->prepare($query);
    $stmnt->execute([
        'status' => $status,
        'value' => $filterValue
    ]);

    $resultOne = $stmnt->fetchAll(PDO::FETCH_ASSOC);

  $query = "SELECT * FROM task 
              WHERE status = :status AND deadline IS NULL 
              AND $filterColumn = :value";
              
    $stmnt = $conn->prepare($query);
    $stmnt->execute([
        'status' => $status,
        'value' => $filterValue
    ]);
    
    $resultTwo = $stmnt->fetchAll(PDO::FETCH_ASSOC);
$result = array_merge($resultOne,$resultTwo);

    return $result;
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
                <td class="Actions"><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td class="Actions"><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<div class="taskContainer">
    <h2>In Review</h2>
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
                <td class="Actions"><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td class="Actions"><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
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
                <td class="Actions"><a href="edit.php?id=<?= $task['id']; ?>" class="edit">Edit</a></td>
                <td class="Actions"><a href="delete.php?id=<?= $task['id']; ?>" class="delete">Delete</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
</div>
</body>
</html>