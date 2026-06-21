<style>
footer {
    margin-top: 25px;
    background-color: #0d0d0d;
    color: #f2f2f2;
    padding: 60px 40px 30px;
}

footer .footer-inner {
    width: 90%;
    max-width: 1100px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

footer .tvz {
    display: flex;
    justify-content: center;
}

footer .tvz img {
    object-fit: contain;
    height: 70px;
    filter: brightness(0) invert(1);
}

footer nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 28px;
    margin: 35px 0;
}

footer nav a {
    color: #f2f2f2;
    text-decoration: none;
    font-size: 0.95rem;
    opacity: 0.75;
    transition: opacity 0.2s ease;
}

footer nav a:hover {
    opacity: 1;
}

footer hr {
    width: 100%;
    height: 1px;
    border: 0;
    background-color: #ffffff;
    opacity: 0.15;
    margin: 0;
}

footer .info {
    padding-top: 25px;
    font-size: 0.95rem;
    opacity: 0.8;
}

footer .info p {
    margin: 4px 0;
}

footer .info a {
    color: #f2f2f2;
    text-decoration: none;
}

footer .info a:hover {
    text-decoration: underline;
}

@media (max-width: 700px) {
    footer {
        padding: 40px 20px 20px;
    }
    footer nav {
        gap: 18px;
        margin: 25px 0;
    }
}
</style>

<footer>
    <div class="footer-inner">
        <a class="tvz" href="https://www.tvz.hr/">
            <img src="https://www.tvz.hr/wp-content/uploads/2022/01/tvz-znak-logo.svg" alt="Tvz logo">
        </a>

        <nav>
            <a href="index.php">Početna</a>
            <a href="sport.php">Sport</a>
            <a href="politika.php">Politika</a>
            <a href="login.php">Prijava</a>
            <a href="registracija.php">Registracija</a>
        </nav>

        <hr>

        <div class="info">
            <p>Kolegij: Programiranje Web Aplikacija</p>
            <p>Student: <a href="https://www.instagram.com/ivanmihaelzec/">Ivan Mihael Zec</a></p>
        </div>
    </div>
</footer>