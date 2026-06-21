<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

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
define('UPLPATH', 'skripte/slike/');
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Monde - Politika</title>
    <link rel="stylesheet" type="text/css" href="src/kategorija.css?ver=67">
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>
    <?php include_once ('komp/navbar.php') ?>
    <div class="popis">
        <?php
                $query = "SELECT * FROM vijesti
                        WHERE arhiva = 0
                        AND kategorija = 'politika'
                        ORDER BY id DESC";

                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<article>';
                    // slika
                    echo '<img src="skripte/slike/' . $row['slika'] . '" alt="">';
        
                    echo '
                    <form method="POST" action="skripte/id_vijesti.php">
                        <input type="hidden" name="vijest_id" value="' . $row['id'] . '">
                        <button type="submit" >
                        <p>' . $row['sazetak'] . '</p>
                        </button>
                    </form>';
            
                    echo '</article>';
                }
                ?>
    </div>
    <?php include_once ('komp/footer.php') ?>

</body>

</html>
