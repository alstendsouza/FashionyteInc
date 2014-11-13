<?php

require 'db.php';
require 'functions.php';

?>

<!DOCTYPE html>
<html>

<head>
<?php include "layout-head.html" ?>
</head>

<body>

		<?php include "layout-header.php" ?>
		<div class="container register_box" style="width:40%; margin-top:50px;">
			<div class="starter-template">
				<?php include "layout-flash.php" ?>
				<form action="session-create.php" class="form-horizontal" method="post" role="form">
				
				
							<div class="form-group">
								<label class="col-sm-2 control-label" for="new_username">Username</label>
								<div class="col-sm-10">
									<input class="form-control" id="new_username" name="username" placeholder="abc@example.com" type="text">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="new_password">Password</label>
								<div class="col-sm-10">
									<input class="form-control" id="new_password" name="password" placeholder="********" type="password">
								</div>
							</div>
				
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-default" type="submit" style="margin:10px 0 0 120px;">Sign In</button>
								</div>
							</div>
				</form>
			</div>
		</div>
		<div class="navbar-fixed-bottom">
		<?php include "layout-footer.html" ?>
		</div>
</body>
</html>