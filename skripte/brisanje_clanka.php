<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

// Provjera autorizacije - samo razina 2 (superadmin) može brisati
$razina = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ? (int)$_SESSION['razina'] : -1;

if ($razina < 2) {
    header("Location: ../index.php");
    exit();
}

// Provjera da je ID poslan
if (!isset($_POST['vijest_id']) || !ctype_digit($_POST['vijest_id'])) {
    header("Location: ../popis_vijesti.php");
    exit();
}

$id = (int)$_POST['vijest_id'];

$servername = "sql203.infinityfree.com";
$username   = "if0_42222334";
$password   = ""; //ovdje se inace nalazi sifra, ali zbog sigurnosnih razloga je maknuta
$basename   = "if0_42222334_vijesti";

// Uključi mysqli error reporting da baca exceptione
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $dbc = new mysqli($servername, $username, $password, $basename);
    $dbc->set_charset("utf8");
} catch (mysqli_sql_exception $e) {
    die('Greška kod spajanja na MySQL server: [' . $e->getCode() . '] ' . $e->getMessage());
}

$dbc->set_charset("utf8");

// Prepared statement za sigurno brisanje
$stmt = $dbc->prepare("DELETE FROM vijesti WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$dbc->close();

header("Location: ../popis_vijesti.php");
exit();
?>
