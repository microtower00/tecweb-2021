
var attivi=true
function switchCss(){
    if(attivi){
        var els = document.getElementsByClassName("custom-number-input")
        while(els.length>0){
            els[0].children[1].disabled=false
            els[0].className="custom-number-input-unloaded"
            //Man mano che cambio la classe gli elementi spariscono da els
        }
    }else{
        var els = document.getElementsByClassName("custom-number-input-unloaded")
        while(els.length>0){
            els[0].children[1].disabled=true
            els[0].className="custom-number-input"
        }
    }
    attivi=!attivi
}

function loaded(){
    var els = document.getElementsByClassName("custom-number-input-unloaded")
    while(els.length>0){
        els[0].children[1].disabled=true
        els[0].className="custom-number-input"
    }
    attivi=true
}

function addOne(idInput){
    document.getElementById(idInput).children[1].value=parseInt(document.getElementById(idInput).children[1].value)+1
}
function removeOne(idInput){
    var val=parseInt(document.getElementById(idInput).children[1].value)
    if(val>0)
        document.getElementById(idInput).children[1].value=val-1
}