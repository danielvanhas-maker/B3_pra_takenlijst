<?php require_once __DIR__.'/../backend/conn.php'; ?>
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
        <h1>Aanpassen Account</h1>

        <?php
        $id = $_GET['id'];

        //Voer query uit
        require_once '../backend/conn.php';
        $query = "SELECT * FROM user WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute(['id' => $id]);
        $message = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

            <form action="../backend/userController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label for="name">Naam:</label>    
            <input type="text" name="name" value="<?php echo $message['name']; ?>"class="form-input">
            </div class="form-group">
            <div class="form-group">
                <label for="function">Functie:</label>
                <select name="function" id="function">
                    <option value="personeel">Personeel</option>
                    <option value="horeca">Horeca</option>
                    <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</option>
                </select>
            </div>
            <div class="form-group">
            <label for="passsword">Nieuw wachtwoord:</label>       
            <input type="password" name="password" value=""class="form-input">
            </div class="form-group">
            <div class="form-submit">
                <input type="submit" value="Pas Account aan" class="submit">
            </div class="form-submit">
    </div>  

</body>
</html>
