<?php require_once __DIR__.'/backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Task Create</title>
</head>

<body>
    <?php require_once 'header.php'; ?>

<div class="container">
        <h1>Nieuwe Taak</h1>

        <form action="<?php echo $base_url; ?>backend/taskController.php" method="POST">

            <div class="form-group">
                <label for="title">Title van taak:</label>
                <input type="text" name="title" id="title" class="form-input">
            </div>

            <div class="form-group">
                <label for="description">Beschrijving:</label>
                <input type="text" name="description" id="description" class="form-input">
            </div>

            <div class="form-group">
                <label for="taskFunction">Taak functie:</label>
                <select name="taskFunction" id="taskFunction">
                    <option value="Filler1">1</option>
                    <option value="Filler2">Filler2</option>
                    <option value="Filler3">Filler3</option>
                    <option value="Filler4">Filler4</option>
                    <option value="Filler5">Filler5</option>
                    <option value="Filler6">Filler6</option>
                </select>
            </div>
            
            
           

            <input type="submit" value="Maak nieuw taak aan">

        </form>
    </div>

</body>

</html>