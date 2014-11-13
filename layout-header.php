
<div class="container navbar navbar-fixed" style = "margin-top:20px;">
			<div class="row">
				<!------------------------------------------------------------------------------>
                <!-- logo -->
				<div class="col-md-8 col-sm-5">
						<a href="index.php"><img src = "img/2700211.png"  width="180" alt="Fashionyte"/></a>
						<span class="glyphicon glyphicon-tags"></span>
                </div>
				<!------------------------------------------------------------------------------>
			
				
				
				<div class="col-md-4 left-inner-addon" style="float:right; margin-top: 5px;">
					<span class="glyphicon glyphicon-search"></span>
					<input class="form-control" id="new_search" name="new_search" placeholder="Search for a product" type="text">
					<!-- <button class="btn btn-default" type="button" style="margin-left:5px; color:#7F7F7F;">Search</button>-->
                </div>
			</div>
			
			
			<div class="row">
                
	
				
				<!------------------------------------------------------------------------------>
                <!-- menu bar -->
				
                <div class="col-md-8"  id="menu_bar"> 
					 
					<ul class="nav nav-pills" style="margin-top: 20px; ">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="customer-inventory-list.php">Men</a></li>
                        <li><a href="customer-inventory-list.php">Women</a></li>
						<li><a href="customer-inventory-list.php">Kids</a></li>
						<li><a href="customer-inventory-list.php">Accessories</a></li>
						<?php if(!isset($_SESSION['user_id'])){ ?>
						<li><a href="customer-cart-list.php" class="menu_items"><span class="glyphicon glyphicon-shopping-cart" id="cart"></span> (<?php echo cart_count(); ?>)</a></li>
						<?php } ?>
                    </ul>
					
                </div>
				
				<!------------------------------------------------------------------------------>
                <!-- register and login-->
				<div class="col-md-4" style="float:right"> 
					
					<ul class="nav nav-pills" style="margin-top: 20px;">
                        
						<?php if(!isset($_SESSION['user_id'])){ ?>
                        
						<li><a href="sign-up.php" class="menu_items"><span class="glyphicon glyphicon-user"></span> Register</a></li> <!-- register-->
						<li><a href="#" class="menu_items" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> <!-- login-->
						
						<?php } else { ?>
						<?php if($_SESSION['user_role'] != "customer"){ ?>
				
						<li><a href="admin-inventory-list.php">Inventory</a></li>
						<li><a href="admin-hotlist-list.php">HotList</a></li>
				
						<?php } else { ?>
			
						<li><a href="customer-cart-list.php"><span class="glyphicon glyphicon-shopping-cart" id="cart"></span> (<?php echo cart_count(); ?>)</a></li>
				
						<?php } ?>
				
				
						<li><a href="session-destroy.php"><?php echo $_SESSION['user_fname']; ?>, Logout</a></li>
				
						<?php } ?>
                    </ul>
                </div>   
                
            </div>
		</div>
		
		<!-------------------------------------------------------------------------------------------------------------------------->
		<!-- Login Modal -->
		<form action="session-create.php" class="form-horizontal" method="post" role="form">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel" style="text-align:center">Login</h4>
				</div>
			
				<div class="modal-body">
						
						<label class="col-sm-2 control-label" for="new_username">Username</label>
						<div class="col-sm-10">
						<input class="form-control" id="new_username" name="username" placeholder="abc@example.com" type="text">
						</div>
					<br><br><br>
							
					
						<label class="col-sm-2 control-label" for="new_password">Password</label>
						<div class="col-sm-10">
							<input class="form-control" id="new_password" name="password" placeholder="********" type="password">
						</div>
						<br><br><br>
						<div style="text-align:center">
							<input type="submit" class="btn btn-primary" value="Login" style="padding:5px 20px 5px 20px"; />
						</div>
				
				
				</div>
				
				<div class="modal-footer">
					<div class="col-sm-6">
					<a href="sign-up.php">New Customer? Start here</a>
					</div>
					<div class="col-sm-6" style="text-align:left">
					<a href="#">Forgot Password ?</a>
					</div>
					
				</div>
			</div>
			</div>
		</div>
		</form>
	