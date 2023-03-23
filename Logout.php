<?php
include("./connectdb.php");
?>

<?php
session_start(); // start the session
$_SESSION = array();

// destroy the session

session_destroy();

// redirect to the home page
header("Location: ./DumfriesG.php");
exit();
?>
