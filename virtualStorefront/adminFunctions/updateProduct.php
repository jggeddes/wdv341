<?php

session_start();

    if ($_SESSION['validUser'] !== "yes") {
        header("Location: ../home.html");
    }

    $product_name = "";
    $product_description = "";
    $product_price = "";
    $product_in_stock = "";
    $product_img = "";

    $product_name_err = "";
    $product_description_err = "";
    $product_price_err = "";
    $product_stock_err = "";
    $product_img_err = "";

    $validForm = false;

    $updateProductId = $_GET['productId'];

    if (isset($_POST['submit'])) {

    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_in_stock = $_POST['product_in_stock'];
    $product_img = $_FILES['product_img']['name'];


    if ( $_POST['product_style'] != "1") {
        die("Form could not be submitted");
        }

    //VALIDATION FUNCTIONS

    function validateName($inValue) {
        global $validForm, $product_name_err;
        $product_name_err = "";

        if ($inValue == "") {
            $validForm = false;
            $product_name_err = "Please fill in product name";
        }
    }


    function validateDescription($inValue) {
        global $validForm, $product_description_err;
        $product_description_err = "";

        if ($inValue == "") {
            $validForm = false;
            $product_description_err = "Please enter a product description";
        }
    }

    function validatePrice($inValue) {
        global $validForm, $product_price_err;
        $product_price_err = "";

        if ($inValue == "") {
            $validForm = false;
            $product_price_err = "Please enter a product price";
        }
    }

    function validateStock($inValue) {
        global $validForm, $product_stock_err;
        $product_stock_err = "";

        if ($inValue == "") {
            $validForm = false;
            $product_stock_err = "Please enter a product stock";
        }
    }

    function validateImg($inValue) {
        global $validForm, $product_img_err;
        $$product_img_err = "";

        if ($inValue == "") {
            $validForm = false;
            $product_img_err = "Please select a product image";
        }
    }


    $validForm = true;

    validateName($product_name);
    validateDescription($product_description);
    validatePrice($product_price);
    validateStock($product_in_stock);
    validateImg($product_img);

    if ($validForm) {

        try {

            require "dbConnect.php";

            $sql = "UPDATE portfolio_project SET ";
            $sql .= "product_name = '$product_name', ";
            $sql .= "product_description = '$product_description', ";
            $sql .= "product_price = '$product_price', ";
            $sql .= "product_in_stock = '$product_in_stock', ";
            $sql .= "product_img = '$product_img', ";
            $sql .= "WHERE product_id = '$updateProductId'";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

        }
        
        catch(PDOException $e)  {

            $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
      
            error_log($e->getMessage());
            error_log($e->getLine());
            error_log(var_dump(debug_backtrace()));
          
              header('Location: ../errorFile/505_error_response_page.php');				
        }

    } else {
        $message = "The product could not be updated";
    }

} //end if submit

    else {

        try {

            require "dbConnect.php";

            $sql = "SELECT `id`, `product_name`, `product_description`, `product_price`, `product_in_stock`, `product_img` FROM `portfolio_project` WHERE 1";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $product_name = $row['product_name'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_in_stock = $row['product_in_stock'];
            $product_img = $row['product_img'];
        }

        catch(PDOException $e) {
            $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
      
            error_log($e->getMessage());
            error_log($e->getLine());
            error_log(var_dump(debug_backtrace()));
          
              header('Location: ../errorFile/505_error_response_page.php');
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>

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
        <a class="nav-link" href="addProducts.php">Add Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="editProducts.php">Update/Delete Product</a>
      </li>
    </ul>
  </div> 
</nav>  

<div class="heading">

        <h1>Update a product</h1>
        
        <?php 

        if($validForm) {

        ?>

        <h1>Your product has has been updated</h1>

        <?php 

        } else {

        ?>
        
</div>

<div class="inputContainer">

    <form action="<?php echo $_SERVER['PHP_SELF'] . "?productId=$updateProductId"; ?>" method="POST" class="inputEvent" enctype="multipart/form-data">

        <p class="inputField">
            <label for="product_name">Product Name: </label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product_name?>"><span class="errorMsg"><?php echo $product_name_err?></span>
        </p>
        
        <p class="inputField">
            <label for="product_description">Product Description: </label>
            <textarea id="product_description" name="product_description"><?php echo $product_description?></textarea><span class="errorMsg"><?php echo $product_description_err?></span>
        </p>

        <!--HONEY POT FIELD-->
        <p class="inputField">
            <label style="display: none;" for="product_style">Product Style: </label>
            <input type="text" id="product_style" name="product_style" style="display: none" autocomplete="off" value="1">
        </p>
        <!--END HONEYPOT FIELD-->

        <p class="inputField">
            <label for="product_price">Product Price: </label>
            <input type="number" step="0.01" id="product_price" name="product_price" value="<?php echo $product_price?>"><span class="errorMsg"><?php echo $product_price_err?></span>
        </p>

        <p class="inputField">
            <label for="product_in_stock">Product Stock: </label>
            <input type="number" id="product_in_stock" name="product_in_stock" value="<?php echo $product_in_stock?>"><span class="errorMsg"><?php echo $product_stock_err?></span>
        </p>

        <p class="inputField">
            <label for="product_img">Product Image: </label>
            <input type="file" id="product_img" name="product_img"><span class="errorMsg"><?php echo $product_img_err?></span> 
        </p>

        <input type="submit" name="submit" id="submit">
        <input type="reset" id="reset" name="reset">

    </form>
</div>

    <?php 
    
    } 
    
    ?>


<!-- Footer -->
<div class="jumbotron text-center" style="margin-bottom:0; background-color:Navy">
  		
  		<footer>	
  			<div class="row">
    			<div class="col-lg-4 col-md-6">
      				<img src="../images/FClogo.gif" alt="logo" style="width:125px;">
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
		</footer>	
		
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
