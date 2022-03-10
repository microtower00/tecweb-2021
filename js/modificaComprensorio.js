function nascondiForm() {
    document.getElementById('piste-chiuse').style.display="none";
    document.getElementById('piste-aperte').style.display="none";
    document.getElementById('impianti-chiusi').style.display="none";
    document.getElementById('impianti-aperti').style.display="none";
    document.getElementById('cambia-descrizione').style.display="none";
    document.getElementById('cambiaD').disabled=true;
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

        document.getElementById(idInput).focus();
    }
}

function checkDescrizione(){
    var elem = document.getElementById("nuova-descrizione");

    if (elem.value == "") {
        elem.focus();
        document.getElementById('feedback').innerHTML = "Descrizione mancante";
        document.getElementById('feedback').style.display="block";
        document.getElementById('cambiaD').disabled=true;
    } else if (elem.value.length > 500) {
        elem.focus();
        document.getElementById('feedback').innerHTML = "Descrizione troppo lunga";
        document.getElementById('feedback').style.display="block";
        document.getElementById('cambiaD').disabled=true;
    } else {
        document.getElementById('feedback').innerHTML = "";
        document.getElementById('cambiaD').disabled=false;
        document.getElementById('cambiaD').focus();
    }
}
