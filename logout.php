<?php
// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();
setcookie("tokenData", "", time() - 3600);

// Redirect the user to the index.php page
header("Location: index.php");
exit;
?>
