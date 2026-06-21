<?php
// Osiguravamo da je sesija pokrenuta (ako već nije na stranici koja uključuje navbar)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$prijavljen = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$razina = $prijavljen ? (int)$_SESSION['razina'] : -1;
$imaUredivackePrava = $razina >= 1; // admin (1) ili superadmin (2)
?>
<script>
function openNav() {
    document.getElementById("myNav").style.width = "100%";
    document.body.style.overflow = "hidden";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    document.body.style.overflow = "";
}
</script>
<style>
header {
    width: 100%;
    display: flex;
    flex-direction: column;
    height: fit-content;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    background-color: white;
}

header .logo {
    width: auto;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 15px 0;
}

header .logo img {
    object-fit: contain;
    height: 100%;
    width: 100%;
}

.linija_obicna {
    width: 100%;
    background-color: black;
    opacity: 0.5;
    height: 3px;
    border: 0;
}

.korisnik {
    padding: 25px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.korisnik h3 {
    font-size: 1.4rem;
    opacity: 0.5;
    margin-right: 5px;
}

.korisnik span {
    font-weight: 900;
    font-size: 1.4rem;
}

nav {
    width: 50%;
    margin: 0 auto;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: start;
}

nav a {
    text-decoration: none;
    text-transform: uppercase;
    color: black;
    font-size: 1.2rem;
    padding: 15px;
    transition: 0.25s ease-in-out;
}

nav a:hover {
    opacity: 0.5;
}

.navbar-hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
}

.navbar-hamburger span {
    display: block;
    width: 26px;
    height: 2px;
    background-color: black;
    border-radius: 2px;
    transition: background-color 0.2s;
}

.navbar-hamburger:hover span {
    opacity: 0.5;
}

.nav-overlay {
    height: 100%;
    width: 0%;
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.96);
    overflow-x: hidden;
    transition: width 0.35s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.nav-overlay-zatvori {
    position: absolute;
    top: 20px;
    right: 28px;
    font-size: 48px;
    line-height: 1;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    transition: color 0.2s;
}

.nav-overlay-zatvori:hover {
    opacity: 0.5;
}

.nav-overlay-linkovi {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: center;
}

.nav-overlay-linkovi li {
    margin: 20px 0;
    width: 100%;
}

.nav-overlay-linkovi a {
    color: white;
    font-size: 1.5rem;
    text-decoration: none;
    transition: color 0.2s;
}

@media (max-width: 768px) {
    header {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 16px 32px;
        position: relative;
        z-index: 100;
    }

    .linija_obicna {
        display: none;
    }

    header .logo {
        height: 60px;
    }

    .korisnik {
        display: none;
    }

    nav {
        display: none;
        /* hide desktop nav links entirely */
    }

    hr.linija {
        width: 100%;
        background-color: white;
        height: 2px;
        border-radius: 999px;
    }

    .navbar-hamburger {
        display: flex;
    }
}

@media (max-width: 500px) {
    header .logo {
        height: 50px;
    }

    .nav-overlay-linkovi li {
        margin: 15px 0;
        width: 100%;
    }

    .nav-overlay-linkovi a {
        color: white;
        font-size: 1.4rem;
        text-decoration: none;
        transition: color 0.2s;
    }
}
</style>

<header>
    <div class="logo">
        <img src="https://res.cloudinary.com/dedrawg9e/image/upload/v1781707127/logo_nkzpco.png" alt="Le Monde logo">
    </div>
    <hr class="linija_obicna">
    <?php if ($prijavljen): ?>
    <div class="korisnik">
        <h3>Dobrodošli: </h3><span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
    </div>
    <hr class="linija_obicna">
    <?php endif; ?>
    <nav>
        <a href="index.php">home</a>
        <a href="politika.php">politika</a>
        <a href="sport.php">sport</a>
        <a href="popis_vijesti.php" <?php echo $imaUredivackePrava ? '' : 'hidden'; ?>>Popis vijesti</a>
        <a href="vijesti_forma.php" <?php echo $imaUredivackePrava ? '' : 'hidden'; ?>>Unos clanka</a>
        <a href="registracija.php" <?php echo $prijavljen ? 'hidden' : ''; ?>>Registacija</a>
        <a href="login.php" <?php echo $prijavljen ? 'hidden' : ''; ?>>Login</a>
        <a href="skripte/odjava.php" <?php echo $prijavljen ? '' : 'hidden'; ?>>Odjava</a>
    </nav>
    <!-- Hamburger moved outside nav, directly in header -->
    <button class="navbar-hamburger" aria-label="Otvori navigaciju" onclick="openNav()">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="nav-overlay" id="myNav">
        <button class="nav-overlay-zatvori" onclick="closeNav()" aria-label="Zatvori navigaciju">&times;</button>
        <ul class="nav-overlay-linkovi">
            <li><a><?php if ($prijavljen): ?>
                    <h3>Dobrodošli: </h3><span><?php echo htmlspecialchars($_SESSION['username']); ?></span>

                    <?php endif; ?>
                </a>
            </li>
            <hr class="linija">
            <li><a href="index.php" onclick="closeNav()">Pocetna</a>
            </li>
            <li><a href="politika.php" onclick="closeNav()">Politika</a>
            </li>
            <li><a href="sport.php" onclick="closeNav()">Sport</a>
            </li>
            <?php if ($imaUredivackePrava): ?>
            <li><a href="popis_vijesti.php" onclick="closeNav()">Popis vijesti</a>
            </li>
            <li><a href="vijesti_forma.php" onclick="closeNav()">Unos clanka</a>
            </li>
            <?php endif; ?>
            <?php if (!$prijavljen): ?>
            <li><a href="registracija.php" onclick="closeNav()">Registracija</a>
            </li>
            <li><a href="login.php" onclick="closeNav()">Login</a>
            </li>
            <?php else: ?>
            <li><a href="skripte/odjava.php" onclick="closeNav()">Odjava</a>
            </li>
            <?php endif; ?>
            <hr>
        </ul>
    </div>
</header>