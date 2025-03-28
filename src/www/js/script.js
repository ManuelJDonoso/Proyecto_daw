document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('menu-list').classList.toggle('active');
});

document.querySelectorAll('.submenu-toggle').forEach(toggle => {
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle('active');
    });
});


/** */

document.addEventListener("DOMContentLoaded", function () {
    const menu = document.querySelector(".menu");
    const header = document.querySelector("header");
    const offsetTop = header.offsetHeight;

    window.addEventListener("scroll", function () {
        if (window.scrollY >= offsetTop) {
            menu.classList.add("sticky");
        } else {
            menu.classList.remove("sticky");
        }
    });
});