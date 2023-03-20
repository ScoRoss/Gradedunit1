<?php
include("./connectdb.php");

// Check if form was submitted
if (isset($_POST['user_id'])) {
  // Loop through the selected user IDs and update their user status
  foreach ($_POST['user_id'] as $user_id) {
    $userstatus = $_POST['userstatus'][$user_id];
    $stmt = $db->prepare("UPDATE user SET userstatus = :userstatus WHERE user_id = :user_id");
    $stmt->bindParam(':userstatus', $userstatus);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
  }
  // Redirect back to the admin page
  header("Location: ./admin.php");
  exit();
}
?>
