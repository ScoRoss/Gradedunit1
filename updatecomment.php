<?php
include("./connectdb.php");

// Get the comment ID and updated comment text from the form submission
$comment_id = $_POST['comment_id'];
$comment_text = $_POST['comment_text'];

// Update the comment in the database
$stmt = $db->prepare("UPDATE comments SET comment_text = :comment_text WHERE comment_id = :comment_id");
$stmt->bindParam(':comment_text', $comment_text);
$stmt->bindParam(':comment_id', $comment_id);
$stmt->execute();

// Redirect back to the comments page
header("Location: ./view_announc.php");
exit();
?>
