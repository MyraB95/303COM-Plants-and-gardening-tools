<?php
session_destroy(); 
// Unset all of the session variables
$_SESSION = array();


// If the session is set, destroy it
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

// Redirect to the home page or any other desired page after logging out
header("Location: index.php"); // Change index.php to your desired landing page
exit;
?>
