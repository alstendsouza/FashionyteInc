<?php

require "db.php";

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

$item = $_POST['item'];

//$dblink = mysqli_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());

$query = "
INSERT INTO `shopping`.`Customers`
(
`username`,
`fname`,
`lname`,
`email`,
`password`
)
VALUES
(
'". $item['username'] . "',
'". $item['fname'] ."',
'". $item['lname']."',
'". $item['email']."',
'". $item['password']."')
;
";
echo $query;
//mysqli_query($dblink, $query);

if (!mysql_query( $query)) {
  die('Error: ' . mysql_error());
}


$_SESSION['flash']="Successful registered. Please sign in";
header("Location: http://$server$uri/sign-in.php");
?>