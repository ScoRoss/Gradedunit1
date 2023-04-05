<?php
// Connect to the required database
include("./connectdb.php") ;

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location:./indexindex.php");
    exit;
}

// Declare the passed information from login.php to local script variables
$Username = $_POST['username'] ;
$password_entry = sha1($_POST['password_entry']) ;

// Define variables and initialize with empty values
$username_err = $password_err = $login_err = "";

// Create and encrypt a copy of the password 
// In this exercise we are going to use sha1 encryption in its simplest form

// Passwords match, now check if the details exist on the database
// Step 1. - Prepare the SQL statement
$stmt = $db->prepare("select * from user
                      where Username = :a
                      and Crypted_pass = :b
                      ");

// Step 2. - Execute the SQL statement
$stmt->execute(array(
    ":a" => $Username,
    ":b" => $password_entry
));

// Only one row should be returned from the query
$a_row = $stmt->fetch(PDO::FETCH_ASSOC) ;

// Check if a row has been found
if ( ($a_row['Username'] && $a_row['Crypted_pass']) != null )
{
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["user_id"] = $a_row['user_id'];
    $_SESSION["userstatus"] = $a_row['userstatus'];
    $_SESSION["username"] = $Username;  
    
    // Include the form at this point
    include("./table_booking.php") ;
}
else
{
    // Display invalid data message
    include("./header.php") ;
    echo $password_entry;
    ?>
    <!-- Add the page content container -->
    <div class="container-fluid">
        <h6 style="text-align: left; color: blue; font-style: italic;">The Customer Login</h6>
        <p style="text-align: left; color: black;">wrong username or password </p>
    </div> <!-- Container -->
    <?php
    include("./footer.php") ;
}  


?>