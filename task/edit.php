<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst / Aanpassen</title>
</head>

<body>

    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Aanpassen taak</h1>

        <?php
        $id = $_GET['id'];

        //Voer query uit
        require_once '../backend/conn.php';
        $query = "SELECT * FROM task WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute(['id' => $id]);
        $message = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        <!-- Formulier voor edit: -->
            <form action="../backend/taskController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="title" value="<?php echo $message['title']; ?>">
            <textarea name="description"><?php echo $message['description']; ?></textarea>
            <input type="text" name="department" value="<?php echo $message['department']; ?>">
            <input type="text" name="status" value="<?php echo $message['status']; ?>">
            <input type="submit" value="Verstuur melding">
        </form>
    </div>  

</body>
</html>
