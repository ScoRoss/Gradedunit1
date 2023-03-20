<?php
session_start();
include("./header.php");
include("./connectdb.php");
?>
<?php 
$monthstr = "2023-03-01";
$monthdisplay = new datetime($monthstr);
$nextmonth = new datetime($monthstr);
date_add($nextmonth, date_interval_create_from_date_string('1 month'));
$lastday = cal_days_in_month(CAL_GREGORIAN,date('m',$monthdisplay->getTimestamp()),date('Y',$monthdisplay->getTimestamp()));




// Prepare the SQL statement to retrieve all bookings with user details
$stmt = $db->prepare("
    SELECT c.*, u.firstname, u.lastname, DATE_FORMAT(c.start_date, '%Y-%m-%d') AS booking_date
    FROM calendar c 
    INNER JOIN  useraddressandname u ON c.user_id = u.user_id
    WHERE start_date >= '".date_format($monthdisplay,'Y-m-d')."' AND end_date < '".date_format($nextmonth, 'Y-m-d')."'
");

// Execute the SQL statement
$stmt->execute();

// Fetch all the bookings and store them in an array
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Define an array to map day of the week to column number in the calendar
$daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

// Define the number of rows and columns in the calendar
$numRows = 6;
$numCols = 7;

// Create a 2D array to store the bookings for each day of the month
//$calendar = array_fill(0, $numRows, array_fill(0, $numCols, array()));

$calendar = array_fill(1,31, array());
foreach ($bookings as $booking){
    $day = date("d",strtotime($booking['start_date']));
    $calendar[$day][] = $booking;

} 















?>
<head>
  <link rel="stylesheet" type="text/css" href="CSS/calendar.css">
</head>
<pre>


</pre>
<?PHP var_dump($bookings);
?>
<table>
<thead> 
    <tr>
        <th><?= $daysOfWeek[0] ?></th>
        <th><?= $daysOfWeek[1] ?></th>
        <th><?= $daysOfWeek[2] ?></th>
        <th><?= $daysOfWeek[3] ?></th>
        <th><?= $daysOfWeek[4] ?></th>
        <th><?= $daysOfWeek[5] ?></th>
        <th><?= $daysOfWeek[6] ?></th>
    </tr>
</thead>
<tbody>

    <?php
    // Calculate the number of days in the current month
    $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

    // Initialize the day of the month to 1
    $dayOfMonth = 1;

    // Iterate over the rows of the calendar
    for ($row = 1; $row <= $numRows; $row++) {
        echo "<tr>";
        // Iterate over the columns of the calendar
        for ($col = 1; $col <= $numCols; $col++) {
            echo "<td>";
            // If the current day of the month is less than or equal to the number of days in the month,
            // display the day and any bookings for that day
            if ($dayOfMonth <= $numDaysInMonth) {
                $bookings = isset($calendar[$dayOfMonth]) ? $calendar[$dayOfMonth] : array();
                echo "<div class='day-container'>";
                echo "<div class='day-of-month'>$dayOfMonth</div>";
                foreach ($bookings as $booking) {
                    echo "<div class='booking' data-start-time='" . $booking['start_date'] . "' data-end-time='" . $booking['end_date'] . "' data-location='" . $booking['location'] . "' data-user-id='" . $booking['user_id'] . "' data-event-description='" . $booking['event_description'] . "'>";
                    echo "<div class='booking-header'>" . $booking['event_name'] . "</div>";
                    echo "<div class='booking-details'>";
                    echo "<div class='booking-info'>" . $booking['location'] . "</div>";
                    echo "<div class='booking-info'>" . $booking['start_date'] . " - " . $booking['end_date'] . "</div>";
                    echo "<div class='booking-info'>" . $booking['event_description'] . "</div>";
                    echo "<div class='booking-info'>Created by " . $booking['firstname'] . " " . $booking['lastname'] . "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
            echo "</td>";
            // Increment the day of the month
            $dayOfMonth++;
        }
        echo "</tr>";
    }
    ?>
</tbody>
</table>





<div id="booking-details"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Hide the booking details div initially
        $('#booking-details').hide();

        // When a booking is clicked, display the booking details
        $('.booking').click(function() {
            // Get the booking details from the data attributes
            var startTime = $(this).data('start-time');
            var endTime = $(this).data('end-time');
            var location = $(this).data('location');
            var userId = $(this).data('user-id');
            var eventDesc = $(this).data('event-description');

            // Format the booking details
            var bookingDetails = '<p><strong>Start time:</strong> ' + startTime + '</p>';
            bookingDetails += '<p><strong>End time:</strong> ' + endTime + '</p>';
            bookingDetails += '<p><strong>Location:</strong> ' + location + '</p>';
            bookingDetails += '<p><strong>User ID:</strong> ' + userId + '</p>';
            bookingDetails += '<p><strong>Event Description:</strong> ' + eventDesc + '</p>';

            // Display the booking details in the booking-details div
            $('#booking-details').html(bookingDetails);
            $('#booking-details').show();
        });
    });
</script>


<?php
include("./footer.php");
?>