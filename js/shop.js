
var attivi=false
var prezzi

function switchCss(){
    if(attivi){
        var els = document.getElementsByClassName("custom-number-input")
        while(els.length>0){
            els[0].children[1].readOnly=false
            els[0].children[1].onfocus=null
            els[0].className="custom-number-input-unloaded"
            //Man mano che cambio la classe gli elementi spariscono da els
        }
    }else{
        var els = document.getElementsByClassName("custom-number-input-unloaded")
        while(els.length>0){
            els[0].children[1].readOnly=true
            els[0].children[1].onfocus=function(){this.blur();}
            els[0].className="custom-number-input"
        }
    }
    attivi=!attivi
}

//ATTIVA IL NUMBER INPUT CON I BOTTONI
function loaded(){
    var els = document.getElementsByClassName("custom-number-input-unloaded")
    while(els.length>0){
        els[0].children[1].readOnly=true
        els[0].children[1].onfocus=function(){this.blur();}
        els[0].children[1].tabIndex=-1
        
        els[0].className="custom-number-input"
    }
    attivi=true




    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        prezzi=JSON.parse(this.responseText)
    }
    xhttp.open("GET", "php_vari/prezziSkipassJson.php", true);
    xhttp.send();
}

//BOTTONI - e +
function addOne(idInput){
    document.getElementById("form-shop").elements[idInput].value=parseInt(document.getElementById("form-shop").elements[idInput].value)+1
    calcolaPrezzo()
}
function removeOne(idInput){
    var val=parseInt(document.getElementById("form-shop").elements[idInput].value)
    if(val>0){
        document.getElementById("form-shop").elements[idInput].value=val-1
        calcolaPrezzo()
    }
}


function validaForm(){
    if(document.getElementById("form-shop").elements["intero"].value == 0 &&
            document.getElementById("form-shop").elements["ridotto"].value == 0){
        document.getElementById("ns-errors").innerText="Aggiungi almeno uno skipass"

        return false
    }
    return true
}

function calcolaPrezzo(){
    var durata= document.getElementById("form-shop").elements['durata'].value
    var n_int = document.getElementById("form-shop").elements["intero"].value
    var n_rid = document.getElementById("form-shop").elements["ridotto"].value

    var p_int=0,p_rid=0
    p_int=prezzi['Intero'][durata]
    p_rid=prezzi['Ridotto'][durata]

    var prezzo =n_int*p_int + n_rid*p_rid

    document.getElementById('prezzo-corrente').innerText= isNaN(prezzo) ? "--" : prezzo
    
}