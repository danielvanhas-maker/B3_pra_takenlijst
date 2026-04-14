<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php?msg=Je moet eerst inloggen');
    exit;
}

$action = $_POST['action'];
$userId = $_SESSION['user_id'];

if ($action == 'create') {
    $title = trim($_POST['title']);
    if (empty($title)) {
        $errors[] = 'Vul een titel in';
    }

    $description = trim($_POST['description']);
    if (empty($description)) {
        $errors[] = 'Vul een descriptie in';
    }

    $department = $_POST['department'];

    

    $deadline = $_POST['deadline'];

if (isset($errors)) {
        var_dump($errors);
        die();
    }    

require_once 'conn.php';

if (isset($deadline)) {
     $query = 'INSERT INTO task (title, description, department, userId) VALUES (:title, :description, :department, :userId)';
    $statement = $conn->prepare($query);
    $statement->execute([
        ':title' => $title,
        ':description' => $description,
        ':department' => $department,
        ':userId' => $userId,
    ]);
    header('Location: ../task/tasks.php');
    exit;
}    

else {

    $query = 'INSERT INTO task (title, description, department, deadline, userId) VALUES (:title, :description, :department, :deadline, :userId)';
    $statement = $conn->prepare($query);
    $statement->execute([
        ':title' => $title,
        ':description' => $description,
        ':department' => $department,
        ':deadline' => $deadline,
        ':userId' => $userId,
    ]);

    header('Location: ../task/tasks.php');
    exit;
}
}
if ($action == 'edit') {
    $id = (int) $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $department = $_POST['department'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline'];

    require_once 'conn.php';
    $query = 'SELECT userId FROM task WHERE id = :id';
    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id]);
    $task = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$task) {
        header('Location: ../task/tasks.php?error=Taak niet gevonden');
        exit;
    }

    $isOwner = $task['userId'] == $userId;

    if ($isOwner && empty($title)) {
        die('Vul een titel in');
    }

    if ($isOwner) {
        if (isset($deadline)) {
            $query = 'UPDATE task SET title = :title, description = :description, department = :department, status = :status WHERE id = :id AND userId = :userId';
            $statement = $conn->prepare($query);
            $statement->execute([
                ':title' => $title,
                ':description' => $description,
                ':department' => $department,
                ':status' => $status,
                ':id' => $id,
                ':userId' => $userId,
            ]);
            header('Location: ../task/tasks.php');
            exit;
        }    

        else {

            $query = 'UPDATE task SET title = :title, description = :description, department = :department, status = :status, deadline = :deadline WHERE id = :id AND userId = :userId';
            $statement = $conn->prepare($query);
            $statement->execute([
                ':title' => $title,
                ':description' => $description,
                ':department' => $department,
                ':status' => $status,
                ':deadline' => $deadline,
                ':id' => $id,
                ':userId' => $userId,
            ]);

            header('Location: ../task/tasks.php');
            exit;
            }

    } 
    
    else {
        $query = 'UPDATE task SET status = :status WHERE id = :id';
        $params = [
            ':status' => $status,
            ':id' => $id,
        ];
    }

    $statement = $conn->prepare($query);
    $statement->execute($params);
    header('Location: ../task/tasks.php');
    exit;
}

if ($action == 'delete') {
    $id = (int) $_POST['id'];

    require_once 'conn.php';
    $query = 'DELETE FROM task WHERE id = :id AND userId = :userId';
    $statement = $conn->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':userId' => $userId,
    ]);
    header('Location: ../task/tasks.php');
    exit;
}