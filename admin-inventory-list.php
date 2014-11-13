<?php

require 'db.php';
require "session-checks.php";

user_restricted();
admin_restricted();


$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

/*
if( isset($_SESSION['authenticated']) == false || $_SESSION['authenticated']!=true ) {
	header("Location: http://$server$uri/login.php");
	exit;
}
*/



//$dblink = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
//mysql_select_db('shopping') or die('Could not select database');

$query = "
SELECT A.id, A.name as Name, A.price as Price,A.gender as Gender, B.name as Categories, C.name as Brands, A.added_at as AddedAt
FROM shopping.Items as A,
	shopping.Categories as B,
	shopping.Brands as C
WHERE A.Categories_id = B.id
AND   A.Brands_id = C.id;
";

/*$query = "SELECT category, title, source, target, description, submitter, id FROM incidents ORDER BY id;";*/

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
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

							<th>ID</th>
							<th>Name</th>
							<th>Price</th>
							<th>Gender</th>
							<th>Category</th>
							<th>Added At</th>
							<th>Edit?</th>
							<th>Delete?</th>
						</tr>
					</thead>

					<tbody>
						<?php
						while( $row = mysql_fetch_array($result, MYSQL_BOTH)) {
						?>
						<tr>
							<td>
								<a href="admin-inventory-show.php?id=<?php echo $row[0]; ?>"><?php echo $row[0]; ?></a>
							</td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
							<td><?php echo $row[4];?></td>			
							<td><?php echo $row[6];?></td>
							<td><a href='admin-inventory-edit.php?id=<?php echo $row[0]; ?>'>Edit</a></td>
							<td>
								<form  class="form-inline" role="form" action='admin-inventory-delete.php' method='post'>
									<input type='hidden' id='delete_id' name='id' value='<?php echo $row[0]; ?>'>
									<button type='submit' class='btn btn-default'>Delete</button>
								</form>
							</td>
						</tr>
						<?php	
						}
						?>
					</tbody>
				</table>
				<p>
					<a href="admin-inventory-new.php">New Item</a>
				</p>
			</div>
		</div>
		<?php include "layout-footer.html" ?>
	</body>
</html>