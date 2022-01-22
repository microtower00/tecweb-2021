function nascondiForm() {
    document.getElementById('form-comprensorio').style.display="none";
}

function mostraFieldset(idInput) {
    if (document.getElementById(idInput).style.display=="block") {
        document.getElementById(idInput).style.display="none";
    }else{
        document.getElementById('form-comprensorio').style.display="block";
        document.getElementById('piste-chiuse').style.display="none";
        document.getElementById('piste-aperte').style.display="none";
        document.getElementById('impianti-chiusi').style.display="none";
        document.getElementById('impianti-aperti').style.display="none";
        document.getElementById(idInput).style.display="block";
    }
    
}