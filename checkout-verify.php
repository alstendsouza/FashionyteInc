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

$card = $_POST['card'];
$items = cart_list();

$address = $_POST['address'];

if(verify_hotlist_number($card['number']))
{
$query_hotlist = "
INSERT INTO `shopping`.`Alerts`
(
`card_number`,
`ip_addr`,
`Customers_id`,
`description`
)
VALUES
(
'". $card['number'] . "',
'".$_SERVER['REMOTE_ADDR']."',
".$_SESSION['user_id'].",
'This is a hotlist card alert'
);
";
$result = mysql_query($query_hotlist) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
header("Location: creditdecline.php");

}


else if(isset($_SESSION['user_id']))
{
		
$query = "

INSERT INTO `shopping`.`Customeraddresses`
(
`line_1`,
`line_2`,
`city`,
`state`,
`zip`,
`type`,
`Customers_id`)
VALUES
(
'". $address['line_1'] . "',
'". $address['line_2'] ."',
'". $address['city']."',
'". $address['state']."',
". $address['zipcode'].",
'billing',
".$_SESSION['user_id'].");
";
		
$credit_query = 
"
INSERT INTO `shopping`.`Creditcards`
(
`number`,
`fname`,
`lname`,
`expiry`,
`Customers_id`)
VALUES
(
". $card['number'] . ",
'". $card['fname'] ."',
'". $card['lname']."',
'". $card['expiry']."',
".$_SESSION['user_id'].");
";
		$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
		
		$credit_result = mysql_query($credit_query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
		}
		else
		{
			header("Location: sign-in.php");
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
			
			
			
			
			<form action="tank-you.php" class="form-horizontal" method="post" role="form" >
			
			<div style="width:40%; border:2px solid black; float:left;">
			<table class='table table-bordered'>
					<thead>
						<tr> 
							<td>ID</td>
							<td>Name</td>
							<td>Quantity</td>
							
						</tr>
					</thead>
					<tbody>
					<?php 
					for($x=0;$x<count($items);$x++) {
					?>  

						<tr> 
							<td><?php echo $items[$x][0]; ?></td>
							<td><?php echo $items[$x][1]; ?></td>
							<td>
								<form class="form-inline" role="form" action='' method='post'>
									<!--<?php echo $items[$x][0]; ?> -->
									<?php echo $items[$x][2]; ?>
									
								</form>
							</td>
						
						</tr>
					<?php 
					} 
					?>
					</tbody>

				</table>
				</div>
				
				<div style="width:40%; border:2px solid black; text-align:center; ">
				<h3>Billing Address/ Shipping Address</h3>
				
				<label>Address line 1:</label> <?php echo $address['line_1']; ?><br>
				<label>Address line 2:</label> <?php echo $address['line_2']; ?><br>
				<label>City:</label> <?php echo $address['city']; ?> <br><label>State: </label> <?php echo $address['state']; ?>  <br> 	
				<label>ZipCode:</label> <?php echo $address['zipcode']; ?><br>

				
				
				
				</div>
				<br>
				<button class="btn btn-default" type="submit" />Confirm Payment</button>
			</form>
			</div>
		</div>
		<?php include "layout-footer.html" ?>
</body>
</html>