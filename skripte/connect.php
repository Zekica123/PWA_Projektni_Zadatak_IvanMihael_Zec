<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "sql203.infinityfree.com";
$username   = "if0_42222334";
$password   = "lcHD7lmGghsihY"; // ovo mora biti pravi password iz panela
$basename   = "if0_42222334_vijesti";

// Uključi mysqli error reporting da baca exceptione
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $dbc = new mysqli($servername, $username, $password, $basename);
    $dbc->set_charset("utf8");
} catch (mysqli_sql_exception $e) {
    die('Greška kod spajanja na MySQL server: [' . $e->getCode() . '] ' . $e->getMessage());
}

define('UPLPATH', 'skripte/slike/');
?>