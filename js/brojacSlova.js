const naslov = document.getElementById("naslov");
const brojac = document.getElementById("count");

naslov.addEventListener('input', () => {
    const duljina = naslov.value.length;
    brojac.innerText = duljina;

    if (duljina > 64) {
        brojac.style.color = "red";
    } else {
        brojac.style.color = "";
    }
});