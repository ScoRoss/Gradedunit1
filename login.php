<?php
include("./header.php");
include("./connectdb.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="CSS/warhammer.css">
</head>
<body><?php
if(isset($_GET['page']) && $_GET['page'] == 'table_booking'){ 
	echo "Please Log in to book a table";
}
?>
	<div class="login-box">
		<h2>Login</h2>
		<form action="loginform.php" method="post">
			<label for="username">Username:</label>
			<input type="text" name="username" required>

			<label for="password_entry">Password:</label>
			<input type="password_entry" name="password_entry" required>

			<button type="submit">Login</button>
		</form>
	</div>
</body>
</html>




<?php
include("./footer.php");
?>