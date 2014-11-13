<?php

require 'db.php';

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
/****************Getting the Item Object from************************/
$item_id = $_GET["id"];

//$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
//mysql_select_db('shopping') or die('Could not select database');

$query = "
SELECT A.id, A.name as Name,A.description , A.price as Price, A.categories_id, A.brands_id
FROM shopping.Items as A
WHERE A.id = ".$item_id.";
";

/*$query = "SELECT category, title, source, target, description, submitter, id FROM incidents ORDER BY id;";*/

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');

$item = mysql_fetch_row($result);

/****************Getting the categories************************/

$query = "
SELECT id,name FROM shopping.Categories;
";

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
$categories_options = "";

while( $row = mysql_fetch_array($result, MYSQL_NUM)) {
	$selected = "";
	if($row[0] == $item[4]){
		$selected = "selected";
	}
	$categories_options = $categories_options . "<option value='". $row[0] . "' $selected>". $row[1] . "</option>" ;
}
/****************Getting the brands************************/
$query = "
SELECT id,name FROM shopping.Brands;
";

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
$brands_options = "";

while( $row = mysql_fetch_array($result, MYSQL_NUM)) {
	$selected = "";
	if($row[0] == $item[5]){
		$selected = "selected";
	}
	$brands_options = $brands_options . "<option value='". $row[0] . "' $selected>". $row[1] . "</option>" ;
}



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
						<form action="admin-inventory-update.php" class="form-horizontal" method="post" role="form">
							<input id="edit_item_id" name="item[id]" type="hidden" value="<?php echo $item[0]; ?>">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="edit_item_name">Name</label>
								<div class="col-sm-10">
									<input class="form-control" id="edit_item_name" name="item[name]" placeholder="name" type="text" value="<?php echo $item[1]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="edit_item_description">Description</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="edit_item_description" name="item[description]"><?php echo $item[2]; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="edit_item_price">Price</label>
								<div class="col-sm-10">
									<input class="form-control" id="edit_item_price" name="item[price]" type="number" value="<?php echo $item[3]; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="edit_item_category_id">Category</label>
								<div class="col-sm-10">
									<select class="form-control" id="edit_item_category_id" name="item[categories_id]">
										<?php echo $categories_options; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="edit_item_gender">Gender</label>
								<div class="col-sm-10">
									<select class="form-control" id="edit_item_gender" name="item[gender]">
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="unisex">Unisex</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="edit_item_brand_id">Brand</label>
								<div class="col-sm-10">
									<select class="form-control" id="edit_item_brand_id" name="item[brands_id]">
										<?php echo $brands_options; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-default" type="submit">Update</button>
								</div>
							</div>
						</form>
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