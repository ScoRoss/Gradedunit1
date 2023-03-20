
<?php
include("./header.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment Page</title>

</head>
<body>

	<main>
		<h1>Make Payment</h1>
		<form action="process_payment.php" method="post">
			<label for="card_number">Card Number:</label>
			<input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
			<label for="expiry_date">Expiry Date:</label>
			<input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
			<label for="security_code">Security Code:</label>
			<input type="text" id="security_code" name="security_code" placeholder="123" required>
			<label for="billing_address">Billing Address:</label>
			<input type="text" id="billing_address" name="billing_address" placeholder="123 Main Street" required>
			<label for="amount">Amount:</label>
			<input type="text" id="amount" name="amount" placeholder="100" required>
			<label for="currency">Currency:</label>
			<select id="currency" name="currency">
				<option value="USD">USD</option>
				<option value="EUR">EUR</option>
				<option value="GBP">GBP</option>
			</select>
			<input type="submit" value="Submit Payment">
		</form>
	</main>
	<footer>
		<p>Copyright &copy; 2023</p>
	</footer>
</body>
</html>
<?php
include("./footer.php");
?>