<?php
session_start();
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
mysqli_set_charset($dbc, "utf8");

// Provjera trajanja sesije - 12h
$lifetime = 43200;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $lifetime)) {
    // Sesija istekla
    session_unset();
    session_destroy();
    header('Location: ../login.php');
    exit;
}
$_SESSION['last_activity'] = time();

// Provjera je li korisnik prijavljen
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo '<p>Morate se prijaviti. <a href="../login.php">Prijava</a> ili <a href="../registracija.php">Registracija</a></p>';
    exit;
}

// Provjera razine - administrator
if ($_SESSION['razina'] == 1) {
    // Prikaz administracijske stranice
    $query = "SELECT * FROM vijesti";
    $result = mysqli_query($dbc, $query);

    echo '<h1>Administracija</h1>';
    while ($row = mysqli_fetch_array($result)) {
        // forma za administraciju
        echo '<p>' . htmlspecialchars($row['naslov']) . '</p>';
    }
} else {
    echo '<p>Bok ' . htmlspecialchars($_SESSION['ime']) . '! Uspješno ste prijavljeni, ali nemate administratorska prava.</p>';
}