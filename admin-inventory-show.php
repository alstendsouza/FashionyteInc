<?php
require "db.php";

function throwInvalidCallException() {
  throw new Exception('Invalid Request Type');
}

$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
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

$item_id = $_GET["id"];


$query = "
SELECT A.id, A.name as Name, A.price as Price, B.name as Category, C.name as Brand
FROM shopping.Items as A,
	shopping.Categories as B,
	shopping.Brands as C
WHERE A.Categories_id = B.id
AND   A.Brands_id = C.id
AND   A.id = ".$item_id.";
";

/*$query = "SELECT category, title, source, target, description, submitter, id FROM incidents ORDER BY id;";*/

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
$resultHTML = "<table style='border: solid 1px; font-size:.8em; padding: 5px; border-collapse:collapse;'>";

$row = mysql_fetch_row($result);


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "layout-head.html" ?>
	</head>
	<body>
		<?php include "layout-header.php" ?>
		<div class="container">
			<div class="starter-template">
			<?php include "layout-flash.php" ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<p>
							<strong>Item Id:</strong>
							<?php echo $row[0] ?>
						</p>
						<p>
							<strong>Item Name:</strong>
							<?php echo $row[1] ?>
						</p>
						<p>
							<strong>Item Price:</strong>
							$ 
							<?php echo $row[2] ?>
						</p>
						<p>
							<strong>Item Category:</strong>
							<?php echo $row[3] ?>
						</p>
						<p>
							<strong>Item Brand:</strong>
							<?php echo $row[4] ?>
						</p>
						<p>
							<a href="admin-inventory-list.php">Back to List</a>
						</p>
						
					</div>
				</div>
			</div>
		</div>
		<?php include "layout-footer.html" ?>
	</body>
</html>