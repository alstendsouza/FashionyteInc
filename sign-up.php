<?php
require "db.php";
require "functions.php";

?>

<!DOCTYPE html>
<html>

<head>
<?php include "layout-head.html" ?>
</head>

<body>

		<?php include "layout-header.php" ?>
			<div class="container register_box" style="width:70%; margin-top:50px;">
				<div class="starter-template">
					<?php include "layout-flash.php" ?>
						<form action="customer-create.php" class="form-horizontal" method="post" id="sign-up" role="form" style="margin:40px">
							
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="fname" style="text-align:left;">First Name:</label>
								<div class="col-sm-4">
									<span data-alertid="example"><input class="form-control" id="fname" name="item[fname]" placeholder="Your First Name" type="text" style="text-align:left;"></span>
								</div>
								
								<label class="col-sm-2 control-label" for="lname" style="text-align:left;">Last Name:</label>
								<div class="col-sm-4">
									<input class="form-control" id="lname" name="item[lname]" placeholder="Your Last Name" type="text">
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="new_username" style="text-align:left;">Username:</label>
								<div class="col-sm-10">
									<input class="form-control" id="new_username" name="item[username]" placeholder="abc@example.com" type="text">
								</div>
							</div>
							
						
							<div class="form-group">
								<label class="col-sm-2 control-label" for="new_password" style="text-align:left;">Password:</label>
								<div class="col-sm-10">
									<input class="form-control" id="new_password" name="item[password]" placeholder="**********" type="password">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="new_password" style="text-align:left;">Confirm Password:</label>
								<div class="col-sm-10">
									<input class="form-control" id="new_password_confirmation" name="item[password_confirmation]" placeholder="**********" type="password">
								</div>
							</div>
				
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-primary" type="submit" style="margin: 10px 0 0 250px;" />Register</button>
									
								</div>
							</div>
							
				</form>
			</div>
		</div>
		
		<?php include "layout-footer.html" ?>
		
		
</body>
</html>