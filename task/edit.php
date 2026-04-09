<?php require_once __DIR__.'/../backend/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php?msg=Je moet eerst inloggen');
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst / Aanpassen</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
</head>

<body>

    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Aanpassen taak</h1>

        <?php
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        require_once '../backend/conn.php';
        $query = "SELECT * FROM task WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([
            'id' => $id]);
        $message = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$message) {
            header('Location: ../task/tasks.php?error=Taak niet gevonden');
            exit;
        }
        $isOwner = $message['userId'] === $_SESSION['user_id'];
        ?>


            <form action="<?php echo $base_url; ?>/backend/taskController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label for="title">Title van taak:</label>    
            <input type="text" name="title" value="<?php echo htmlspecialchars($message['title']); ?>" class="form-input" <?php echo $isOwner ? '' : 'readonly'; ?>>
            </div>
            <div class="form-group">
            <label for="description">Beschrijving:</label>    
            <input type="text" name="description" value="<?php echo htmlspecialchars($message['description']); ?>" class="form-input" <?php echo $isOwner ? '' : 'readonly'; ?> >
            </div>  
            <div class="form-group">  
            <label for="department">Afdeling:</label>
                <select name="department" id="department" <?php echo $isOwner ? '' : 'disabled'; ?> >
                    <option value="personeel" <?php if ($message['department'] === 'personeel') echo 'selected'; ?>>Personeel</option>
                    <option value="horeca" <?php if ($message['department'] === 'horeca') echo 'selected'; ?>>Horeca</option>
                    <option value="techniek" <?php if ($message['department'] === 'techniek') echo 'selected'; ?>>Techniek</option>
                    <option value="inkoop" <?php if ($message['department'] === 'inkoop') echo 'selected'; ?>>Inkoop</option>
                    <option value="klantenservice" <?php if ($message['department'] === 'klantenservice') echo 'selected'; ?>>Klantenservice</option>
                    <option value="groen" <?php if ($message['department'] === 'groen') echo 'selected'; ?>>Groen</option>
                </select>
                <?php if (!$isOwner): ?>
                    <input type="hidden" name="department" value="<?php echo htmlspecialchars($message['department']); ?>">
                <?php endif; ?>
            </div>  
            <div class="form-group">
            <label for="status">Status</label>      
            <select name="status" id="status">
                    <option value="Not Done" <?php if ($message['status'] === 'Not Done') echo 'selected'; ?>>Not Done</option>
                    <option value="In Review" <?php if ($message['status'] === 'In Review') echo 'selected'; ?>>In Review</option>
                    <option value="Done" <?php if ($message['status'] === 'Done') echo 'selected'; ?>>Done</option>
                </select>
            </div>  
            <div class="form-submit">
                <input type="submit" value="Pas melding aan" class="submit">
            </div class="form-submit">
        </form>
 
    </div>  

</body>
</html>
