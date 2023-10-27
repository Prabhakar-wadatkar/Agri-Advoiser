<?php
// Start or resume the session
session_start();

// Destroy all session data
session_destroy();

// Redirect the user to the login page after logout
header("Location: ../index.php");
exit();
?>
