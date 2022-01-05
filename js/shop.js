
var attivi=false
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
        els[0].className="custom-number-input"
    }
    attivi=true
}

//BOTTONI - e +
function addOne(idInput){
    document.getElementById("form-shop").elements[idInput].value=parseInt(document.getElementById("form-shop").elements[idInput].value)+1
}
function removeOne(idInput){
    var val=parseInt(document.getElementById("form-shop").elements[idInput].value)
    if(val>0)
        document.getElementById("form-shop").elements[idInput].value=val-1
}


function validaForm(){
    console.log(document.getElementById("form-shop").elements["intero"].value)
    if(document.getElementById("form-shop").elements["intero"].value == 0 &&
            document.getElementById("form-shop").elements["ridotto"].value == 0){
        console.log("OOOOOOOOOO")
        document.getElementById("ns-errors").innerText="Aggiungi almeno uno skipass"

        return false
    }
    return true
}