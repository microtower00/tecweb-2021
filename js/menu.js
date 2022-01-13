
function toggleMenu(){
    document.querySelector("#menu ul").classList.toggle("active")
}

function toggleScrollBtn(){
    const bottoneScroll = document.querySelector(".linkScroll");
    if(window.pageYOffset > 100)
        bottoneScroll.classList.add('active');
    else
        bottoneScroll.classList.remove('active');
}
