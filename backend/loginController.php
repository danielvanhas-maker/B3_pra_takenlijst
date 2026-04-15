<?php
require_once 'config.php';
session_start();

$inputName = $_POST['name'];
if(empty($inputName))
    {
        $errors[] = "Vul een Naam in";
    }

$inputPassword = $_POST['password'];
if(empty($inputPassword))
    {
        $errors[] = "Vul een wachtwoord in";
    }

if(isset($errors)) 
{ 
var_dump($errors); 
die(); 
} 

require_once 'conn.php';

$query = "SELECT id, name, password, userFunction, isAdmin FROM user WHERE name = :name";

$statement = $conn->prepare($query);

$statement->execute([":name" => $inputName]);

$user = $statement->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($inputPassword, $user['password']))
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_department'] = $user['userFunction'];
        if (($user['isAdmin']) == "1")
        {
        $_SESSION['user_admin'] = "true";
        }
        header("Location: $base_url/task/tasks.php");
        exit;
    }
else
    {
        $errormsg = "Ongeldige naam of wachtwoord!";
        header("Location: ../index.php?msg=$errormsg");
    }

