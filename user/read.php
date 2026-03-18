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
    <title>Tasks</title>
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

    <div class="container home">
        <table>
            <th>Name</th>
                <td><?php echo $user['name']?></td>
                <td><a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a></td>
                <td><a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a></td>
        </table>
    </div>

</body>
</html> 
