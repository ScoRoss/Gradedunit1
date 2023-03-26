<?php
include("./connectdb.php");
include('./header.php');


?>

<!DOCTYPE html>
<html>
<head>
    <title>Announcements</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Announcements</h1>

<?php
// Retrieve announcements from the database
$stmt = $db->prepare("SELECT announcement_id, announcement_title, announcement_text, image FROM announcements");
$stmt->execute();
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display each announcement
foreach ($announcements as $announcement) {
    echo "<h2>".$announcement['announcement_title']."</h2>";
    echo "<img src='data:image/jpeg;base64,".base64_encode($announcement['image'])."' />";
    echo "<p>".$announcement['announcement_text']."</p>";

    // Display comments for this announcement
    $stmt = $db->prepare("SELECT comments.comment_text, comments.comment_date, useraddressandname.firstname FROM comments INNER JOIN useraddressandname ON comments.user_id = useraddressandname.user_id WHERE announcement_id = :announcement_id ORDER BY comment_date DESC");
    $stmt->bindValue(':announcement_id', $announcement['announcement_id']);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Comments:</h3>";
    foreach ($comments as $comment) {
        echo "<p><strong>".$comment['firstname']."</strong> - ".$comment['comment_text']." - ".$comment['comment_date']."</p>";
    }

    // Display comment form for this announcement
    echo "<form id='comment_form_".$announcement['announcement_id']."' method='POST' action='./postcomment.php'>";
    echo "<input type='hidden' name='announcement_id' value='".$announcement['announcement_id']."'>";
    echo "<label for='comment_text_".$announcement['announcement_id']."'>Add a comment:</label>";
    echo "<textarea id='comment_text_".$announcement['announcement_id']."' name='comment_text' required style='width: 100%; height: 50px;'></textarea><br>";
    echo "<input type='submit' value='Post Comment'>";
    echo "</form>";
}
?>

</body>
</html>

<?php
include("./footer.php");
?>
