<?php
session_start();

$razina = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ? (int)$_SESSION['razina'] : -1;

if ($razina < 1) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['vijest_id']) || !ctype_digit($_POST['vijest_id'])) {
    header("Location: ../popis_vijesti.php");
    exit();
}

$_SESSION['vijest_id'] = (int)$_POST['vijest_id'];

header("Location: ../update_forma.php");
exit();
?>