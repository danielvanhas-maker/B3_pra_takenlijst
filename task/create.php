<?php require_once __DIR__.'/../backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Task Create</title>
</head>

<body>
    <?php require_once '../header.php'; ?>

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
            
            
           

            <input type="submit" value="Maak nieuw taak aan">

        </form>
    </div>

</body>

</html>