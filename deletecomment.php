<?php
include("./connectdb.php");

// Get the comment ID from the form submission
$comment_id = $_POST['comment_id'];

// Delete the comment from the database
$stmt = $db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
$stmt->bindParam(':comment_id', $comment_id);
$stmt->execute();

// Redirect back to the comments page
header("Location: ./view_announc.php");
exit();
?>
