<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst / Verwijderen</title>
</head>
<body>
    <?php require_once '../header.php'; ?>

    <h1>Weet je zeker dat je [titel] wilt verwijderen?</h1>
    <form action="../backend/taskController.php" method="POST">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" value="Verwijderen">
    </form>
</body>
</html>