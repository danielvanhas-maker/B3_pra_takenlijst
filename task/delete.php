<?php require_once __DIR__.'/../backend/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php?msg=Je moet eerst inloggen');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
require_once '../backend/conn.php';
$query = 'SELECT * FROM task WHERE id = :id AND userId = :userId';
$statement = $conn->prepare($query);
$statement->execute([
    'id' => $id,
    'userId' => $_SESSION['user_id'],
]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    $msgDelete = "Geen toegang om te verwijderen";
    header("Location: ../task/tasks.php?msg=$msgDelete");
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst / Verwijderen</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
</head>
<body>
    <?php require_once '../header.php'; ?>

    <div class="container">
    <div class="form-submit"> 
        <h1>Weet je zeker dat je deze taak wilt verwijderen?</h1>
    </div class="form-submit">
    <form action="<?php echo $base_url; ?>/backend/taskController.php" method="POST">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-submit">
        <input type="submit" value="Verwijderen" class="submit">
    </div class="form-submit">
    </form>
</div>
</body>
</html>