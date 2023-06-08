<?php
// Unset all of the session variables
setcookie("tokenData", "", time() - 3600, '/');
$_SESSION = array();

// Destroy the session
session_destroy();

ob_clean();
// Redirect the user to the index.php page
header("Location: index.php");
exit;
?>
