<?php
include("./connectdb.php");
session_start();
$event_name = $_POST['event_name'];
$event_description = $_POST['event_description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$location = $_POST['location'];
$event_date = $_POST['event_date'];

// Convert the dates to Unix timestamps for use to srote for concat 
$start_timestamp = strtotime($start_date);
$end_timestamp = strtotime($end_date);
$event_timestamp = strtotime($event_date);

// Get the number of seconds between the start of the day and the event time 
$event_time_offset = $event_timestamp - strtotime('midnight', $event_timestamp);

// Add the event time offset to the start and end timestamps
$start_timestamp += $event_time_offset;
$end_timestamp += $event_time_offset;

// Convert the timestamps back to datetime format
$start_date = date('Y-m-d H:i:s', $start_timestamp);
$end_date = date('Y-m-d H:i:s', $end_timestamp);

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Prepare the SQL statement
$stmt = $db->prepare("INSERT INTO calendar (event_name, event_description, start_date, end_date, location, user_id)
VALUES (:aa, :bb, :cc, :dd, :ee, :ff)");

// Execute the SQL statement
$stmt->execute(array(
    ":aa" => $event_name,
    ":bb" => $event_description,
    ":cc" => $start_date,
    ":dd" => $end_date,
    ":ee" => $location,
    ":ff" => $user_id
    
));

// Redirect to table_booking.php
header("Location: ./table_booking.php?submitted=1");
exit();
?>
