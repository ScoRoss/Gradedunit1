<?php
include("./connectdb.php");

// Check if form was submitted
if (isset($_POST['user_id'])) {
  // Loop through the selected user IDs and perform the selected action (remove or update status)
  foreach ($_POST['user_id'] as $user_id) {
    // Check which action was selected
    if (isset($_POST['action']) && $_POST['action'] === 'remove') {
      // Delete the user from the database
      $stmt = $db->prepare("DELETE FROM user WHERE user_id = :user_id");
      $stmt->bindParam(':user_id', $user_id);
      $stmt->execute();
    } else {
      // Update the user's status
      $userstatus = $_POST['userstatus'][$user_id];
      $stmt = $db->prepare("UPDATE user SET userstatus = :userstatus WHERE user_id = :user_id");
      $stmt->bindParam(':userstatus', $userstatus);
      $stmt->bindParam(':user_id', $user_id);
      $stmt->execute();
    }
  }
  // Redirect back to the admin page
  header("Location: ./admin.php");
  exit();
}
?>
