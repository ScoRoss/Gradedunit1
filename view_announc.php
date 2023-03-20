<?php
include("./connectdb.php");
include('./header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Announcements</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<h1>Announcements</h1>

	<?php
		// Retrieve announcements from the database
		$stmt = $db->prepare("SELECT announcement_title, announcement_text, image FROM announcements");
		$stmt->execute();
		$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// Display each announcement
		foreach ($announcements as $announcement) {
			echo "<h2>".$announcement['announcement_title']."</h2>";
			echo "<img src='data:image/jpeg;base64,".base64_encode($announcement['image'])."' />";
			echo "<p>".$announcement['announcement_text']."</p>";
		}
	?>

</body>
</html>

<?php
include("./footer.php");
?>
