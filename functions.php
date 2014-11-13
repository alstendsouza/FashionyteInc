<?php

	function get_product_details($pid){
	
		$query = "
			SELECT A.id, A.name as Name, A.price as Price, B.name as Categories, C.name as Brands
			FROM shopping.Items as A,
				shopping.Categories as B,
				shopping.Brands as C
			WHERE A.Categories_id = B.id
			AND   A.Brands_id = C.id
			AND   A.id = {$pid};
			";
		$result = mysql_query($query) or die("Connection not available");
		return mysql_fetch_array($result, MYSQL_BOTH);
	}


	function cart_total(){

		$items = cart_list();
		$sum = 0.0;
		for($x=0;$x<count($items);$x++) {
			$sum += $items[$x][3];
		}
		
		return $sum;
	}
	
	function cart_list(){
		$result = array();
		if(isset($_SESSION['user_id'])){
			$user_id = $_SESSION['user_id'];
			$query = "
			SELECT id,quantity as qty,items_id as pid
			FROM shopping.Cart
			WHERE customers_id = {$user_id}
			;";
			
			$qresult = mysql_query($query) or die("Connection not available, Select DB Failed");
			
			while( $row =  mysql_fetch_array($qresult, MYSQL_BOTH) )
			{
				$pid = $row['pid'];
				$qty = $row['qty'];
				$pdetails = get_product_details($pid);
				$result[] = array($pdetails[0], $pdetails[1], $qty, $qty*$pdetails[2] );
			}
		}
		else{
			if(isset($_SESSION['cart']) and  is_array($_SESSION['cart'])){
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid = $_SESSION['cart'][$i]['productid'];
					$qty = $_SESSION['cart'][$i]['qty'];
					$pdetails = get_product_details($pid);
					$result[] = array($pdetails[0], $pdetails[1], $qty, $qty*$pdetails[2]);
				}
			}
		}
		return $result;
	}
	
	function cart_add($pid, $q=0){
		if(isset($_SESSION['user_id'])){
			
			$user_id = $_SESSION['user_id'];
			
			$query = "
			SELECT id,quantity as qty,items_id as pid
			FROM shopping.Cart
			WHERE customers_id = {$user_id}
			AND items_id = {$pid}
			;";
			
			$result = mysql_query($query) or die("Connection not available, Select DB Failed");
			if($row =  mysql_fetch_array($result, MYSQL_BOTH)){
				
				if($q > 0){ 
					//Nothing doing
					//$q = $row['qty'] + $q;
				}
				else{
					$q = $row['qty'] + 1;
				}
				
				$query = "
				UPDATE `shopping`.`Cart`
				SET
				`quantity` = {$q}
				WHERE `id` = {$row['id']};
				";
				
				var_dump($query);
				
				$result = mysql_query($query) or die("Connection not available, Update DB Failed");
				
				
			}
			else{
			
				if($q > 0){ 
					//Nothing doing
					//$q = $row['qty'] + $q;
				}
				else{
					$q = 1;
				}
				
				$query = "
				INSERT INTO `shopping`.`Cart`
				(
				`quantity`,
				`Customers_id`,
				`Items_id`)
				VALUES
				(
				{$q},
				{$user_id},
				{$pid});
				";
				
				$result = mysql_query($query) or die("Connection not available, Insert DB Failed");
			}
		}
		else{
			
			if(isset($_SESSION['cart']) and  is_array($_SESSION['cart'])){
				$existing_id = product_exists($pid);
				echo var_dump(product_exists($pid));
				if($existing_id > -1){ 
					if($q > 0){ 
						$_SESSION['cart'][$existing_id]['qty']= $q;
					}
					else{
						$_SESSION['cart'][$existing_id]['qty']+= 1;
					}
					
				}
				else{
					$max=count($_SESSION['cart']);
					$_SESSION['cart'][$max]['productid']=$pid;
					
					if($q > 0){ 
						$_SESSION['cart'][$max]['qty']=$q;
					}
					else{
						$_SESSION['cart'][$max]['qty']=1;
					}
					
				}
			}
			else{
				$_SESSION['cart']=array();
				$_SESSION['cart'][0]['productid']=$pid;
				if($q > 0){ 
					$_SESSION['cart'][0]['qty']=$q;
				}
				else{
					$_SESSION['cart'][0]['qty']=1;
				}
			}
		
		}
	}
	
	function cart_remove($pid){
		if(isset($_SESSION['user_id'])){
		
			$user_id = $_SESSION['user_id'];
			
			$query = "
			DELETE FROM `shopping`.`Cart`
			WHERE `customers_id` = {$user_id}
			AND `items_id` = {$pid};
			";
			
			//var_dump($query);
			
			$result = mysql_query($query) or die("Connection not available, Update DB Failed");
	
		
		}
		else{
			
			$pid=intval($pid);
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
				if($pid==$_SESSION['cart'][$i]['productid']){
					unset($_SESSION['cart'][$i]);
					break;
				}
			}
			$_SESSION['cart']=array_values($_SESSION['cart']);
		
		}
	}
	
	function cart_count(){
		if(isset($_SESSION['user_id'])){
			$user_id = $_SESSION['user_id'];
			
			$query = "
			SELECT count(*)
			FROM shopping.Cart
			WHERE customers_id = {$user_id}
			;";
			
			$result = mysql_query($query) or die("Connection not available, Select query Failed");
			if($row =  mysql_fetch_array($result)){
				return $row[0];
			}
			return 0;
		}
		else{
			if(isset($_SESSION['cart']))
			{
				$max=count($_SESSION['cart']);
				/*
				$sum=0;
				for($i=0;$i<$max;$i++){
					$sum += $_SESSION['cart'][$i]['qty']
				}
				*/
			}
			else
				$max = 0;
		}
		return $max;
	}
	
	
	function product_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=-1;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=$i;
				break;
			}
		}
		return $flag;
	}
	
	// Call this function ONLY after signing in. Pass the cart array 
	function cart_migrate($cart){
		$max=count($cart);
		for($i=0;$i<$max;$i++){
			$pid = $cart[$i]['productid'];
			$qty = $cart[$i]['qty'];
			$pdetails = get_product_details($pid);
			//$result[] = array($pdetails[0], $pdetails[1], $qty);
			cart_add($pid, $qty);
		}
	}
	
	// Call this function ONLY after signing in. Pass the cart array 
	function verify_hotlist_number($number){

		$query = "
		SELECT `HotListCards`.`id`,
			`HotListCards`.`number`
		FROM `shopping`.`HotListCards`
		WHERE `HotListCards`.`number` = {$number};
		";

		$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');
	
		if(mysql_num_rows($result) > 0){
			return true;
		}
		return false;
	}
	
	// Call this function ONLY after signing in. Pass the cart array 
	function register_event($card_number ){
		if(isset($_SESSION['user_id']))
			$user_id = $_SESSION['user_id'];
		else
			$user_id = null;
		
		$ip_addr = $_SERVER['REMOTE_ADDR'];
		$description = "Credit card on hot list detected and stopped.";
		
		$query = "
		INSERT INTO `shopping`.`Alerts`
		(
		`card_number`,
		`ip_addr`,
		`Customers_id`,
		`description`)
		VALUES
		(
		{$card_number},
		{$ip_addr},
		{$user_id},
		{$description});
		";

		$result = mysql_query($query) or die('Submit Failed.  Return to <a href="main.php">Main</a>.  ');

		return true;
	}
	
	


?>


