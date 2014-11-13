<?php

require "db.php";
require 'functions.php';

function throwInvalidCallException() {
  throw new Exception('Invalid Request Type');
}

$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$method = $_SERVER['REQUEST_METHOD'];

echo $server;
echo $uri;

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



/*
if( isset($_SESSION['authenticated']) == false || $_SESSION['authenticated']!=true ) {
	header("Location: http://$server$uri/login.php");
	exit;
}
*/

$item = $_POST['cart'];

cart_remove($item['pid']);

header("Location: http://$server$uri/customer-cart-list.php");
?>
