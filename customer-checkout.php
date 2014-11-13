<?php
require "db.php";
require "functions.php";
require "session-checks.php";

user_restricted();

$flash = null;
if(isset($_SESSION['flash']))
{
	$flash = $_SESSION['flash'];
	unset($_SESSION['flash']);

}

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
?>

<!DOCTYPE html>
<html>

<head>
<?php include "layout-head.html" ?>
</head>

<body>


		<?php include "layout-header.php" ?>
		<div class="container">
			<div class="starter-template">
				<p>
				<?php echo $flash; ?>
				</p>
				<form action="checkout-verify.php" class="form-horizontal" method="post" role="form" id="loginForm">
				
				<div style="float:left; width:50%; margin: 0 0 0 -30px">
							<div class="form-group">
							<h3>Billing Address/Shipping Address</h3>
								<label class="col-sm-2 control-label" for="address1">Address 1</label>
								<div class="col-sm-10">
									<input class="form-control" id="address1" name="address[line_1]" placeholder="" type="text">
								</div>
							</div>
							
							<div class="form-group">
							<label class="col-sm-2 control-label" for="address2">Address 2</label>
								<div class="col-sm-10">
									<input class="form-control" id="address2" name="address[line_2]" placeholder="" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="city">City</label>
								<div class="col-sm-10">
									<input class="form-control" id="city" name="address[city]" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="state">State</label>
								<div class="col-sm-10">
									<input class="form-control" id="state" name="address[state]" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="zipcode">Zip Code</label>
								<div class="col-sm-10">
									<input class="form-control" id="zipcode" name="address[zipcode]" type="number">
								</div>
							</div>
							
				</div>
				
				
				
				<div style="float:right; width:50%; margin: 0 0 0 -20px">
							<div class="form-group">
							<h3>Credit Card Information</h3>
								<label class="col-sm-2 control-label" for="number">Card Number</label>
								<div class="col-sm-10">
									<input class="form-control" id="number" name="card[number]" placeholder="" type="number">
								</div>
							</div>
							
							<div class="form-group">
							<label class="col-sm-2 control-label" for="fname">First Name</label>
								<div class="col-sm-10">
									<input class="form-control" id="fname" name="card[fname]" placeholder="" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="lname">Last Name</label>
								<div class="col-sm-10">
									<input class="form-control" id="lname" name="card[lname]" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="expiry">Expiry</label>
								<div class="col-sm-10">
									<input class="form-control" id="expiry" name="card[expiry]" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="cvv">CVV</label>
								<div class="col-sm-10">
									<input class="form-control" id="cvv" name="card[cvv]" type="number">
								</div>
							</div>
							
				</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-default" type="submit" />Proceed</button>
								</div>
							</div>
				</form>
			</div>
		</div>
		<?php include "layout-footer.html" ?>
</body>
</html>