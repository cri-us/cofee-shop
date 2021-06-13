<?php
// Initialize the session
session_start();

//unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

//Redirect to login page
header("location: user_login.php");
exit;
?>