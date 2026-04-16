<?php require_once __DIR__.'/../backend/conn.php'; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php?msg=Je moet eerst inloggen');
    exit;
}

$query = "SELECT userFunction FROM user WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$department = $user['userFunction'];
?>

<!doctype html>
<html lang="nl">

<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
    <title>Task Create</title>
</head>

<body>
    <?php require_once '../header.php'; ?>

<div class="container">
        <h1>Nieuwe Taak</h1>

        <form action="<?php echo $base_url; ?>/backend/taskController.php" method="POST">
        <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="title">Title van taak:</label>
                <input type="text" name="title" id="title" class="form-input">
            </div>

            <div class="form-group">
                <label for="description">Beschrijving:</label>
                <input type="text" name="description" id="description" class="form-input">
            </div>

            <div>
                <input type="text" value="<?= htmlspecialchars($department) ?>" readonly>
                <input type="hidden" name="department" value="<?= htmlspecialchars($department) ?>">
            </div>

            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type=date name="deadline" id="deadline" class="form-input">
            </div>

            <div class="form-submit">
                <input type="submit" value="Maak nieuwe taak aan" class="submit">
            </div class="form-submit">
        </form>
    </div>

</body>

</html>