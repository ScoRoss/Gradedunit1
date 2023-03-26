<?php
session_start();
include("./connectdb.php");

session_start();
include("./connectdb.php");

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the logged in user's ID from the session
    $user_id = $_SESSION['user_id'];

    // Get the values submitted in the form
    $announcement_id = $_POST['announcement_id'];
    $comment_text = $_POST['comment_text'];
    $comment_date = date('Y-m-d H:i:s');

    // Insert the new comment into the database
    $stmt = $db->prepare("INSERT INTO comments (announcement_id, user_id, comment_text, comment_date) VALUES (:announcement_id, :user_id, :comment_text, :comment_date)");

    $stmt->bindParam(':announcement_id', $announcement_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':comment_text', $comment_text);
    $stmt->bindParam(':comment_date', $comment_date);

    if ($stmt->execute()) {
        // If the insert was successful, redirect the user to the view_announc page
        header("Location: view_announc.php?id=$announcement_id");
        exit;
    } else {
        // If there was an error with the insert, display an error message
        echo "Error: " . $stmt->errorInfo()[2];
    }
}


?>
