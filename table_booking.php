<?php
include("./header.php");
include("./connectdb.php");
@session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./login.php?page=table_booking");
    exit;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Book a table</title>
	<link rel="stylesheet" href="CSS/datepicker.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
</head>
<body>
	<div class="container">
	<?php if(@$_GET['submitted']){ ?>
<div class="calendar-submitted-container">
Your submission has been added to the system, thank you.
</div>
<?php } ?>
		<h1>Book a table</h1>
		<?php 
		// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION["userstatus"]) && $_SESSION["userstatus"] == 3 OR 5 ){?>
    
    
		<form method="POST" action="booktableform.php">
			<label for="start_date">Event Date</label>
			<input type="date" id="start_date" name="start_date" placeholder="Select a date...">
			

			<label for="event_name">Event Name</label>
			<input id="event_name" type="text" name="event_name" />

			<label for="event_description">Event Description</label>
			<textarea id="event_description" name="event_description" rows="6" cols="50"></textarea>


			<label for="start_date">Start time</label>
			<input id="start_date" type="time" name="start_date" />

			<label for="end_date">End Time</label>
			<input type="time" id="end_date" name="end_date" />
			<input type="hidden" value="1" name="user_id" />
			<label for="location">Location</label>
			<select name="location" id="location">
			<option value="main_hall">Main Hall</option>
			<option value="kitchen">Kitchen</option>
			<option value="upstairs">Upstairs</option>
			</select>
			
			<button type="submit">Submit</button>
		</form>
<?php } else {
	echo "You must be a paying memeber to book a table";
} ?>
	</div>

	<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	<script>
		$(function() {
			$( "#datepicker" ).datepicker();
		});
	</script>
</body>
</html>





<?php
include("./footer.php");
?>