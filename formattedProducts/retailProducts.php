<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Retail Products</title>
	
	<style>

	.flex-container {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		align-items: center;
	}
	
		.productBlock	{			
			width:300px;
			height: 550px;
			background-color: aquamarine;
			border:thin solid black;
			margin: 5px;
		}
		
		.productImage img {
			display:block;
			margin-left:auto;
			margin-right:auto;
			width:280px;
			height:280px;				
		}
	
		.productName {
			text-align:center;
			font-size: large;
		}	
		
		.productDesc {
			margin-left:10px;
			margin-right:10px;
			text-align:justify;
		}
		
		.productPrice {
			text-align: center;
			font-size:larger;
			color:blue;
		}
		
		.productStatus {
			text-align:center;
			font-weight:bolder;
			color:darkslategray;
		}
		
		.productInventory {
			text-align:center;
		}
		
		.productLowInventory {
			color:red;
		}
		
	</style>
</head>

<body>
	
	<h1>DMACC Electronics Store!</h1>
	<h2>Products for your Home and School Office</h2>

	<?php

	try {
	  
	  require "dbConnect.php";	//CONNECT to the database

	  $sql = "SELECT * FROM wdv341_products ORDER BY product_name DESC"; //get all rows from the events table
	  
	  //PREPARE the SQL statement
	  $stmt = $conn->prepare($sql);
	  
	  //EXECUTE the prepared statement
	  $stmt->execute();		
	  
	  //Prepared statement result will deliver an associative array
	  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  }
  
  catch(PDOException $e)
  {
	  $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

	  error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
	  error_log($e->getLine());
	  error_log(var_dump(debug_backtrace()));					
  }

?>

	<div class="flex-container">

	<?php 
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ) {
		?>

	<?php

			if($row['product_status']) {
				$statusDisplayClass = "productStatus";
			}
			else {
				$statusDisplayClass = "";
			}

	?>

	<?php
			if($row['product_inStock'] < 10) {
				$displayClass = "productInventory productLowInventory";
		}
			else {
				$displayClass = "productInventory";
		}
	?>

		<!--EXAMPLE FORMAT-->
		<div class="productBlock">
			<div class="productImage">
				<image src="productImages/<?php echo $row['product_image']?>">
			</div>
			<p class="productName"><?php echo $row['product_name']?></p>	
			<p class="productDesc"><?php echo $row['product_description']?></p>
			<p class="productPrice"><?php echo $row['product_price']?></p>
			<p class="<?php echo $statusDisplayClass; ?>"><?php echo $row['product_status']; ?></p>
			<p class="<?php echo $displayClass; ?>"><?php echo $row['product_inStock']; ?> In Stock!</p>
		</div>



			<?php } ?> <!--END PHP LOOP-->



	</div> <!--close flex container-->
	
</body>
</html>