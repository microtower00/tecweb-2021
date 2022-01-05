function mostraFieldset(idInput) {
    if (idInput == 'piste-chiuse') {
        document.getElementById(idInput).style.display="block";
        document.getElementById('piste-aperte').style.display="none";
        document.getElementById('impianti-chiusi').style.display="none";
        document.getElementById('impianti-aperti').style.display="none";
    } else if (idInput == 'piste-aperte') {
        document.getElementById(idInput).style.display="block";
        document.getElementById('piste-chiuse').style.display="none";
        document.getElementById('impianti-chiusi').style.display="none";
        document.getElementById('impianti-aperti').style.display="none";
    } else if (idInput == 'impianti-chiusi') {
        document.getElementById(idInput).style.display="block";
        document.getElementById('piste-aperte').style.display="none";
        document.getElementById('piste-chiuse').style.display="none";
        document.getElementById('impianti-aperti').style.display="none";
    } else {
        document.getElementById(idInput).style.display="block";
        document.getElementById('piste-aperte').style.display="none";
        document.getElementById('piste-chiuse').style.display="none";
        document.getElementById('impianti-chiusi').style.display="none";
    }
}