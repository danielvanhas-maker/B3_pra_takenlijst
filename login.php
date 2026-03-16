<?php require_once __DIR__.'/backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <link rel="stylesheet" href="css/main.css">
    <title>Inloggen</title>
</head>

<body>
    <?php require_once 'header.php'; ?>

<div class="container">
        <h1>Log In</h1>

        <form action="<?php echo $base_url; ?>backend/loginController.php" method="POST">

            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" class="form-input">
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" class="form-input">
            </div>   

            <input type="submit" value="Inloggen">

        </form>
    </div>