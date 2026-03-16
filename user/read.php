<?php
session_start();
if(!isset($_SESSION['user_id']))
    {
        $msg = "Je moet eerst inloggen";
        header("Location: login.php?msg=$msg");
        exit;
    }
?>  

