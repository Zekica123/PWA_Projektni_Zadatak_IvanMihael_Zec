<?php
session_start();

// Brisanje svih session varijabli
$_SESSION = array();

// Brisanje session cookie-a
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

// Uništavanje sesije
session_destroy();

// Preusmjeravanje na početnu stranicu
header('Location: ../index.php');
exit;
?>