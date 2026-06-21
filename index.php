<?php

session_start();
header('Content-Type: text/html; charset=utf-8');

$servername = "sql203.infinityfree.com";
$username   = "if0_42222334";
$password   = "lcHD7lmGghsihY"; 
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
    <title>Le Monde - Početna</title>
    <link rel="stylesheet" type="text/css" href="src/index.css?ver=67">
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>

    <?php include_once('komp/navbar.php'); ?>

    <div class="vijesti">
        <hr>
        <h2>Politika</h2>
        <section class="politika">
            <?php
                $query = "SELECT * FROM vijesti
                        WHERE arhiva = 0
                        AND kategorija = 'politika'
                        ORDER BY id DESC
                        LIMIT 3";

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
        </section>

        <hr>
        <h2>Sport</h2>
        <section class="sport">
            <?php
                $query = "SELECT * FROM vijesti
                        WHERE arhiva = 0
                        AND kategorija = 'sport'
                        ORDER BY id DESC
                        LIMIT 3";

                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<article>';

                    // slika
                    echo '<img src="skripte/slike/' . $row['slika'] . '" alt="">';

                    // samo sažetak je link
        
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
        </section>

        <hr>
    </div>

    <?php include_once('komp/footer.php');?>

</body>

</html>
