<?php require_once __DIR__.'/../backend/conn.php'; ?>
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
            <div class="form-submit">
                <input type="submit" value="Maak nieuw taak aan" class="submit">
            </div class="form-submit">
        </form>
    </div>

</body>

</html>