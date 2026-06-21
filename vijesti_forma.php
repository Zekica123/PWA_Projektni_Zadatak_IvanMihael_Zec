<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos vijesti</title>
    <link rel="stylesheet" type="text/css" href="src/forme.css?ver=67">
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8pG4yPbcpYeALFpqEcnrMO7y0FQXB3DqjAw2W-5-0OQ&s">
</head>

<body>
    <?php include_once('komp/navbar.php'); ?>
    <form action="skripte/unos_vijesti.php" method="POST" enctype="multipart/form-data">

        <div class="form-item">
            <label for="puni_naslov">Naslov vijesti (do 64 znakova)</label>
            <div class="form-field">
                <input type="text" name="puni_naslov" class="form-field-textual" id="naslov">
            </div>
            <div class="brojac">Broj znakova: <span id="count">0</span></div>
        </div>

        <div class="form-item">
            <label for="kratki_naslov">Kratki sadržaj vijesti</label>
            <div class="form-field">
                <textarea name="sazetak" cols="30" rows="5" class="form-field-textual"></textarea>
            </div>
        </div>

        <div class="form-item">
            <label for="sazetak">Sadržaj vijesti</label>
            <div class="form-field">
                <textarea name="tekst" cols="30" rows="10" class="form-field-textual"></textarea>
            </div>
        </div>

        <div class="form-item">
            <label for="slika">Slika: </label>
            <div class="form-field">
                <input type="file" accept="image/jpg,image/gif" class="input-text" name="file" />
            </div>
        </div>

        <div class="form-item">
            <label for="kategorija">Kategorija vijesti</label>
            <div class="form-field">
                <select name="kategorija" class="form-field-textual">
                    <option value="sport">Sport</option>
                    <option value="politika">Politika</option>
                </select>
            </div>
        </div>

        <div class="form-item">
            <label>Spremiti u arhivu:
                <input type="checkbox" name="arhiva">
            </label>
        </div>

        <div class="form-item">
            <button type="reset">Poništi</button>
            <button type="submit" name="submit">Upload</button>
        </div>

    </form>
    <?php include_once('komp/footer.php'); ?>

    <script src="js/brojacSlova.js"></script>
</body>

</html>