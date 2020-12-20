<?php

session_start();

if ($_SESSION['validUser'] !== "yes") {
    header("Location: ../home.html");
}

    try {

        require 'dbConnect.php';

        $sql = "SELECT `id`, `product_name`, `product_description`, `product_img` FROM `portfolio_project` WHERE 1";

        $stmt = $conn->prepare($sql);
        
        $stmt->execute();	
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

    }

    catch(PDOException $e) {

	  $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

	  error_log($e->getMessage());
	  error_log($e->getLine());
      error_log(var_dump(debug_backtrace()));
       
      header('Location: ../errorFile/505_error_response_page.php');	//sends control to a User friendly page
      					
  }

?>


<!DOCTYPE html>
<html>
<head>
	<title>Edit Products</title>

	<!--Author: Justina Geddes
	Date: December 15th 2020-->

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="about johnsons clothing store">
	<meta name="keywords" content="clothes, johnson's clothing, store, cheap prices'">

  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	
<link rel="stylesheet" type="text/css" href="css/jcClothing">
	
	<style>
		.form {
  			border-radius: 5px;
  			background-color: #f2f2f2;
  			padding: 75px;
  			border: black solid 5px;
			}
		.foot a {
			color:white;
			}
	</style>

</head>
<body>

<div class="container">
	<div class="jumbotron text-center"  style="margin-bottom:0; color:white; background-color:navy;">
	 	<h1>Johnson's Clothing Store</h1>
	</div>
	
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="home.html"> 
  		<img src="../images/FClogo.gif" alt="logo" style="width:40px;">
  </a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar"> 
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../home.html">Johnson's Clothing Store</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../login.php">Admin Page</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addProducts.php">Add Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="editProducts.php">Update/Delete Product</a>
      </li>
    </ul>
  </div> 
</nav>  


<!-- List of Products -->
 <div class="product-container">
        
    <h1 style="text-align:center; padding:25px;">Update or delete a product</h1>
    <div class="display-main">
        <?php
            while ( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="displayBlock">
                <div class="row">
                    <span class="productImg"><img src="../images/<?php echo $row['product_img']?>"></span>
                </div><!-- close row -->
                
                <div class="row">
                    <span class="productName"><?php echo $row['product_name']?></span>
                </div><!-- close row -->

                <div class="row">
                    <span class="productDesc"><?php echo $row['product_description']?></span>
                </div><!-- close row -->

                <div class="updateDelete">
                    <?php $product_id = $row['product_id']; ?>
                    <a href="updateProduct.php?productId=<?php echo $product_id; ?>"><button>Update Product</button></a>
                    <a href="deleteProduct.php?productId=<?php echo $product_id; ?>"><button>Delete Product</button></a>
                </div> <!-- close update delete -->
        </div><!-- close display block -->

        <?php } ?>
    
    </div><!-- close display main -->
 </div> <!-- close product container -->



<!-- Footer -->
<div class="jumbotron text-center" style="margin-bottom:0; background-color:Navy">
  		
  		<footer>	
  			<div class="row">
    			<div class="col-lg-4 col-md-6">
      				<img src="images/FClogo.gif" alt="logo" style="width:125px;">
      			</div>
    		
    			<div class="col-lg-4 col-md-6" style="color:white;">
      				<h3>900 S Ada St,</h3>
      				<h3>Chicago, IL </h3>
      				<h3>60607</h3>
      			</div>
    
    			<div class="col-lg-4 col-md-6" style="color:white" >
      				<p class="foot" style="margin-top: 50px; color:white; background-color:navy;">
						<a href="#" class="fa fa-pinterest"></a>
						<a href="#" class="fa fa-instagram"></a>
						<a href="#" class="fa fa-facebook"></a>
						<a href="#" class="fa fa-twitter"></a>
					</p>
      			</div>

			</div><!--close div class row-->
		</footer><!-- close footer -->	
		
<div class="col-sm-12" style="margin-top: 20px; color:white; background-color:Navy; display: flex; justify-content: space-between;">
<p class="foot">
Johnson's Clothing Store <span>©Copyright 2020. All rights reserved.</span></p>
</div>

</div><!-- end of div with footer -->

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>