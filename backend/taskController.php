<?php
$action = $_POST['action'];
if ($action == 'create'){
$title = $_POST['title'];
if(empty($title))
    {
        $errors[] = "Vul een titel in";
    }

$description = $_POST['description'];
if(empty($description))
    {
        $errors[] = "Vul een descriptie in";
    }

$department = $_POST['department'];

$testUserId = 1;

if(isset($errors)) 
{ 
var_dump($errors); 
die(); 
} 

header("Location: ../task/tasks.php");

require_once 'conn.php';


$query = "INSERT INTO task (title, description, department, userId)
            VALUE (:title, :description, :department, :userId)";

$statement = $conn->prepare($query);

$statement->execute([":title" => $title, ":description" => $description, ":department" => $department, ":userId" => $testUserId]);
}

if ($action == 'edit'){
    $id = (int) $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $department = $_POST['department'];
    $status = $_POST['status'];
    if(empty($title))
    {
        die("Vul een titel in");
    }

    require_once "conn.php"; 
    $query = "UPDATE task SET title = :title, description = :description, department = :department, status = :status WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":title" => $title, ":description" => $description, ":department" => $department, ":status" => $status, ":id" => $id]);
    header("Location: ../task/tasks.php");
}

if ($action == 'delete'){
    $id = (int) $_POST['id'];

    require_once "conn.php";
    $query = "DELETE FROM task WHERE id = :id";
    $statement = $conn->prepare(($query));
    $statement->execute([":id" => $id]);
    header("Location: ../task/tasks.php");
}