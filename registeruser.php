<?php
include("./header.php");
include("./connectdb.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<link rel="stylesheet" type="text/css" href="CSS/warhammer.css">
</head>
<body>

	<main>
		<h1>User Registration</h1>
		<form method="POST" action="registeruserform.php">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required><br><br>
			<label for="password">Password:</label>
			<input type="password" id="password_entry" name="password_entry" required><br><br>
			<label for="firstname">First name:</label>
			<input type="text" id="firstname" name="firstname" required><br><br>
			<label for="lastname">Second name:</label>
			<input type="text" id="lastname" name="lastname" required><br><br>
			<label for="addressline1">Address 1:</label>
			<input type="text" id="addressline1" name="addressline1" required><br><br>
			<label for="addressline2">Address 2:</label>
			<input type="text" id="addressline2" name="addressline2" required><br><br>
			<label for="postcode">Postcode:</label>
			<input type="text" id="postcode" name="postcode" required><br><br>
			<label for="city">City:</label>
			<input type="text" id="city" name="city" required><br><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required><br><br>
			<label for="phone">Phone contact:</label>
			<input type="text" id="phone" name="phone" required><br><br>

			<input type="submit" value="Register">
		</form>
	</main>

	<script type="text/javascript">
		function toggleMenu() {
			var x = document.getElementsByTagName("nav")[0];
			if (x.className === "") {
				x.className = "responsive";
			} else {
				x.className = "";
			}
		}
	</script>
</body>
</html>


<?php
include("./footer.php");
?>