<?php require_once __DIR__.'/../backend/conn.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst / Verwijderen</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
</head>
<body>
    <?php require_once '../header.php'; 

    $id = $_GET['id'];
    ?>

    <h1>Weet je zeker dat je uw account wilt verwijderen?</h1>
    <form action="<?php echo $base_url; ?>/backend/taskController.php" method="POST">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" value="Verwijderen">
    </form>
</body>
</html>