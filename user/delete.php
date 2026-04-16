<?php require_once __DIR__.'/../backend/conn.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Verwijderen Account</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
</head>
<body>
    <?php require_once '../header.php'; 

    $id = $_GET['id'];
    ?>

    <?php if ($id != $_SESSION['user_id'])
    {
        if (!isset($_SESSION['user_admin'])){
            header("Location: ../index.php");
        }
    }
    ?>

    <div class="container">
        <div class="form-submit"> 
            <h1>Weet je zeker dat je deze gebruiker wilt verwijderen?</h1>
        </div class="form-submit">
        <form action="<?php echo $base_url; ?>/backend/userController.php" method="POST">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-submit">
            <input type="submit" value="Verwijderen" class="submit">
        </div class="form-submit">
        </form>
    </div>
</body>
</html>