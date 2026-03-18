<?php require_once __DIR__.'/../backend/config.php'; ?>
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
        $id = $_GET['id'];

        //Voer query uit
        require_once '../backend/conn.php';
        $query = "SELECT * FROM task WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute(['id' => $id]);
        $message = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        
            <form action="<?php echo $base_url; ?>/backend/taskController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label for="title">Title van taak:</label>    
            <input type="text" name="title" value="<?php echo $message['title']; ?>"class="form-input">
            </div>
            <div class="form-group">
            <label for="description">Beschrijving:</label>    
            <input type="text" name="description" value="<?php echo $message['description']; ?>"class="form-input">
            </div>  
            <div class="form-group">  
            <label for="department">Afdeling:</label>
                <select name="department" id="department">
                    <option value="personeel">Personeel</option>
                    <option value="horeca">Horeca</option>
                    <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</option>
                </select>
            </div>  
            <div class="form-group">
            <label for="status">Status</label>      
            <select name="status" id="status">
                    <option value="Not Done">Not Done</option>
                    <option value="In Review">In Review</option>
                    <option value="Done">Done</option>
                </select>
            </div>  
            <div class="form-submit">
                <input type="submit" value="Pas melding aan" class="submit">
            </div class="form-submit">
        </form>
 
    </div>  

</body>
</html>
