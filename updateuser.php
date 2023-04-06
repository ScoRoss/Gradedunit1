<?php
session_start();
include("./connectdb.php");
?>
<?php
// Get the form values
$Username = $_POST["Username"];
$email = $_POST["email"];
$Crypted_pass = sha1($_POST["password"]);
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$addressline1 = $_POST["addressline1"];
$addressline2 = $_POST["addressline2"];
$postcode = $_POST["postcode"];
$city = $_POST["city"];
$phone = $_POST["phone"];


// Get the user ID from the session
$user_id = $_SESSION['user_id'];


// Prepare and execute stored procedure
$stmt = $db->prepare("CALL updateuseridtotables(:user_id, :Username, :Crypted_pass, :addressline1, :addressline2, :city, :postcode, :firstname, :lastname, :email, :phone)");
$stmt->execute(array(
    ":user_id" => $user_id,
    ":Username" => $Username,
    ":Crypted_pass" => $Crypted_pass,
    
    ":addressline1" => $addressline1,
    ":addressline2" => $addressline2,
    ":city" => $city,
    ":postcode" => $postcode,
    ":firstname" => $firstname,
    ":lastname" => $lastname,
    ":email" => $email,
    ":phone" => $phone
));

// Redirect to table_booking.php
header("Location: ./DumfriesG.php");
exit();

// Check if the update was successful

?>
