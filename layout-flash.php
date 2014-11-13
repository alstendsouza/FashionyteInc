<p>
<?php 
$flash = null;
if(isset($_SESSION['flash']))
{
	$flash = $_SESSION['flash'];
	unset($_SESSION['flash']);

}
echo $flash; 
?>
</p>