<?php
include("./connectdb.php");

// Get the comment ID and updated comment text from the form submission
$comment_id = $_POST['comment_id'];
$comment_text = $_POST['comment_text'];

// Get the user ID associated with the comment
$stmt = $db->prepare("SELECT user_id FROM comments WHERE comment_id = :comment_id");
$stmt->bindParam(':comment_id', $comment_id);
$stmt->execute();
$comment = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $comment['user_id'];

// Check if the user ID associated with the comment matches the user ID of the current session
if ($_SESSION['user_id'] == $user_id) {
    // Update the comment in the database
    $stmt = $db->prepare("UPDATE comments SET comment_text = :comment_text WHERE comment_id = :comment_id");
    $stmt->bindParam(':comment_text', $comment_text);
    $stmt->bindParam(':comment_id', $comment_id);
    $stmt->execute();
}

// Redirect back to the comments page
header("Location: ./view_announc.php");
exit();
?>
