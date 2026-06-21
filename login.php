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
mysqli_set_charset($dbc, "utf8");

$greska = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prijava'])) {
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];

    $sql = "SELECT id, ime, prezime, korisnicko_ime, lozinka, razina FROM korisnici WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $idKorisnika, $imeKorisnika, $prezimeKorisnika, $korisnickoImeKorisnika, $lozinkaKorisnika, $levelKorisnika);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_fetch($stmt);

            if (password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika)) {
                // Uspješna prijava - postavljanje session varijabli
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $idKorisnika;
                $_SESSION['username'] = $korisnickoImeKorisnika;
                $_SESSION['ime'] = $imeKorisnika;
                $_SESSION['prezime'] = $prezimeKorisnika;
                $_SESSION['razina'] = $levelKorisnika;
                $_SESSION['last_activity'] = time();

                // Postavljanje cookie-a za session da traje 12h (43200 sekundi)
                $lifetime = 43200;
                setcookie(session_name(), session_id(), time() + $lifetime, '/');
                header('Location: index.php');
                exit;
            } else {
                $greska = 'Pogrešno korisničko ime ili lozinka!';
            }
        } else {
            $greska = 'Korisnik ne postoji. Molimo registrirajte se. <a href="registracija.php">Registracija</a>';
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($dbc);
}
?>
<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" type="text/css" href="src/reg.css?ver=10">
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>
    <?php include_once('komp/navbar.php'); ?>
      <div class="naslovna" id="login"></div>
    <form action="" method="POST">
        <?php if (!empty($greska)) : ?>
        <div class="greska"><?php echo $greska; ?></div>
        <?php endif; ?>
        <h3>Nemate racun? <a href="registracija.php">Stisnite ovjde!</a></h3>
        <div class="form-item">
            <label for="username">Korisničko ime</label>
            <div class="form-field">
                <input type="text" name="username" id="username" class="form-field-textual" required>
            </div>
        </div>

        <div class="form-item">
            <label for="lozinka">Lozinka</label>
            <div class="form-field">
                <input type="password" name="lozinka" id="lozinka" class="form-field-textual" required>
            </div>
        </div>

        <div class="form-item">
            <button type="submit" name="prijava" value="1">Prijava</button>
        </div>
    </form>
    <script src="js/reg.js"></script>

    <?php include_once('komp/footer.php'); ?>
</body>

</html>

