<?php

require "db.php";

if(isset($_SESSION['user_id'])) 
	unset($_SESSION['user_id']);
if(isset($_SESSION['username'])) 
	unset($_SESSION['username']);
if(isset($_SESSION['user_role'])) 
	unset($_SESSION['user_role']);
if(isset($_SESSION['flash'])) 
	unset($_SESSION['flash']);

session_destroy();
	
$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: http://$server$uri/sign-in.php");

?>
