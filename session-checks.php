<?php

function user_restricted() {
	if(!isset($_SESSION['user_id'])){
		$_SESSION['flash'] = "User not logged in!";
		header("location: sign-in.php"); // Redirecting To Other Page
	}
}

function admin_restricted() {
	if(!isset($_SESSION['user_id']) or !isset($_SESSION['user_role']) or $_SESSION['user_role'] != "admin" ){
		$_SESSION['flash'] = "User not an Administrator!";
		header("location: sign-in.php"); // Redirecting To Other Page
	}
}

function customer_restricted() {
	if(!isset($_SESSION['user_id']) or !isset($_SESSION['user_role']) or $_SESSION['user_role'] != "customer" ){
		$_SESSION['flash'] = "User not an Customer!";
		header("location: sign-in.php"); // Redirecting To Other Page
	}
}




?>