<?php
session_start();

// Unset all session variables
// $_SESSION = [];
session_unset();
// Destroy the session
session_destroy();

// Optional: delete the session cookie
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Redirect to login page
header("Location: login.php");
exit;
