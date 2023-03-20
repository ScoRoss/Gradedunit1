<?php 
include("./connectdb.php");
include('./header.php');
// Get user_id from session variable
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Announcements</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<h1>Announcement To Members</h1>

	<form id="announcment_form.php" method="POST" action="./announcment_form.php" enctype="multipart/form-data">
  		<label for="announcement_title">Announcement Title:</label>
  		<input type="text" id="announcement_title" name="announcement_title" required><br>

  		<label for="announcement_text">Announcement Text:</label>
  		<textarea id="announcement_text" name="announcement_text" required style="width: 100%; height: 200px;"></textarea><br>
  		<label for="announcement_date">Date:</label>
  		<input type="datetime" id="announcement_date" name="announcement_date" value="<?php echo date('Y-m-d'); ?>" required><br>
  		<label for="image">Image:</label>
  		<input type="file" id="image" name="image" accept="image/*"><br>

  		<input type="submit" value="Submit">
	</form>

	<div id="message"></div>


</body>
</html>
<?php
include("./footer.php");
?>
