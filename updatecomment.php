<?php
session_start();
include("./connectdb.php");

// Get the comment ID and updated comment text from the form submission
$comment_id = $_POST['comment_id'];
$comment_text = $_POST['comment_text'];

// Get the user ID associated with the comment
$stmt = $db->prepare("SELECT user_id, comment_text FROM comments WHERE comment_id = :comment_id");
$stmt->bindParam(':comment_id', $comment_id);
$stmt->execute();
$comment = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $comment['user_id'];
$old_comment_text = $comment['comment_text'];

// Check if the user ID associated with the comment matches the user ID of the current session
if ($_SESSION['user_id'] == $user_id) {
    // Prepare and execute the update statement
    $stmt = $db->prepare("UPDATE comments SET comment_text = :comment_text WHERE comment_id = :comment_id");
    $stmt->bindParam(':comment_text', $comment_text);
    $stmt->bindParam(':comment_id', $comment_id);
    $stmt->execute();

// Retrieve the user information and original comment text
    $stmt = $db->prepare("SELECT u.Username, u.email, uan.firstname, uan.lastname, c.comment_text, c.comment_date FROM comments c JOIN user u ON c.user_id = u.user_id JOIN useraddressandname uan ON u.user_id = uan.user_id WHERE c.comment_id = :comment_id ORDER BY c.comment_date DESC");
    $stmt->bindParam(':comment_id', $comment_id);
    $stmt->execute();
    $log_info = $stmt->fetch(PDO::FETCH_ASSOC);

// Write the original and new comment text to a file, along with user information and the date/time of the comment
    $log_message = "Comment ID: " . $comment_id . ", Old Comment Text: " . $old_comment_text . ", New Comment Text: " . $comment_text . ", Username: " . $log_info['Username'] . ", Email: " . $log_info['email'] . ", First Name: " . $log_info['firstname'] . ", Last Name: " . $log_info['lastname'] . ", Date/Time: " . $log_info['comment_date'] . "\n";
    $log_file = fopen("comment_log.txt", "a");
    fwrite($log_file, $log_message);
    fclose($log_file);
}

// Redirect back to the comments page
header("Location: ./view_announc.php");
exit();

?>
