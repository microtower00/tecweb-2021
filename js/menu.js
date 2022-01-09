//const bottoneMenu = document.getElementsByClassName("pulsanteMenu")[0];

document.getElementsByClassName("pulsanteMenu")[0].addEventListener('click', () => {
    document.querySelector("#menu ul").classList.toggle("active")
})