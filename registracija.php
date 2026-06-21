<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" type="text/css" href="src/reg.css?ver=67">
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>
    <?php include_once('komp/navbar.php'); ?>
 <div class="naslovna" id="register"></div>
    <form action="skripte/registracija_unos.php" method="POST" enctype="multipart/form-data">
        <!--Ime-->
        <div class="form-item">
            <span id="porukaIme" class="bojaPoruke"></span>
            <label for="ime">Ime</label>
            <div class="form-field">
                <input type="text" name="ime" id="ime" class="form-field-textual">
            </div>
        </div>
        <!--Prezime-->
        <div class="form-item">
            <span id="porukaPrezime" class="bojaPoruke"></span>
            <label for="prezime">Prezime</label>
            <div class="form-field">
                <input type="text" name="prezime" id="prezime" class="form-field-textual">
            </div>
        </div>
        <!--Korisnicko ime-->
        <div class="form-item">
            <span id="porukaUsername" class="bojaPoruke"></span>
            <label for="username">Korisničko ime</label>
            <!-- Ispis poruke nakon provjere korisničkog imena u bazi -->
            <?php if (!empty($msg)) echo '<br><span class="bojaPoruke">' . htmlspecialchars($msg) . '</span>'; ?>
            <div class="form-field">
                <input type="text" name="username" id="username" class="form-field-textual">
            </div>
        </div>
        <!--Lozinka-->
        <div class="form-item">
            <span id="porukaPass" class="bojaPoruke"></span>
            <label for="pass">Lozinka: </label>
            <div class="form-field">
                <input type="password" name="pass" id="pass" class="form-field-textual">
            </div>
        </div>
        <div class="form-item">
            <span id="porukaPassRep" class="bojaPoruke"></span>
            <label for="passRep">Ponovite lozinku: </label>
            <div class="form-field">
                <input type="password" name="passRep" id="passRep" class="form-field-textual">
            </div>
        </div>

        <div class="form-item">
            <button type="reset">Poništi</button>
            <button type="submit" name="submit" id="slanje">Registriraj se!</button>
        </div>

    </form>
    <script src="js/reg.js"></script>
    <?php include_once('komp/footer.php'); ?>
</body>

</html>