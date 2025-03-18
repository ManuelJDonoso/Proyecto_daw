document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const termsCheckbox = document.getElementById("terms-checkbox");

    // Asegurar que el checkbox esté seleccionado por defecto
    termsCheckbox.checked = true;

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

        // Verificar si el checkbox de términos está marcado
        if (!termsCheckbox.checked) {
            valid = false;
            alert("Debes aceptar los términos y condiciones para continuar.");
        }
        
        if (!valid) {
            event.preventDefault();
            alert("Por favor, completa todos los campos antes de enviar el formulario.");
        }
    });

    document.getElementById("terms-link").addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById("terms-content").classList.toggle("active");
    });
});
