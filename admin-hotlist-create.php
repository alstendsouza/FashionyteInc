<?php

require 'db.php';

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

$hotlist = $_POST['hotlist'];


//$dblink = mysqli_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());

$query = "
INSERT INTO `shopping`.`HotListCards`
(
`number`)
VALUES
(
{$hotlist['number']});
";

//mysqli_query($dblink, $query);

if (!mysql_query($query)) {
  die('Error: ' . mysql_error());
}

header("Location: http://$server$uri/admin-hotlist-list.php");
?>
