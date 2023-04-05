<?php
include("./connectdb.php");
?>

<?php
session_start(); // start the session


// destroy the session

session_destroy();

// redirect to the home page
header("Location: ./indexindex.php");
exit();
?>
