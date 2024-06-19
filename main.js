function toggleNavbar() {
    var navbarLinks = document.getElementById("nvy");
    var burgerLines = document.querySelectorAll(".line");

    navbarLinks.style.display === "flex" ? navbarLinks.style.display = "none" : navbarLinks.style.display = "flex";

    burgerLines[0].classList.toggle("active1");
    burgerLines[1].classList.toggle("active2");
    burgerLines[2].classList.toggle("active3");
}