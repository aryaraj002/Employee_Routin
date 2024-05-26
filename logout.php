<?php
// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to login page or homepage
header("Location: http://localhost//project/home.html "); // Change 'login.php' to your login or homepage URL
exit();
?>
