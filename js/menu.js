
function toggleMenu(){
    document.querySelector("#menu ul").classList.toggle("active")
    if(document.querySelector(".pulsanteMenu button").getAttribute("aria-expanded")=="true")
        document.querySelector(".pulsanteMenu button").setAttribute("aria-expanded","false");
    else
        document.querySelector(".pulsanteMenu button").setAttribute("aria-expanded","true");
}

function toggleScrollBtn(){
    const bottoneScroll = document.querySelector(".linkScroll");
    if(window.pageYOffset > 100)
        bottoneScroll.classList.add('active');
    else
        bottoneScroll.classList.remove('active');
}


function mapWithJS(){
    document.getElementById("desc").innerHTML="<p>La mappa è interattiva, andando con il puntatore sopra il numero leggerai il nome della pista o dell'impianto. In aggiunta cliccando su un numero di una pista potrai leggere una piccola descrizione di quest'ultima.</p><p>Se ci fossero problemi e la mappa risulta non accessibile, il comprensorio è facilmente consultabile nella nostra pagina: <a href='comprensorio.php'>Il nostro comprensorio</a></p>";
    
    document.getElementById("mappa").setAttribute("usemap","#mappaValle");
    $('img[usemap]').rwdImageMaps();
}