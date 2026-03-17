<?php require_once __DIR__.'/../backend/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <link rel="stylesheet" href="../css/main.css">
    <title>Tasks</title>
</head>

<body>

    <?php require_once '../header.php'; ?>
    <?php require_once '../backend/conn.php';
    $query = "SELECT * FROM task";
    $statement = $conn->prepare($query);
    $statement->execute();
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container home">
        <table>
            <th>Title</th>
            <th>Description</th>
            <th>Department</th>
            <th>Status</th>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo $task['title']?></td>
                    <td><?php echo $task['description']?></td>
                    <td><?php echo $task['department']?></td>
                    <td><?php echo $task['status']?></td>
                    <td><a href="edit.php?id=<?php echo $task['id']; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $task['id']; ?>">Delete</a></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>

</body>
</html> 