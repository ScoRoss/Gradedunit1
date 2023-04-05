<?php
require_once('./mailer/vendor/autoload.php');
// Connect to the database
include("./connectdb.php") ;
use PHPMailer\PHPMailer\PHPMailer;

$addressline1 = $_POST['addressline1'];
$addressline2 = $_POST['addressline2'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password_entry = $_POST['password_entry'];

// Convert the customer password to an encrypted password
$Crypted_pass = sha1($password_entry);

// Insert the user's data into the user and useradresstable table by using a prepare then execute operation
$stmt = $db->prepare("CALL adduseridtotables(:aa, :cc, :kk, :ff, :gg, :ii, :hh, :dd, :ee, :bb, :jj)");
$stmt->execute(array(
    ":aa" => $username,
    ":bb" => $email,
    ":cc" => $Crypted_pass,
    ":dd" => $firstname,
    ":ee" => $lastname,
    ":ff" => $addressline1,
    ":gg" => $addressline2,
    ":hh" => $postcode,
    ":ii" => $city,
    ":jj" => $phone,
    ":kk" => 2
));
// here i would have a domain and have it registered in order to send
//due to spam accounts and in general scammers it is no longer possible to do.
// here is an example of an email form that would be used to send the privacy aggreement and terms of being on the website.
// Send an email to the user
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = '';
$mail->Password = '';
$mail->setFrom('', 'ross');
$mail->addAddress($email, $firstname . ' ' . $lastname);
$mail->Subject = 'Welcome to our website!';
$mail->Body = 'Thank you for registering with our website!
this is a test';
$mail->send();

// Redirect the user to the homepage
header("Location: ./indexindex.php");
?>