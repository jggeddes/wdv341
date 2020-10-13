<!DOCTYPE html>
<html>
<head>
	<title>PHP Basics Assignment</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


	<h1>WDV141 Intro PHP</h1>
	

	<?php
		$myName = "Justina Geddes";
		
		echo "<h1>Unit 3 - PHP Basics Assignment</h1>"
		
	?>	
	
	<h2><?php echo $myName ?></h2>
	
	<?php
		$number1 = 300;
		$number2 = 200;
		$total = $number1 + $number2;
		
		echo "<p>$number1 added to $number2 will total: $total</p>";
		
	?>
	<?php 
	
		$languages = "'PHP', 'HTML', 'Javascript'"; 
	
	?>
	<script>

    	let ourDevLanguages = ['PHP', 'HTML', 'Javascript'];

    	for (let x=0; x < ourDevLanguages.length; x++) {
        document.write("<p>" + ourDevLanguages[x] + "</p>");
    			}
		
	</script>
	
</body>
</html>