<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

// Provjera autorizacije
$razina = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ? (int)$_SESSION['razina'] : -1;
if ($razina < 1) {
    header("Location: index.php");
    exit();
}

$servername = "sql203.infinityfree.com";
$username   = "if0_42222334";
$password   = ""; //ovdje se inace nalazi sifra, ali zbog sigurnosnih razloga je maknuta
$basename   = "if0_42222334_vijesti";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $dbc = new mysqli($servername, $username, $password, $basename);
    $dbc->set_charset("utf8");
} catch (mysqli_sql_exception $e) {
    die('Greška kod spajanja na MySQL server: [' . $e->getCode() . '] ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
        die("Neispravan ID vijesti.");
    }
    $id = (int)$_POST['id'];
    $datum = date('Y-m-d');

    // Provjera da su svi potrebni POST parametri prisutni
    $puni_naslov = $_POST['puni_naslov'] ?? '';
    $sazetak     = $_POST['sazetak'] ?? '';
    $tekst       = $_POST['tekst'] ?? '';
    $kategorija  = $_POST['kategorija'] ?? '';
    $arhiva      = isset($_POST['arhiva']) ? 1 : 0;

    // Provjera je li uploadana nova slika
    $novaSlika = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK && !empty($_FILES['file']['name'])) {
        $slikaIme = $_FILES['file']['name'];
        $tmpIme = $_FILES['file']['tmp_name'];
        $slikaExtenzija = strtolower(pathinfo($slikaIme, PATHINFO_EXTENSION));
        $dozvoljeneExtenzije = ['jpg', 'jpeg', 'gif', 'png'];

        if (in_array($slikaExtenzija, $dozvoljeneExtenzije)) {
            $novoIme = uniqid() . '.' . $slikaExtenzija;
            if (move_uploaded_file($tmpIme, 'slike/' . $novoIme)) {
                $novaSlika = $novoIme;
            } else {
                die("Greška kod spremanja slike.");
            }
        } else {
            die("Nedozvoljena ekstenzija slike.");
        }
    }

    if ($novaSlika !== null) {
        // Ažuriranje s novom slikom
        $stmt = $dbc->prepare("UPDATE vijesti SET datum = ?, puni_naslov = ?, sazetak = ?, tekst = ?, slika = ?, kategorija = ?, arhiva = ? WHERE id = ?");
        $stmt->bind_param("ssssssii", $datum, $puni_naslov, $sazetak, $tekst, $novaSlika, $kategorija, $arhiva, $id);
    } else {
        // Ažuriranje bez promjene slike
        $stmt = $dbc->prepare("UPDATE vijesti SET datum = ?, puni_naslov = ?, sazetak = ?, tekst = ?, kategorija = ?, arhiva = ? WHERE id = ?");
        $stmt->bind_param("sssssii", $datum, $puni_naslov, $sazetak, $tekst, $kategorija, $arhiva, $id);
    }

    if (!$stmt->execute()) {
        die("Greška: " . $stmt->error);
    }
    $stmt->close();

    // Brisanje session varijable nakon uspješnog update-a
    unset($_SESSION['vijest_id']);

    $dbc->close();
    header("Location: ../popis_vijesti.php");
    exit();
}

$dbc->close();
?>
