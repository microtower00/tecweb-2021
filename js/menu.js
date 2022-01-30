
function toggleMenu(){
    document.querySelector("#menu ul").classList.toggle("active")
    if(document.querySelector(".pulsanteMenu a").getAttribute("aria-expanded")=="true")
        document.querySelector(".pulsanteMenu a").setAttribute("aria-expanded","false");
    else
        document.querySelector(".pulsanteMenu a").setAttribute("aria-expanded","true");
}

function toggleScrollBtn(){
    const bottoneScroll = document.querySelector(".linkScroll");
    if(window.pageYOffset > 100)
        bottoneScroll.classList.add('active');
    else
        bottoneScroll.classList.remove('active');
}


function mapWithJS(){
    document.getElementById("desc").innerHTML="La mappa è interattiva, andando con il puntatore sopra il numero leggerai il nome della pista o dell'impianto. \nIn aggiunta cliccando su un numero di una pista potrai leggere una piccola descrizione di quest'ultima."
    
    //Non funziona, cambia il valore e aggiunge i link, ma i link sono in posizione sbalgiata
    document.getElementById("mappa").setAttribute("usemap","#mappaValle")
    $('img[usemap]').rwdImageMaps();
}