
<?php
session_start();
include("./header.php");
include("./connectdb.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update details with us </title>
</head>
<body>
	<h1>Update details with us!!!</h1>
	<form action="updateuser.php" method="post">
		<label for="Username">Username:</label>
		<input type="text" id="Username" name="Username" required><br>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br>

		<label for="Crypted_pass">Password:</label>
		<input type="password" id="password" name="password" required><br>

		<label for="firstname">First Name:</label>
		<input type="text" id="firstname" name="firstname" required><br>

		<label for="lastname">Last Name:</label>
		<input type="text" id="lastname" name="lastname" required><br>

		<label for="addressline1">Address Line 1:</label>
		<input type="text" id="addressline1" name="addressline1" required><br>

		<label for="addressline2">Address Line 2:</label>
		<input type="text" id="addressline2" name="addressline2"><br>

		<label for="postcode">Postcode:</label>
		<input type="text" id="postcode" name="postcode" required><br>

		<label for="city">City:</label>
		<input type="text" id="city" name="city" required><br>

		<label for="phone">Phone:</label>
		<input type="tel" id="phone" name="phone" required><br>

        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

		<input type="submit" value="Update" > 
	</form>
</body>
</html>
<?php
include("./footer.php");
?>