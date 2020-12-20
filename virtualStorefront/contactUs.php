<!DOCTYPE html>
<html>
<head>
	<title>Johnson's Clothing Store</title>

	<!--Author: Justina Geddes
	Date: December 8th 2020-->

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="contact johnsons clothing store">
	<meta name="keywords" content="clothes, johnson's clothing, store, cheap prices, contact">

  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	
<link rel="stylesheet" type="text/css" href="css/jcClothing">
	
<?php
	$userName = "";
	$userEmail = "";	 
	$userMessage = "";
	$emailErrMsg = "";
	$firstNameErrMsg = "";	

	$validForm = false;
				
	if(isset($_POST["button"]))
	{	
	
	$userName = $_POST['floatName'];
	$userEmail = $_POST['floatEmail'];
	$userMessage = $_POST['floatMessage'];
	function validateEmail($inEmail)
			{
				global $validForm, $emailErrMsg;			//Use the GLOBAL Version of these variables instead of making them local
				$emailErrMsg = "";							//Clear the error message. 
				
				// Remove all illegal characters from email
				$inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);

				// Validate e-mail
				$inEmail = filter_var($inEmail, FILTER_VALIDATE_EMAIL);

				if($inEmail === false)
				{
					$validForm = false;
					$emailErrMsg = "Invalid email"; 					
				}
			}//end validateEmail()
			
			function validateFirstName($inName)
			{
				global $validForm, $firstNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
				$firstNameErrMsg = "";
				
				if($inName == "")
				{
					$validForm = false;
					$firstNameErrMsg = "Name cannot be spaces";
				}
				else {
				if (strlen($inName) > 200)
					{
					$validForm = false;
					$firstNameErrMsg = "Name cannot be more than 200 characters."; 
					}
				}
			}//end validateName()
		$validForm = true;	
		validateFirstName($userName);
		validateEmail($userEmail);
		
		if($validForm)
		{
		$to = "jgeddes12.wolf@gmail.com";
		$subject = "Email from my website";
		$body = "Information Submitted by ".$userName.".\n\n".$userMessage;
		
		$headers = "From: contact@justinageddes.com";
		
		mail($to, $subject, $body, $headers);
            $message = "Thank You. Your message has been sent.";
        	} 	
	
		else 
		{
			$message = "Something went wrong";
		}//ends check for valid form		

	}
	else
	{
		//Form has not been seen by the user.  display the form
	}// ends if submit 
?>
	
	
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
  		<img src="images/FClogo.gif" alt="logo" style="width:40px;">
  </a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="home.html">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.html">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="products.html">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contactUs.php">Contact Us</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li> 
    </ul>
  </div> 
</nav>  


<div class="form" >
  <h2 style="text-align:center;">CONTACT US</h2>
  <br>
  <h4 style="text-align:center;">Phone: 123-456-7890</h4>
  <h4 style="text-align:center;">Email: service@jcclothing.net</h4>
	      

</div>
    
    <img src="images/map.png" class="img-fluid" alt="Map" style="border:black solid 3px; width: 100% \9;">

 <div class="form" style="text-align:center; padding:20px;">
               	<?php
            		//If the form was submitted and valid and properly put into database display the INSERT result message
					if($validForm)
					{
        		?>
            <h5 style="color:black;"><?php echo $message ?></h5>
        
        		<?php
					}
					else	//display form
					{
        		?>
               	  
               	  <form method="POST" action="contactUs.php">
                   <h2 style="text-align:center; padding:20px;">Or Fill out our form</h2>
                    <p>
                      	<label for="floatName">NAME</label>
                        <input type="text" name="floatName" id="floatName">
                        <span class="errMsg"><?php echo $firstNameErrMsg; ?></span>
                    </p>
                    <p>
                      <label for="floatEmail">EMAIL</label>
                      <input type="text" name="floatEmail" id="floatEmail">
                      <span class="errMsg"><?php echo $emailErrMsg; ?></span>
                    </p>
                    <h4>Please ask us any Questions or tell us how we 
did below: </h4>
                    <p>
                      <label for="floatMessage">MESSAGE</label>
                      <textarea name="floatMessage" id="floatMessage"></textarea>
                    </p>
                    <p>
                      <input type="submit" name="button" id="button" value="Submit">
                      <input type="reset" name="button2" id="button2" value="Reset">
                    </p>
                    </form>
                    
                    <?php
						}//end else
        			?>   
                    
                </div><!--from-->




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