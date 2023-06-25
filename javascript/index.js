const form = document.querySelector("nav"),
showMenu = form.querySelector("#sm"),
hideMenu = form.querySelector("#hm");

var navLinks = form.querySelector("#navLinks");
showMenu.onclick = ()=>{
    navLinks.style.right = "0";
}
hideMenu.onclick = ()=>{
    navLinks.style.right = "-200px";
}

// Prevent scrolling to the right
document.addEventListener('scroll', function(event) {
  
    var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    
    if (scrollLeft > 0) {
        window.scrollTo(0, window.pageYOffset);
    }
});

document.addEventListener('touchmove', function(event) {

    var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft; 

    if (scrollLeft > 0) {
        event.preventDefault();
    }  
  }, { passive: false });


document.addEventListener('touchmove', function(event) {
    if (event.touches[0].clientX >= 0) {
        event.preventDefault();
    }
});

document.addEventListener('touchmove', function(event) {
    if(document.style.touch-action == "pan-right"){
        event.preventDefault();
    }

});