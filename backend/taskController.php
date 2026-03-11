<?php

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

$taskFunction = $_POST['taskFunction'];

if(isset($errors)) 
{ 
var_dump($errors); 
die(); 
} 

echo $title . " /  " . $description . " / " . $taskFunction;

require_once 'conn.php';


$query = "INSERT INTO task (title, description, taskFunction)
            VALUE (:title, :description, :taskFunction)";

$statement = $conn->prepare($query);

$statement->execute([":title" => $title, ":description" => $description, ":taskFunction" => $taskFunction]);
