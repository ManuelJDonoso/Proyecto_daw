document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let valid = true;
        const inputs = form.querySelectorAll("input[type='text'], input[type='email'], input[type='password']");
        
        inputs.forEach(input => {
            if (input.value.trim() === "") {
                valid = false;
                input.classList.add("error");
            } else {
                input.classList.remove("error");
            }
        });
        
        const pass = form.querySelector("input[name='pass']");
        const passSecure = form.querySelector("input[name='pass_secure']");
        
        if (pass.value !== passSecure.value) {
            valid = false;
            alert("Las contraseñas no coinciden");
        }
        
        if (!valid) {
            event.preventDefault();
            alert("Por favor, completa todos los campos antes de enviar el formulario.");
        }
    });
});
