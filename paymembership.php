<?php
include("./header.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Status</title>
</head>
<body>
<h1>Update User Status</h1>
<form action="processpay.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    <input type="hidden" name="userstatus" value="3">
    <button type="submit">Update User Status</button>
</form>
</body>
</html>
<?php
include("./footer.php");
?>