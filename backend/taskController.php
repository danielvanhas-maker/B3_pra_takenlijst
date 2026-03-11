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

echo $title . " /  " . $description . " / " . $department;

require_once 'conn.php';


$query = "INSERT INTO task (title, description, department, userId)
            VALUE (:title, :description, :department, :userId)";

$statement = $conn->prepare($query);

$statement->execute([":title" => $title, ":description" => $description, ":department" => $department, ":userId" => $testUserId]);
}

if ($action == 'edit'){
    
}
