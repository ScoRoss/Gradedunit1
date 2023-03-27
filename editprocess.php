<?php
session_start();
include("./connectdb.php");
include("./header.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the logged in user's ID from the session
$user_id = $_SESSION['user_id'];

// Check if a comment ID has been provided
if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];

    // Check if the user is allowed to edit this comment
    $stmt = $db->prepare("SELECT * FROM comments WHERE comment_id = :comment_id AND user_id = :user_id");
    $stmt->bindValue(':comment_id', $comment_id);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        // If the user is not allowed to edit this comment, display an error message
        echo "You are not authorized to edit this comment.";
        exit;
    }

    // If the user is allowed to edit this comment, display the edit form
    echo "<form method='POST' action='./editcomment.php'>";
    echo "<input type='hidden' name='comment_id' value='$comment_id'>";
    echo "<textarea name='comment_text' required style='width: 100%; height: 50px;'>".$result['comment_text']."</textarea><br>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";

} else {
    // If a comment ID has not been provided, display a list of the user's comments with edit buttons
    $stmt = $db->prepare("SELECT comments.comment_id, comments.comment_text, comments.comment_date, announcements.announcement_title FROM comments INNER JOIN announcements ON comments.announcement_id = announcements.announcement_id WHERE comments.user_id = :user_id ORDER BY comment_date DESC");
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h1>Your Comments:</h1>";
    foreach ($comments as $comment) {
        echo "<h2>".$comment['announcement_title']."</h2>";
        echo "<p>".$comment['comment_text']."</p>";
        echo "<p>".$comment['comment_date']."</p>";
        echo "<a href='edit_comment.php?comment_id=".$comment['comment_id']."'>Edit</a>";
    }
}

include("./footer.php");
?>

