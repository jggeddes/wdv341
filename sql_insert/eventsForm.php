<?php
 //FORM FIELD VARIABLES
 $event_name = "";
 $event_description = "";
 $event_presenter = "";
 $event_date = "";
 $event_time = "";

 //FORM FIELD ERRORS
 $event_name_err = "";
 $event_description_err = "";
 $event_presenter_err = "";
 $event_date_err = "";
 $event_time_err = "";

 $validForm = true;

 if( isset($_POST['event_submit']) ) {

     if( (empty($_POST['event_name'])) ) {
         $validForm = false;
         $event_name_err = " *Event name is required";
     } else {
         $validForm = true;
         $event_name = $_POST['event_name'];
     }

     if( (empty($_POST['event_description'])) ) {
         $validForm = false;
         $event_description_err = " *Event description is required";
     } else {
         $validForm = true;
         $event_description = $_POST['event_description'];
     }

     if( (empty($_POST['event_presenter'])) ) {
         $validForm = false;
         $event_presenter_err = " *Event presenter is required";
     } else {
         $validForm = true;
         $event_presenter = $_POST['event_presenter'];
     }

     if( (empty($_POST['event_date'])) ) {
         $validForm = false;
         $event_date_err = " *Please select a date";
     } else {
         $validForm = true;
         $event_date = $_POST['event_date'];
     }

     if( (empty($_POST['event_time'])) ) {
         $validForm = false;
         $event_time_err = " *Please select a time";
     } else {
         $validForm = true;
         $event_time = $_POST['event_time'];
     }

     if( $_POST['event_location'] != "1") {
        die("Form could not be submitted");
        }

     if($validForm) {

        try {

        require "dbConnect.php";	//CONNECT to the database


        $stmt = $conn->prepare("INSERT INTO wdv341_events (event_name, event_description, event_presenter, event_date, event_time)
        VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)");

        $stmt->bindParam(':eventName', $event_name);
        $stmt->bindParam(':eventDescription', $event_description);
        $stmt->bindParam(':eventPresenter', $event_presenter);
        $stmt->bindParam(':eventDate', $event_date);
        $stmt->bindParam(':eventTime', $event_time);

        $stmt->execute();
     }

     catch(PDOException $e)  {

        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
  
        error_log($e->getMessage());
        error_log($e->getLine());
        error_log(var_dump(debug_backtrace()));
      
          //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
    }

    $event_name = "";
    $event_description = "";
    $event_presenter = "";
    $event_date = "";
    $event_time = "";
    
    echo "<h2>-- New record created successfully --</h2>";

}

};

?>


<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Events Input Form</title>
<style>
#test_name {
   		display: none;
		}

body {
		background-color: white;
		color: black;
		font-size: 1.1em;
		}

#button, #button2 {
			background-color: black;
			color: white;
			}

h1, h2, {
			text-align:center;
			}
.errorMsg {
            color: red;
        }

</style>

</head>
<body>

<form action="eventsForm.php" method="POST" id="inputEvent" style="text-align:center;">
		<h1>WDV341 Intro PHP</h1>
		<h2>Unit 11 - Input New Event</h2>

        <h2>Create a new event</h2>

        <p>
            <label for="event_name">Event Name: </label>
            <input type="text" id="event_name" name="event_name" value="<?php echo $event_name?>"><span class="errorMsg"><?php echo $event_name_err?></span>
        </p>

        <p>
            <label for="event_description">Event Description: </label>
            <input type="text" id="event_description" name="event_description" value="<?php echo $event_description?>"><span class="errorMsg"><?php echo $event_description_err?></span>
        </p>

        <p>
            <label style="display: none;" for="event_location">Event Location: </label>
            <input type="text" id="event_location" name="event_location" style="display: none" autocomplete="off" value="1">
        <p>

            <label for="event-presenter">Event Presenter: </label>
            <input type="text" id="event_presenter" name="event_presenter" value="<?php echo $event_presenter?>"><span class="errorMsg"><?php echo $event_presenter_err?></span>
        </p>

        <p>
            <label for="event_date">Event Date: </label>
            <input type="date" id="event_date" name="event_date" value="<?php echo $event_date?>"><span class="errorMsg"><?php echo $event_date_err?></span>
        </p>

        <p>
            <label for="event_time">Event Time: </label>
            <input type="time" id="event_time" name="event_time" value="<?php echo $event_time?>"><span class="errorMsg"><?php echo $event_time_err?></span> 
        </p>       

        <input type="submit" value="Submit Event" name="event_submit" id="event_submit">
        <input type="reset" value="Reset Form" name="Reset">



    </form>

<p>&nbsp;</p>
</body>
</html>