<?php
session_start();
define('UPLPATH', 'img/');

if (!isset($_SESSION["vijest_id"])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_SESSION["vijest_id"];

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


$stmt = $dbc->prepare("SELECT kategorija, puni_naslov, tekst, slika, datum FROM vijesti WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
$dbc->close();
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['puni_naslov']); ?></title>
    <link rel="stylesheet" type="text/css" href="src/clanak.css?ver=67">
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>
    <?php include_once ('komp/navbar.php') ?>

    <article>
        <?php if ($row) { ?>

        <section class="detalji">
            <h4><?php echo htmlspecialchars($row['kategorija']); ?></h4>
            <h4><?php echo htmlspecialchars($row['datum']); ?></h4>
        </section>

        <h1 class="vijest-naslov">
            <?php echo htmlspecialchars($row['puni_naslov']); ?>
        </h1>

        <img class="vijest-slika" src="skripte/slike/<?php echo htmlspecialchars($row['slika']); ?>"
            alt="Slika vijesti">

        <div class="vijest-paragraf">
            <?php echo nl2br(htmlspecialchars($row['tekst'])); ?>
        </div>

        <?php } else { ?>

        <p class="greska">Vijest nije pronađena.</p>

        <?php } ?>
    </article>

    <?php include_once ('komp/footer.php') ?>


</body>

</html>
