<?php
require "db.php";
require "functions.php";

$server = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <?php include "layout-head.html" ?>
    </head>
	
	<body>
		<?php include "layout-header.php" ?>
		
		<div class= "container" style="margin-top:20px;">
            <div id="carousel-example-generic" class="carousel slide wrapper" data-ride="carousel" data-interval="30000">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					
					<div class="item active">
						<img src="img/sumsale.png" alt="Sale image">
					</div>
					
					
					<div class="item">
						<img src="img/funk.jpg" alt="funky guys">
      
					</div>
				
					
					
					<div class="item">
						<img src="img/img1.png" alt="GAP collection">
      
					</div>
					
					
				
					
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
        </div>    

		<!---------------------------------------------------------------------------------------------------->
		
		
		<div class="container" style="margin-top:100px;">

			<!-- Three columns of text below the carousel -->
			<div class="row">
				<div class="col-lg-4" style="text-align:center;">
					<img class="img-rounded" src="img/mens.jpg" alt="Mens Wear" style="width: 350px; height: 350px; border:2px solid black; margin:0 auto;">
					<h2>Mens Wear</h2>
					<p>Shop for Men's Clothing online at Fashionyte to find the latest designer brands & fashion trends.</p>
					<p><a class="btn btn-default" href="#" role="button">Shop Mens &raquo;</a></p>
				</div><!-- /.col-lg-4 -->
        
			<div class="col-lg-4" style="text-align:center;">
				<img class="img-rounded" src="img/womens.jpg" alt="Generic placeholder image" style="width: 350px; height: 350px; border:2px solid black; margin:0 auto;">
				<h2>Womens Wear</h2>
				<p>Shop for Women's Clothing online at Fashionyte to find the latest designer brands & fashion trends.</p>
				<p><a class="btn btn-default" href="#" role="button">Shop Womens &raquo;</a></p>
			</div><!-- /.col-lg-4 -->
        
			<div class="col-lg-4" style="text-align:center;">
				<img class="img-rounded" src="img/kids.jpg" alt="Generic placeholder image" style="width: 350px; height: 350px; border:2px solid black; margin:0 auto;">
				<h2>Kids Wear</h2>
				<p>Shop for Kid's Clothing online at Fashionyte to find the latest designer brands & fashion trends.</p>
				<p><a class="btn btn-default" href="#" role="button">Shop Kids &raquo;</a></p>
			</div><!-- /.col-lg-4 -->
			</div><!-- /.row -->
		</div>
		
		<!----------------------------------------------------------------------------------->
		<div class ="container" style= "margin-top:100px;">
		<hr class="featurette-divider">

			<div class="row featurette" style="margin-top:150px; margin-bottom:50px;">
				<div class="col-md-7" style="margin-top:100px;">
				<h2 class="featurette-heading">Nike AirMax 360 - <span class="text-muted">Cool as Air</span></h2>
				<p class="lead" style="margin-top:30px;">The Nike Air Max 360 Men's Sneaker is made with rugged materials and reflective elements to help you stay warm, dry and visible in harsh winter weather.   <a class="btn btn-primary" href="customer-inventory-show.php?id=1" role="button">Shop Now &raquo;</a> </p>
				
			</div>
			<div class="col-md-5">
				<img class="featurette-image img-responsive" img src="img/nikesneakers.png" alt="Generic placeholder image" width="500" height="500">
			</div>
			</div>

      <hr class="featurette-divider" style= "margin-top:100px;">

			<div class="row featurette" style="margin-top:150px; margin-bottom:50px;">
				<div class="col-md-5">
				<img class="featurette-image img-responsive" img src="img/hugoboss.png" alt="Generic placeholder image" width="500" height="500">
				</div>
				<div class="col-md-7" style="margin-top:100px;">
				<h2 class="featurette-heading">Hugo Boss - <span class="text-muted">A Class Apart</span></h2>
				<p class="lead" style="margin-top:30px;"> Fruity and citrus top notes of apple, lemon and plum balance with a floral and spicy heart dominated by geranium, and are offset by warming base notes of sandalwood, vetiver and cedarwood.   <a class="btn btn-primary" href="customer-inventory-show.php?id=3" role="button">Shop Now &raquo;</a> </p>
			</div>
			
			</div>

      <hr class="featurette-divider">
			
			<div class="row featurette" style="margin-top:150px; margin-bottom:50px;">
				<div class="col-md-7" style="margin-top:100px;">
				<h2 class="featurette-heading">Fossil Chronograph - <span class="text-muted">In Time</span></h2>
				<p class="lead" style="margin-top:30px;">A top-of-the-hour essential that's certain to be at the top of his list. Townsman takes its cues from retro design with up-to-the-minute innovation.    <a class="btn btn-primary" href="customer-inventory-show.php?id=2" role="button">Shop Now &raquo;</a> </p>
			</div>
			<div class="col-md-5">
				<img class="featurette-image img-responsive" img src="img/watchy.png" alt="Generic placeholder image" width="500" height="500">
			</div>
			</div>
			
		<hr class="featurette-divider">
	
      <!-- /END THE FEATURETTES -->
	</div>
        

	
		<!----------------------------------------------------------------------------------->	
		<div class="container navbar-bottom" style="margin-top:20px;">
	
			<footer>
				<?php include "layout-footer.html"?>
			</footer>
		</div>
		
            
	</body>
</html>