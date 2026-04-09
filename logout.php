<?php 
require_once __DIR__.'/backend/config.php';
session_start();
session_destroy();
header("Location: $base_url/task/tasks.php");
exit;
