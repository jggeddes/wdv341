<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>WDV341 PHP-JSON Event Object Assignment</title>
	

</head>
<body>
<?php
	//Get the Event data from the server.
    require 'dbConnect.php';

try {
    $stmt = $conn->prepare("SELECT `event_id`, `event_name`, `event_description`, `event_presenter`, `event_date`, `event_time` FROM `wdv341_ event` LIMIT 2");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$outputObj = new stdClass();

	$outputObj->eventName = $row['event_name'];
	$outputObj->eventDescription = $row['event_description'];
	$outputObj->eventPresenter = $row['event_presenter'];
	$outputObj->eventDate = $row['event_date'];
	$outputObj->eventTime = $row['event_time'];
//
	$returnObj = json_encode($outputObj);	//create the JSON object
//	
	echo $returnObj;

?>




	<h1>WDV341 Intro PHP</h1>
	<h2>Unit 9: PHP-JSON Event Object Assignment</h2>





</body>
</html>