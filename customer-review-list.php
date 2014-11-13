<?php
//echo $item_id;require "db.php";

$query = "
SELECT A.message, A.rating, B.fname, B.lname 
FROM shopping.Reviews as A
JOIN shopping.Customers as B
ON A.customers_id = B.id
WHERE A.Items_id = ".$item_id.";
";

/*$query = "SELECT category, title, source, target, description, submitter, id FROM incidents ORDER BY id;";*/

$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');

?>
<div class="panel panel-default">
	<div class="panel-heading">
	All Reviews
	</div>
	<div class="panel-body">

<?php
while( $row = mysql_fetch_array($result, MYSQL_NUM)) { 
?>
		<div class="panel panel-default">
			<div class="panel-body">
			<p>Quality: <span class="reviews"><?php echo $row[1]; ?>/5</span></p>
			<p>Description: <span class="reviews"><?php echo $row[0]; ?></span></p>
			</div>
			<div class="panel-footer">
			<?php echo $row[2]; echo " "; echo $row[3]; ?>
			</div>
		</div>
<?php
}


?>

	</div>
</div>