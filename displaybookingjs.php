
<?php
session_start();
include("./header.php");
include("./connectdb.php");
?>
<?php 
$monthstr = "2023-03-01";

// Prepare the SQL statement to retrieve all bookings with user details
$stmt = $db->prepare("
    SELECT c.*, u.firstname, u.lastname, DATE_FORMAT(c.start_date, '%Y-%m-%d') AS booking_date
    FROM calendar c 
    INNER JOIN  useraddressandname u ON c.user_id = u.user_id
    WHERE DATE_FORMAT(c.start_date, '%Y-%m') = '".date('Y-m', strtotime($monthstr))."'
");

// Execute the SQL statement
$stmt->execute();

// Fetch all the bookings and store them in an array
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<head>
  <link rel="stylesheet" type="text/css" href="CSS/calendar.css">
</head>

<table>
<thead> 
    <tr>
        <th>Booking Date</th>
        <th>Event Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Location</th>
        <th>Event Description</th>
        <th>Created By</th>
    </tr>
</thead>
<tbody>

    <?php foreach ($bookings as $booking) { ?>
        <tr>
            <td><?= $booking['booking_date'] ?></td>
            <td><?= $booking['event_name'] ?></td>
            <td><?= $booking['start_date'] ?></td>
            <td><?= $booking['end_date'] ?></td>
            <td><?= $booking['location'] ?></td>
            <td><?= $booking['event_description'] ?></td>
            <td><?= $booking['firstname'] ?> <?= $booking['lastname'] ?></td>
        </tr>
    <?php } ?>

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

            // Construct the HTML for the booking details
            var html = '<div class="booking-details-container">';
            html += '<div class="booking-details-header">' + startTime + ' - ' + endTime + '</div>';
            html += '<div class="booking-details-info">Location: ' + location + '</div>';
            html += '<div class="booking-details-info">Created By: User ' + userId + '</div>';
            html += '<div class="booking-details-info">Event Description: ' + eventDesc + '</div>';
            html += '</div>';

            // Display the booking details
            $('#booking-details').html(html).show();
        });
    });
</script>

<?php
include("./footer.php");
?>