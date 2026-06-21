<?php

define('UPLPATH', 'slike/');

session_start();

if (!isset($_SESSION["vijest_id"])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_SESSION["vijest_id"];

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



$stmt = $dbc->prepare("SELECT kategorija, puni_naslov, sazetak, tekst, slika FROM vijesti WHERE id = ?");
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
    <title>Update forme</title>
    <link rel="stylesheet" type="text/css" href="src/forme.css?ver=67">
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>
    <?php include_once ('komp/navbar.php') ?>
    <form action="skripte/update.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-item">
            <label for="puni_naslov">Naslov vijesti</label>
            <div class="form-field">
                <input id="naslov" type="text" name="puni_naslov" class="form-field-textual"
                    value="<?php echo htmlspecialchars($row['puni_naslov']); ?>">
            </div>
            <div class="brojac">Broj znakova: <span id="count">0</span></div>
        </div>

        <div class="form-item">
            <label for="sazetak">Kratki sadržaj vijesti</label>
            <div class="form-field">
                <textarea name="sazetak" cols="30" rows="5"
                    class="form-field-textual"><?php echo htmlspecialchars($row['sazetak'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="form-item">
            <label for="tekst">Sadržaj vijesti</label>
            <div class="form-field">
                <textarea name="tekst" cols="30" rows="10"
                    class="form-field-textual"><?php echo htmlspecialchars($row['tekst']); ?></textarea>
            </div>
        </div>

        <div class="form-item">
            <label for="slika">Slika (ostavi prazno za zadržavanje postojeće): </label>
            <div class="form-field">
                <input type="file" accept="image/jpg,image/gif" class="input-text" name="file" />
            </div>
            <?php if (!empty($row['slika'])): ?>
            <p>Trenutna slika: <?php echo htmlspecialchars($row['slika']); ?></p>
            <?php endif; ?>
        </div>

        <div class="form-item">
            <label for="kategorija">Kategorija vijesti</label>
            <div class="form-field">
                <select name="kategorija" class="form-field-textual">
                    <option value="sport" <?php echo ($row['kategorija'] === 'sport') ? 'selected' : ''; ?>>Sport
                    </option>
                    <option value="politika" <?php echo ($row['kategorija'] === 'politika') ? 'selected' : ''; ?>>
                        Politika</option>
                </select>
            </div>
        </div>

        <div class="form-item">
            <label>Spremiti u arhivu:
                <input type="checkbox" name="arhiva"
                    <?php echo (!empty($row['arhiva']) && $row['arhiva'] == 1) ? 'checked' : ''; ?>>
            </label>
        </div>

        <div class="form-item">
            <button type="reset">Poništi</button>
            <button type="submit" name="submit">Spremi promjene</button>
        </div>

    </form>
    <?php include_once('komp/footer.php'); ?>
    <script src="js/brojacSlova.js"></script>
</body>

</html>