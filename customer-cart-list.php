<?php

require "db.php";
require "functions.php";

$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

/*
if( isset($_SESSION['authenticated']) == false || $_SESSION['authenticated']!=true ) {
	header("Location: http://$server$uri/login.php");
	exit;
}
*/
$items = cart_list();

//var_dump($items);

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
				
				<table class='table table-bordered'>
					<thead>
						<tr> 
							<td>ID</td>
							<td>Name</td>
							<td>Quantity</td>
							<td>Price</td>
							<td>Remove?</td>
						</tr>
					</thead>
					<tbody>
					<?php 
					for($x=0;$x<count($items);$x++) {
					?>  

						<tr> 
							<td><a href="<?php echo "customer-inventory-show.php?id={$items[$x][0]}"; ?>"><?php echo $items[$x][0]; ?></a></td>
							<td><a href="<?php echo "customer-inventory-show.php?id={$items[$x][0]}"; ?>"><?php echo $items[$x][1]; ?></a></td>
							<td>
								<form class="form-inline" role="form" action='customer-cart-update.php' method='post'>
									<input type='hidden' id='edit_cart_pid' name='cart[pid]' value='<?php echo $items[$x][0]; ?>'>
									<input class="form-control" id="edit_cart_qty" name="cart[qty]" type="number" value="<?php echo $items[$x][2]; ?>">
									<button type='submit' class='btn btn-default'>Update</button>
								</form>
							</td>
							<td>$<?php echo $items[$x][3]; ?></td>
							<td>
								<form class="form-inline" role="form" action='customer-cart-delete.php' method='post'>
									<input type='hidden' id='delete_cart_pid' name='cart[pid]' value='<?php echo $items[$x][0]; ?>'>
									<button type='submit' class='btn btn-default'>Delete</button>
								</form>
							</td>
						</tr>
					<?php 
					} 
					?>
						<tr> 
							<td></td>
							<td></td>
							<td>Total</td>
							<td>$<?php echo cart_total(); ?></td>
							<td></td>
						</tr>
					</tbody>

				</table>
				
				<a href="customer-checkout.php" class='btn btn-default'>Checkout</a>
			</div>
		</div>
		<?php include "layout-footer.html" ?>
	</body>
</html>