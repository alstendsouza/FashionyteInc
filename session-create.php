<?php

require 'db.php';
require 'functions.php';

function throwInvalidCallException() {
  throw new Exception('Invalid Request Type');
}

$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'POST':
	continue;
	break;
  /*case 'PUT':
	throwInvalidCallException()
	break;
  case 'POST':
	throwInvalidCallException()
	break;
  case 'HEAD':
	throwInvalidCallException()
	break;
  case 'DELETE':
	throwInvalidCallException()
	break;
  case 'OPTIONS':
	throwInvalidCallException()
	break;
	*/
  default:
	throwInvalidCallException();
	break;
}


if (empty($_POST['username']) || empty($_POST['password'])) {
$_SESSION["flash"] = 'Username or Password is invalid';
header("location: sign-in.php"); // Redirecting To Other Page
$error = "Username or Password is invalid";
}
else
{
	// Define $username and $password
	$username=$_POST['username'];
	$password=$_POST['password'];

	// To protect MySQL injection for Security purpose
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);

	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	//$connection = mysql_connect("localhost", "root", "");

	// Selecting Database
	//$db = mysql_select_db("shopping", $connection);

	// SQL query to fetch information of registerd users and finds user match.
	$query = mysql_query("select * from Users where password='$password' AND username='$username'") or die(mysql_error());
	
	$rows = mysql_num_rows($query);
	
	if ($rows === 1) 
	{
		$userrow = mysql_fetch_assoc($query);

		$userid = $userrow['id'];
		$userrole = $userrow['role'];
		$user_fname = $userrow['fname'];
		
		$_SESSION['username']=$username; // Initializing Session
		$_SESSION['user_id']=$userid;
		$_SESSION['user_role']=$userrole;
		$_SESSION['user_fname']=$user_fname;
		
		unset( $_SESSION['cart']);
		
		header("location: admin-inventory-list.php"); // Redirecting To Other Page
	} else
	{
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("select * from Customers where password='$password' AND username='$username'") or die(mysql_error());
		
		$rows = mysql_num_rows($query);
		
		if ($rows == 1) 
		{
			$userrow = mysql_fetch_assoc($query);

			$userid = $userrow['id'];
			$user_fname = $userrow['fname'];
			
			$_SESSION['username']=$username; // Initializing Session
			$_SESSION['user_id']=$userid;
			$_SESSION['user_role']="customer";
			$_SESSION['user_fname']=$user_fname;
			if(isset($_SESSION['cart']) and  is_array($_SESSION['cart'])){
				$_SESSION['flash'] = "Going to Migrate";
				cart_migrate($_SESSION['cart']);
			}
			unset( $_SESSION['cart']);
			
			header("location: customer-inventory-list.php"); // Redirecting To Other Page
		} else {
				$_SESSION['flash'] = "Username or Password is invalid";
				header("location: sign-in.php"); // Redirecting To Other Page
		
		}
		
	}

}

?>