<?php
	@mysql_connect("localhost","root","") or die("Connection not available");
	@mysql_select_db("shopping") or die("Database Connection not available");
	
	//global $dblink;
	//@mysqli_connect("localhost","root","","shopping") or die("Connection I Connection not available");
	//@mysqli_select_db("shopping") or die("DB I Connection not available");
	
	session_start();
?>