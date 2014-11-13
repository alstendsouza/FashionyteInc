<?php
require "db.php";

require "session-checks.php";

user_restricted();

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

$review = $_POST['review'];



$query = "
INSERT INTO `shopping`.`Reviews`
(
`message`,
`rating`,
`customers_id`,
`items_id`)
VALUES
(
'{$review['comments']}',
{$review['quality']},
{$_SESSION['user_id']},
{$review['item_id']});
";
echo $query;
//mysqli_query($dblink, $query);

if (!mysql_query( $query)) {
  die('Error: ' . mysql_error());
}

header("Location: http://$server$uri/customer-inventory-show.php?id={$review['item_id']}");
?>
