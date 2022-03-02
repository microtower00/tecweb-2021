function nascondiForm() {
    document.getElementById('piste-chiuse').style.display="none";
    document.getElementById('piste-aperte').style.display="none";
    document.getElementById('impianti-chiusi').style.display="none";
    document.getElementById('impianti-aperti').style.display="none";
    document.getElementById('cambia-descrizione').style.display="none";
}

function mostraFieldset(idInput) {
    document.getElementById('feedback').style.display="none";
    if (document.getElementById(idInput).style.display=="block") {
        document.getElementById(idInput).style.display="none";
    }else{
        document.getElementById('piste-chiuse').style.display="none";
        document.getElementById('piste-aperte').style.display="none";
        document.getElementById('impianti-chiusi').style.display="none";
        document.getElementById('impianti-aperti').style.display="none";
        document.getElementById('cambia-descrizione').style.display="none";
        document.getElementById(idInput).style.display="block";
    }
    
}