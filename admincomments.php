<?php
include("./connectdb.php");
include('./header.php');

$user_id = $_SESSION['user_id'];

// Retrieve the user status from the user table
$stmt = $db->prepare("SELECT userstatus FROM user WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$user_status = $user['userstatus'];

// Check if user is an admin
if ($user_status < 5) {
    header('Location: ./DumfriesG.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_comments'])) {
        // Delete all comments
        $stmt = $db->prepare("DELETE FROM comments");
        $stmt->execute();
    } else if (isset($_POST['delete_comment'])) {
        // Delete a specific comment
        $comment_id = $_POST['comment_id'];
        $stmt = $db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Comments</title>
</head>
<body>
<h1>Comments</h1>
<form method="POST">
    <input type="submit" name="delete_comments" value="Delete All Comments">
</form>
<table>
    <thead>
    <tr>
        <th>Comment ID</th>
        <th>Announcement ID</th>
        <th>User ID</th>
        <th>Comment Text</th>
        <th>Comment Date</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $db->prepare("SELECT comment_id, announcement_id, user_id, comment_text, comment_date FROM comments");
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($comments as $comment) {
        $comment_id = $comment['comment_id'];
        $announcement_id = $comment['announcement_id'];
        $comment_user_id = $comment['user_id'];
        $comment_text = $comment['comment_text'];
        $comment_date = $comment['comment_date'];
        ?>
        <tr>
            <td><?php echo $comment_id; ?></td>
            <td><?php echo $announcement_id; ?></td>
            <td><?php echo $comment_user_id; ?></td>
            <td><?php echo $comment_text; ?></td>
            <td><?php echo $comment_date; ?></td>
            <td>
                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                    <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
                    <input type="submit" name="delete_comment" value="Delete">
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>

<?php
include("./footer.php");
?>
