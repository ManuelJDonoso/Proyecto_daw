document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".nav__link");
    const content = document.getElementById("content");

    links.forEach((link) => {
      link.addEventListener("click", function (event) {
        event.preventDefault(); // Evita que el enlace recargue la página
        const page = this.getAttribute("data-page");

        // Realizar la petición AJAX
        fetch(page)
          .then((response) => response.text())
          .then((html) => {
            content.innerHTML = html; // Cargar el contenido en el <main>
          })
          .catch((error) =>
            console.error("Error al cargar la página:", error)
          );
      });
    });
  });

  document
    .getElementById("menuToggle")
    .addEventListener("click", function () {
      document
        .getElementById("menuList")
        .classList.toggle("nav__list--active");
    });