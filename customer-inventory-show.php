<?php

require "db.php";
require "functions.php";


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


$item_id = $_GET["id"];


$query = "
SELECT A.id, A.name as Name, A.price as Price,A.gender as Type, A.color as Color, A.item_image as Image, A.description as Description, B.name as Category, C.name as Brand
FROM shopping.Items as A,
	shopping.Categories as B,
	shopping.Brands as C
WHERE A.Categories_id = B.id
AND   A.Brands_id = C.id
AND   A.id = ".$item_id.";
";



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
					<div class="panel-heading">
						Fashionyte / <?php echo $row[3] ?> / <?php echo $row[7]?> 
					</div>
					<div class="panel-body">
					<div class="col-md-5">
						<?php echo "<img src='".$row[5]."' width = '380' height='400' style='border:1px solid #E5E7E5;border-radius:3px; margin-left:-15px;'>" ?>
					</div>
						
					<div class="col-md-5 item-desc">
						<p class="item-head"><?php echo $row[1] ?></p>
						<p class="item-head">$ <?php echo $row[2] ?></p>
						<p>Color: <?php echo $row[4] ?></p>
						<?php if(($row[7]==="Casual Shirts") || ($row[7]==="Pants") || ($row[7]==="Formal Shirts") || ($row[7]==="Dresses") ) { ?>
						<p>Select Size: <select>
											<option value="small">S</option>
											<option value="medium">M</option>
											<option value="large">L</option>
											<option value="extra-large">XL</option>
										</select>
							<a href="#" style="margin-left:30px; font-size:0.8em;">Size Chart</a>
						</p>
						<?php } elseif(($row[7]==="Shoes")){ ?>
						<p>Select Size: <select>
											
											<option value="7">7</option>
											<option value="7.5">7.5</option>
											<option value="8">8</option>
											<option value="8.5">8.5</option>
											<option value="9">9</option>
											<option value="9.5">9.5</option>
											<option value="10">10</option>
											<option value="10.5">10.5</option>
											<option value="11">11</option>
											<option value="11.5">11.5</option>
											<option value="12">12</option>
											<option value="12.5">12.5</option>
										</select>
							<a href="#" style="margin-left:30px; font-size:0.8em;">Size Chart</a>
						</p>
						<?php } ?>
						
						<p>Quantity &nbsp &nbsp:  <input type="number" name="qty" id="qty" style="width:47px;" value='1'></p>
						<p>Description: <span class="desc"> <?php echo $row[6] ?></span></p>
						<p style="margin-top:25px;">
							<form action='customer-cart-add.php' method='post' style="display:inline;">
								<input type='hidden' id='item_id' name='id' value='<?php echo $row[0] ?>'>
								<button type='submit' class='btn btn-primary'>Add to Cart</button>
								
							</form>
							<a href="customer-inventory-list.php"><button class='btn btn-default' style="margin-left:10px;">Continue Shopping</button></a>
						</p>
						
					</div>
					
						
					</div>
				</div>
				<?php if(isset($_SESSION['user_id'])){  ?>
				<?php include "customer-review-new.php" ?>
				<?php } ?>
				<?php include "customer-review-list.php" ?>
			</div>
		</div>
		
		<?php include "layout-footer.html" ?>
	</body>
</html>