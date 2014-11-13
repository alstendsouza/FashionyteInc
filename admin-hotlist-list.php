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
SELECT `HotListCards`.`id`,
    `HotListCards`.`number`
FROM `shopping`.`HotListCards`;
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
							<th>Number</th>
							<th>Delete</th>
						<tr>
					</thead>

					<tbody>
						<?php 
						while( $row = mysql_fetch_array($result, MYSQL_NUM)) {

						?>


							<tr>
								<td><?php echo $row[1]; ?></td>
								<td>
									<form class="form-inline" role="form" action='admin-hotlist-delete.php' method='post'>
										<input type='hidden' id='delete_hotlist_id' name='hotlist[id]' value='<?php echo $row[0]; ?>'>
										<button type='submit' class='btn btn-default'>Delete</button>
									</form>
								</td>
							<tr>

						<?php 
						}

						?>
					</tbody>

				</table>
				<div class="panel panel-default">
					<div class="panel-heading">Add Card to HotList</div>
					<div class="panel-body">
						<form action="admin-hotlist-create.php" method="post" class="form-inline" role="form">
							<div class="form-group">
								<label class="control-label" for="new_item_name">Name</label>
								<input class="form-control" id="new_hotlist_number" name="hotlist[number]" type="number">
							</div>
							<div class="form-group">
								<button type='submit' class='btn btn-default'>Add</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
		<?php include "layout-footer.html" ?>
	</body>
</html>