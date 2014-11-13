<?php
require "db.php";
require "functions.php";

function throwInvalidCallException() {
  throw new Exception('Invalid Request Type');
}

$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$method = $_SERVER['REQUEST_METHOD'];

// echo $server;
//echo $uri;

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


$items = cart_list();
$query = "

INSERT INTO `shopping`.`Orders`
(
`Customers_id`
)
VALUES
(
".$_SESSION['user_id'].");
";

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
$order_id = mysql_insert_id();



for($x=0;$x<count($items);$x++)
{
$query = "

INSERT INTO `shopping`.`Transactions`
(
`quantity`,
`Items_id`,
`Orders_id`
)
VALUES
(
{$items[$x][2]},
{$items[$x][0]},
{$order_id}
);
";

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
}

?>

<!DOCTYPE html>
<html>

<head>
<?php include "layout-head.html" ?>
</head>

<body>


		<?php include "layout-header.php" ?>
		<br>
		<div class="container">
			<div class="starter-template">
			
		<h3> Thank you!! Your order has been placed... <a href="index.php">Continue Shopping</a> </h3>
		
			</div>
		</div>
		<?php include "layout-footer.html" ?>
</body>
</html>