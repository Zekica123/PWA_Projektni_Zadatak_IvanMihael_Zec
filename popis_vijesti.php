<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

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
define('UPLPATH', 'skripte/slike/');

// Provjera razine prijavljenog korisnika
$razina = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ? (int)$_SESSION['razina'] : -1;

$mozeEditirati = $razina >= 1; // admin (1) i superadmin (2)
$mozeBrisati = $razina >= 2;   // samo superadmin (2)
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="src/popis.css?ver=68">
    <title>Popis vijesti</title>
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>
    <?php include_once ('komp/navbar.php') ?>
    <div class="popis">
        <?php
                $query = "SELECT * FROM vijesti
                        WHERE arhiva = 0
                        ORDER BY id DESC";

                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="vijest">';
                    echo '<div class="info">';
                    echo '<img src="skripte/slike/' . $row['slika'] . '" alt="">';
                    echo '<p class="sazetak">' . $row['sazetak'] . '</p>';
                    echo '</div>';

                    if ($mozeEditirati || $mozeBrisati) {
                        echo '<div class="gumbovi">';

                        if ($mozeEditirati) {
                            echo '
                                <form method="POST" action="skripte/edit_vijest.php">
                                    <input type="hidden" name="vijest_id" value="' . $row['id'] . '">
                                    <button type="submit" class="edit"></button>
                                </form>';
                        }

                        if ($mozeBrisati) {
                            echo '
                                <form method="POST" action="skripte/brisanje_clanka.php">
                                    <input type="hidden" name="vijest_id" value="' . $row['id'] . '">
                                    <button type="submit" class="delete" onclick="return confirm(\'Jesi siguran da želiš obrisati ovu vijest?\')"></button>
                                </form>';
                        }

                        echo '</div>';
                    }

                    echo '</div>';
                }
                ?>
    </div>
    <?php include_once ('komp/footer.php') ?>
</body>

</html>
