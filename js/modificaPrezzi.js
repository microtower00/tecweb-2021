
function caricaPrezzo(){
    var tipo=document.getElementById('form-mod').elements['tipo'].value
    var durata=document.getElementById('form-mod').elements['durata'].value
    
    document.getElementById('form-mod').elements['nuovo-prezzo'].value = document.getElementById(tipo+'-'+durata).innerText.replace(',','.')
}