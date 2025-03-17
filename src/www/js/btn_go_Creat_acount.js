document.addEventListener('DOMContentLoaded', function() {
    const link_btn_creat_acount = document.querySelectorAll('.btn_go_Creat_acount');
    const content = document.querySelector('main');

    link_btn_creat_acount.forEach(link => {
        link.addEventListener('click', async (event) => {
            event.preventDefault();
            const pageUrl = event.target.href; // Obtener la URL de la página

            try {
                const response = await fetch(pageUrl,{cache: 'no-cache'});
                if (!response.ok) throw new Error(`Error ${response.status}: No se pudo cargar la página`);

                const html = await response.text();
                content.innerHTML = html; // Cargar el contenido en el `<main>`

                ejecutarScripts(content); // Ejecutar scripts si los hay

            } catch (error) {
                console.error("Error al cargar la página:", error);
                content.innerHTML = `<p>Error al cargar la página.</p>`;
            }
        });
    });

    // Función para ejecutar scripts dentro del contenido cargado
    function ejecutarScripts(elemento) {
        elemento.querySelectorAll("script").forEach(script => {
            let newScript = document.createElement("script");
            if (script.src) {
                newScript.src = script.src;
                newScript.async = true;
            } else {
                newScript.textContent = script.textContent;
            }
            document.body.appendChild(newScript);
        });
    }
});

