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
$sort =  "ASC";
if( isset($_GET['price']))
	if(($_GET['price'] == "ASC"  ) or ($_GET['price'] == "DESC"))
		$sort =  $_GET['price'];

$category =  "";
$category_id = -1;
if( isset($_GET['category'])){
	//if(($_GET['price'] == "ASC"  ) or ($_GET['price'] == "DESC"))
	if( $_GET['category'] < 0){
		
	}
	else{
		$category =  "AND A.Categories_id = {$_GET['category']}";
		$category_id = $_GET['category'];
	}
	
}

//$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
//mysql_select_db('shopping') or die('Could not select database');

$query = "
SELECT A.id, A.name as Name, A.price as Price, B.name as Categories, C.name as Brands, A.item_image
FROM shopping.Items as A,
	shopping.Categories as B,
	shopping.Brands as C
WHERE A.Categories_id = B.id
AND   A.Brands_id = C.id
{$category}
ORDER BY A.price {$sort};
;
";


/*$query = "SELECT category, title, source, target, description, submitter, id FROM incidents ORDER BY id;";*/

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');

$query = "
SELECT id, name
FROM shopping.Categories;

";

/*$query = "SELECT category, title, source, target, description, submitter, id FROM incidents ORDER BY id;";*/

$categories = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');

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
			<div class="col-md-12" style="border:0px solid red; text-align:right;float:right;margin-bottom:30px;">
			<form class="form-inline" role="form" id="filter" action='customer-inventory-list.php' method='GET'>
				<span style="margin-right:50px;">Price: <select name="price">
									<option value="ASC" <?php if($sort=="ASC") echo "selected"?> >Low to High</option>
									<option value="DESC" <?php if($sort=="DESC") echo "selected"?> >High to Low</option>
								</select>
								</span>
								
				Category
								<select name="category">
									<option value="-1" <?php if($category_id<0) echo "selected"?> >No Filter</option>
									<?php 
									while( $row = mysql_fetch_array($categories, MYSQL_NUM)) {
									?>
										<option value="<?php echo $row[0] ?>" <?php if($category_id==$row[0]) echo "selected"?> ><?php echo $row[1] ?></option>
									<?php 
									}
									?>
								</select>
			</form>
			</div>
			
			<?php 
				while( $row = mysql_fetch_array($result, MYSQL_NUM)) {
			?>
			<div class="col-md-4 col-sm-6">
			<div class="item-tabs" style="border:0px solid black;margin-top:5px;text-align:center;">
			
			<a href="<?php echo "customer-inventory-show.php?id={$row[0]}"; ?>"><?php echo "<img src='".$row[5]."' width = '320' height='330' style='border:1px solid #E5E7E5;border-radius:5px; margin:15px 0;'>" ; ?></a><br>
			<a href="<?php echo "customer-inventory-show.php?id={$row[0]}"; ?>"><?php echo $row[1]; ?><br>
			$<?php echo $row[2];?></a>
			<form class="form-inline" role="form" action='customer-cart-add.php' method='post' style="margin-top:10px">
					<input type='hidden' id='item_id' name='id' value='<?php echo $row[0]; ?>'>
					<button type='submit' class='btn btn-primary'>Add to Cart</button>
			</form>
			</div>
			</div>
			<?php } ?>

			</div>
		</div>
		<div style="margin-top:150px;">
		<?php include "layout-footer.html" ?>
		</div>
	</body>
</html>