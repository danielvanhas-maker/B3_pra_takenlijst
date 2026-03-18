<?php
session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen";
        header("Location: login.php?msg=$msg");
        exit;
    }
?>  

<?php require_once __DIR__.'/../backend/conn.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/task.css">
    <title>Account Inzien</title>
</head>

<body>
    <?php require_once '../header.php'; ?>
    <?php require_once '../backend/conn.php';
    $id = $_SESSION['user_id'];
    $query = "SELECT * FROM user WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="center">
        <div class="name">
                <?php echo $user['name']?>
        </div class="name">    
        <div class="choice">    
                <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a>
        </div class="choice">        
        
    </div>
</div>
</body>
</html> 
