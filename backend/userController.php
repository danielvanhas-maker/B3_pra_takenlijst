<?php

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

if(isset($errors)) 
{ 
var_dump($errors); 
die(); 
} 

echo $name . " /  " . $userFunction . " / " . $password;

require_once 'conn.php';


$query = "INSERT INTO user (name, userFunction, password)
            VALUE (:name, :userFunction, :password)";

$statement = $conn->prepare($query);

$statement->execute([":name" => $name, ":userFunction" => $userFunction, ":password" => $password]);
