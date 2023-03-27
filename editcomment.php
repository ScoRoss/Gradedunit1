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

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Comments</title>
    <script>
        function showEditBox(commentId) {
            var editBox = document.getElementById("edit-box-"+commentId);
            editBox.style.display = "block";
        }
    </script>
</head>
<body>
<h1>Comments</h1>
<table>
    <thead>
    <tr>
        <th>Comment ID</th>
        <th>Announcement ID</th>
        <th>User ID</th>
        <th>Comment Text</th>
        <th>Comment Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    include("./connectdb.php");

    $stmt = $db->prepare("SELECT comment_id, announcement_id, user_id, comment_text, comment_date FROM comments");
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($comments as $comment) {
        $comment_id = $comment['comment_id'];
        $announcement_id = $comment['announcement_id'];
        $comment_user_id = $comment['user_id']; // Store the comment's user ID in a separate variable
        $comment_text = $comment['comment_text'];
        $comment_date = $comment['comment_date'];
        ?>
        <tr>
            <td><?php echo $comment_id; ?></td>
            <td><?php echo $announcement_id; ?></td>
            <td><?php echo $comment_user_id; ?></td>
            <td>
                <?php echo $comment_text; ?>
                <div id="edit-box-<?php echo $comment_id; ?>" style="display:none;">
                    <form method="POST" action="./updatecomment.php">
                        <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
                        <input type="text" name="comment_text" value="<?php echo $comment_text; ?>">
                        <input type="submit" value="Save">
                    </form>
                </div>
            </td>
            <td><?php echo $comment_date; ?></td>
            <td>
                <?php if($comment_user_id == $user_id) { ?> <!-- Check if the logged in user's ID matches the comment's user ID -->
                    <button onclick="showEditBox(<?php echo $comment_id; ?>)">Edit</button>
                <?php } ?>
            </td>
            <td>
                <form method="POST" action="./deletecomment.php">
                    <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
                    <input type="submit" value="Delete">
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
