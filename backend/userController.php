<?php
$action = $_POST['action'];
if ($action == 'create'){
    $name = $_POST['name'];
if(empty($name))
    {
        $errors[] = "Vul een Naam in";
    }

$userFunction = $_POST['function'];

$password = $_POST['password'];
if(empty($password))
    {
        $errors[] = "Vul een wachtwoord in";
    }
$hash = password_hash($password, PASSWORD_DEFAULT);

if(isset($errors)) 
{ 
var_dump($errors); 
die(); 
} 

require_once 'conn.php';

$query = "INSERT INTO user (name, userFunction, password)
            VALUE (:name, :userFunction, :password)";
$statement = $conn->prepare($query);
$statement->execute([":name" => $name, ":userFunction" => $userFunction, ":password" => $hash]);
header("Location: ../login.php");
}

if($action == "edit"){
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    require_once "conn.php"; 
    $query = "UPDATE user SET name = :name, password = :password WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":name" => $name, ":password" => $hash, ":id" => $id]);
    header("Location: ../user/read.php");
}

if ($action == 'delete'){
    $id = (int) $_POST['id'];

    require_once "conn.php";
    $query = "DELETE FROM user WHERE id = :id";
    $statement = $conn->prepare(($query));
    $statement->execute([":id" => $id]);
    header('Location: ../task/tasks.php');
}