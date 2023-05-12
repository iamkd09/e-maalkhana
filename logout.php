<?php
// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the index.php page
header("Location: index.php");
exit;
?>
