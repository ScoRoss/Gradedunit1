<?php
// Database connection data (use for XAMPP local)
$user = "root" ;
$pass = "" ;
$db = "dumfriesgamersdb" ;
$server = "localhost" ;

// This is the connection string
$db = new PDO('mysql:host=localhost;dbname=dumfriesgamersdb', $user, $pass);
// Check for any errors
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
