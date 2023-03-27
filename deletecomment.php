<?php
include("./connectdb.php");

// Get the comment ID from the form submission
$comment_id = $_POST['comment_id'];

// Get the user ID of the user who made the comment
$stmt = $db->prepare("SELECT user_id FROM comments WHERE comment_id = :comment_id");
$stmt->bindParam(':comment_id', $comment_id);
$stmt->execute();
$comment = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $comment['user_id'];

// Check if the user ID matches the ID of the currently logged in user
if ($_SESSION['user_id'] == $user_id) {

    // Delete the comment from the database
    $stmt = $db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
    $stmt->bindParam(':comment_id', $comment_id);
    $stmt->execute();

    // Redirect back to the comments page
    header("Location: ./view_announc.php");
    exit();

} else {

    // If the user ID does not match, display an error message or redirect to an error page
    echo "You are not authorized to delete this comment.";
    exit();

}

?>