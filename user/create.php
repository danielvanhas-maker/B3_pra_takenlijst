<?php require_once __DIR__.'/../backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>User Create</title>
</head>

<body>
    <?php require_once '../header.php'; ?>

<div class="container">
        <h1>Nieuwe User</h1>

        <form action="<?php echo $base_url; ?>../backend/userController.php" method="POST">

            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" class="form-input">
            </div>
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
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" class="form-input">
            </div>
            

            <input type="submit" value="Maak nieuwe account aan">

        </form>
    </div>

</body>

</html>