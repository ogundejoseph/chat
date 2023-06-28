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
