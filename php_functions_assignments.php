<!DOCTYPE html>
<html>
<head>
	<title>PHP Functions Assignment</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
	h3 {font-weight: bold;}
	ul li {font-weight: bold;}
</style>


</head>
<body>


	<h1>WDV141 Intro PHP</h1>
	
	<h2>Unit 4 - PHP Functions Assignment</h2>	
	
	<h3>Create a function that will accept a date input and format it into mm/dd/yyyy format.</h3>
	
	<?php
		
		function displayFullDate($inDate) {
			echo date ("m/d/y" , strtotime($inDate) );
			}
			
		echo "<p>".displayFullDate("oct 31 2020")."</p>";
	?>
	
	<h3>Create a function that will accept a date input and format it into dd/mm/yyyy format to use when working with international dates.</h3>
	
	<?php
		
		function displayIntlDate($inIntlDate) {
				echo date ("d/m/y", strtotime($inIntlDate) );
				}
		
		echo "<p>".displayIntlDate("oct 31 2020")."</p>";
		
	?>
	
	<h3>Create a function that will accept a string input.  It will do the following things to the string:</h3>
		<ul>
            <li>Display the number of characters in the string</li>
            <li>Trim any leading or trailing whitespace</li>
            <li>Display the string as all lowercase characters</li>
            <li>Will display whether or not the string contains "DMACC" either upper or lowercase</li>
		</ul>	
	
	<?php
		
		function displayTrimLowcaseDMACC($inString) {
				echo $inString; 
				echo "<p>Character Count: " . strlen($inString) . "</p>";
				echo "<p>Trimmed String: " . trim($inString) . "</p>";
				echo "<p>String Lowercase: " . strtolower($inString) . "</p>";
				
				if (stripos($inString, 'DMACC') !== false) {
					echo "This string Contains 'DMACC' ";
					}
					
				else {
					echo "This String does not contain 'DMACC' ";
					}
				}
		
		displayTrimLowcaseDMACC ("It works!!");
	?>
	
	
	<h3>Create a function that will accept a number and display it as a formatted number.   (Use 1234567890 for your testing.)</h3>
	
	<?php
		
		function formatNum($inNum) {
				echo "The formatted number is: " . number_format($inNum);
				}
		formatNum(1234567890);
	?>
	
	<h3>Create a function that will accept a number and display it as US currency.  (Use 123456 for your testing.)</h3>
	
	<?php
		
		function USCurrency($inNum) {
				$formattedNum = number_format($inNum, 2, '.', ',');
                $formattedNum = "$" . $formattedNum;
                return $formattedNum;     
				}
		
		 echo "The number in US currency is: " . USCurrency(123456);
	?>
	
</body>
</html>









