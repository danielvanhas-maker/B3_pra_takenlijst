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

$query = "SELECT id, name, password FROM user WHERE name = :name";

$statement = $conn->prepare($query);

$statement->execute([":name" => $inputName]);

$user = $statement->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($inputPassword, $user['password']))
    {
        $_SESSION['user_id'] = $user['id'];
        header("Location: $base_url/task/tasks.php");
        exit;
    }
else
    {
        echo "Ongeldige naam of wachtwoord.";
    }

