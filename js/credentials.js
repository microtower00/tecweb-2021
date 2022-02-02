var charsPwd = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=.\-_*!?])([a-zA-Z0-9@#$%^&+=*.\-_!?]){8,}$|^$/;
var charsUsr = /^[a-zA-Z0-9_\.]{5,20}$|^$/;
var mailRegex = /^[^@ \t\r\n.;:\\\/\[\]\{\}]+@[^@ \t\r\n.;:\\\/\[\]\{\}]+\.[^@ \t\r\n.;:\\\/\[\]\{\}]+$|^$/;

function checkUsername(){
    //elem.focus() non va!!!
    var elem = document.getElementById("usrInput");
    var validUsername = elem.value.match(charsUsr);

    if(!validUsername){
        elem.focus();
        document.getElementById('error').innerHTML = "Gli usernames possono contenere solo cifre [0-9], lettere [a-z][A-Z], underscores [_] e punti [.]";
        document.getElementById('error').innerHTML+= "\nLo username deve avere una lunghezza compresa tra 5 e 20 caratteri";
        document.getElementById('btnConfirm').disabled=true;
    }else{
        document.getElementById('error').innerHTML = "";
        document.getElementById('btnConfirm').disabled=false;
    }
}

function checkPassword(){
    var elem = document.getElementById("pwdInput");
    var validPwd = elem.value.match(charsPwd);
    if(!validPwd){
        elem.focus();
        document.getElementById('error').innerHTML = "La password deve contenere: una cifra, una lettera maiuscola, una lettera minuscola ed un carattere speciale.";
        document.getElementById('error').innerHTML += "\nLa lunghezza minima é 8 caratteri";
        document.getElementById('btnConfirm').disabled=true;

    }else{
        document.getElementById('error').innerHTML = "";
        document.getElementById('btnConfirm').disabled=false;
    }

}

function checkEmail(){
    var elem = document.getElementById("emailInput")
    var validMail = elem.value.match(mailRegex);
    if(!validMail){
        elem.focus();
        document.getElementById('error').innerHTML = "La mail non é valida. Ricontrollare";
        document.getElementById('btnConfirm').disabled=true;

    }else{
        document.getElementById('error').innerHTML = "";
        document.getElementById('btnConfirm').disabled=false;
    }
}