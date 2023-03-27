<?php
include("./connectdb.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="CSS/warhammer.css">
  <title>Dumfries Gamers Club</title>
  <script>
    function toggleNav() {
      var nav = document.getElementById("main-nav");
      if (nav.className === "nav") {
        nav.className += " responsive";
      } else {
        nav.className = "nav";
      }
    }
  </script>
</head>
<body>
<div class="container-fluid no-padding"> <!-- containers are 1200px wide with default 15px padding -->
		<div class="row">
		  <div class="col-md-12">

			<img class="img-fluid float-center img-responsive" src="./Logo/DGlogo1.jpg" alt="Page header image" width="100%"/>

		  </div> <!-- col -->
		</div> <!-- row -->
	</div><!-- container -->
  <?php
// Assuming you have already started the session and stored the user status in $_SESSION['user_status']
if (isset($_SESSION['userstatus']) && $_SESSION['userstatus'] == 5) {
  $admin_link = '<a href="./admin.php">Admin</a>';
} else {
  $admin_link = '';
}
?>

<header>
  <nav>
    <a href="./DumfriesG.php">Home</a>
    <a href="./aboutus.php">About Us</a>
    <a href="./registeruser.php">Membership</a>
    <a href="./paymembership.php">Pay Membership</a>
    <a href="./updatePI.php">Update Details</a>
      <a href="./scoreboard.php">Submit Score</a>
    <a href="./table_booking.php">Book Table</a>
      <a href="./viewscore.php">Score Log</a>
    <a href="./display_booking.php">Active Bookings</a>
    <a href="./picsofmini.php">Pics and Mini of the week</a>
    <a href="./displaybookingjs.php">Active Bookings 2nd view</a>
    <a href="./announcment.php">Announcement</a>
    <a href="./view_announc.php"> View Announcements</a>
      <a href="./editcomment.php"> edit comment</a>
    <?php echo $admin_link; ?>
    <a href="./login.php">Login</a>
    <a href="./Logout.php">Logout</a>

    <a href="#" class="icon" onclick="myFunction()">&#9776;</a>
  </nav>
</header>

