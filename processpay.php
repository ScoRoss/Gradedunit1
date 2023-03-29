<?php
session_start();
include("./connectdb.php");

// Update user status to 3 for the logged in user
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    echo "User ID retrieved from session: $user_id"; // Debug statement
    $stmt = $db->prepare("UPDATE user SET userstatus = :userstatus WHERE User_id = :user_id");
    $stmt->bindParam(":userstatus", $_POST['userstatus']);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}

// Redirect the user back to the payment page
header("Location: ./paymembership.php");
exit();
?>
