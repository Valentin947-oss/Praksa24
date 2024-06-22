document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = document.querySelector('.burger-menu');
    const navList = document.querySelector('.nav-list');

    burgerMenu.addEventListener('click', function () {
        this.classList.toggle('active');
        navList.classList.toggle('active');
    });
});