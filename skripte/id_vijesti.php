<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["vijest_id"]) && is_numeric($_POST["vijest_id"])) {
    $_SESSION["vijest_id"] = (int) $_POST["vijest_id"];
    header("Location: ../clanak.php");
    exit();
}
header("Location: ../index.php");
exit();

?>