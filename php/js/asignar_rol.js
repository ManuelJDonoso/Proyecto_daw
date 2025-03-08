document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("user-table-body");
    const filterUsername = document.getElementById("filter-username");
    const filterName = document.getElementById("filter-name");
    const filterEmail = document.getElementById("filter-email");
    const saveButton = document.getElementById("save-button");
   
    let users = [];

    // Función para obtener usuarios desde el servidor
    function fetchUsers() {
       
        fetch("requires/fetch_users.php")
            .then(response => response.json())
            .then(data => {
                users = data;
                renderTable(users);
                
            })
            .catch(error => console.error("Error al obtener usuarios:", error));
            
    }

    // Función para renderizar la tabla (SIN mostrar ID)
    function renderTable(data) {
        tableBody.innerHTML = "";
        data.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.nombre_usuario}</td>  <!-- Se añadió la columna Usuario -->
                <td>${user.nombre}</td>
                <td>${user.email}</td>
                <td>
                    <select class="role-select" data-id="${user.id}">
                        <option value="administrador" ${user.rol === "administrador" ? "selected" : ""}>Administrador</option>
                        <option value="jugador" ${user.rol === "jugador" ? "selected" : ""}>Jugador</option>
                        <option value="moderador" ${user.rol === "moderador" ? "selected" : ""}>Moderador</option>
                    </select>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Función para filtrar la tabla
    function filterTable() {
        const usernameValue = filterUsername.value.toLowerCase();
        const nameValue = filterName.value.toLowerCase();
        const emailValue = filterEmail.value.toLowerCase();

        const filteredUsers = users.filter(user =>
            user.nombre_usuario.toLowerCase().includes(usernameValue) &&
            user.nombre.toLowerCase().includes(nameValue) &&
            user.email.toLowerCase().includes(emailValue)
        );

        renderTable(filteredUsers);
    }

    // Guardar cambios de roles
    function saveChanges() {
        const roleSelects = document.querySelectorAll(".role-select");
        const updates = [];

        roleSelects.forEach(select => {
            updates.push({
                id: select.getAttribute("data-id"),
                rol: select.value
            });
        });

        fetch("requires/update_user.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ users: updates })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => console.error("Error al guardar cambios:", error));
    }

    // Event listeners
    filterUsername.addEventListener("input", filterTable);
    filterName.addEventListener("input", filterTable);
    filterEmail.addEventListener("input", filterTable);
    saveButton.addEventListener("click", saveChanges);

    // Cargar datos al inicio
   fetchUsers();
});

