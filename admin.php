<?php
include("./header.php");
include("./connectdb.php");
?>

<?php
// Start session
session_start();

// Check if user is logged in and has status of 5
if (!isset($_SESSION['user_id']) || $_SESSION['userstatus'] === 5) {
  header("Location: ./admin.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin page</title>
  <link rel="stylesheet" type="text/css" href="CSS/warhammer.css">
  <style>
    table td {
      border: 1px solid #ccc;
      padding: 10px;
      word-wrap: break-word;
    }
  </style>
</head>
<body>
  <main>
    <form method="post" action="adminform.php">
      <table>
        <tr>
          <th>Select</th>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone</th>
          <th>Address Line 1</th>
          <th>Address Line 2</th>
          <th>City</th>
          <th>Postal Code</th>
          <th>User Status</th>
        </tr>
        <?php
        // Retrieve the list of users from the database and display them in the table
        $stmt = $db->prepare("SELECT user.user_id, user.Username, user.email, user.phone, user.userstatus,
        useraddressandname.addressline1, useraddressandname.addressline2,
        useraddressandname.city, useraddressandname.postcode,
        useraddressandname.firstname, useraddressandname.lastname
        FROM user
        INNER JOIN useraddressandname
        ON user.user_id = useraddressandname.user_id
        ORDER BY user.user_id;");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Now you have an array of users with their details, which you can display as needed
        foreach ($users as $user) {
          echo "<tr>";
          echo "<td><input type='checkbox' name='user_id[]' value='".$user['user_id']."'></td>";
          echo "<td>".$user['user_id']."</td>";
          echo "<td>".$user['Username']."</td>";
          echo "<td>".$user['email']."</td>";
          echo "<td>".$user['firstname']."</td>";
          echo "<td>".$user['lastname']."</td>";
          echo "<td>".$user['phone']."</td>";
          echo "<td>".$user['addressline1']."</td>";
          echo "<td>".$user['addressline2']."</td>";
          echo "<td>".$user['city']."</td>";
          echo "<td>".$user['postcode']."</td>";
          echo "<td><select name='userstatus[".$user['user_id']."]'>";
          echo "<option value='1' ".($user['userstatus'] == 1 ? 'selected' : '').">1</option>";
          echo "<option value='2' ".($user['userstatus'] == 2 ? 'selected' : '').">2</option>";
          echo "<option value='3' ".($user['userstatus'] == 3 ? 'selected' : '').">3</option>";
          echo "<option value='4' ".($user['userstatus'] == 4 ? 'selected' : '').">4</option>";
          echo "<option value='5' ".($user['userstatus'] == 5 ? 'selected' : '').">5</option>";
          echo "<option value='6' ".($user['userstatus'] == 6 ? 'selected' : '').">6</option>";
          echo "</select></td>";
          echo "</tr>";
        }
        ?>

<!-- here is a comfirmation button more or less for makingsure that before you finalise the action you select what you are doing --!>
      </table>

        <input type="submit" name="submit_update" value="Update User Status">
        <input type="submit" name="submit_remove" value="Remove Selected Users">
        <select name="action">
            <option value="update">Update Status</option>
            <option value="remove">Remove Users</option>
    </form>
  </main>
</body>
</html>

<?php
include("./footer.php");
?>
