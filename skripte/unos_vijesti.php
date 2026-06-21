<?php
header('Content-Type: text/html; charset=utf-8');
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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $datum = date('d.m.Y.');
    $puni_naslov = $_POST['puni_naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    $slikaIme = $_FILES['file']['name'];
    $tmpIme = $_FILES['file']['tmp_name'];

    $slikaExtenzija = strtolower(pathinfo($slikaIme, PATHINFO_EXTENSION));
    $novoIme = uniqid() . '.' . $slikaExtenzija;

    move_uploaded_file($tmpIme, 'slike/' . $novoIme);

    $query = "INSERT INTO vijesti
(datum, puni_naslov, sazetak, tekst, slika, kategorija, arhiva)
VALUES
('$datum', '$puni_naslov', '$sazetak', '$tekst', '$novoIme', '$kategorija', '$arhiva')";

       if (!mysqli_query($dbc, $query)) {
        die("Greška: " . mysqli_error($dbc));
    }

    // Uspješan unos - popup i redirect
    echo "<script>alert('Uspješni unos!'); window.location.href='../index.php';</script>";
    exit;
}
