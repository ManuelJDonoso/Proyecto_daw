document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("user-table-body");
    const filterUsername = document.getElementById("filter-username");
    const filterName = document.getElementById("filter-name");
    const filterEmail = document.getElementById("filter-email");
 
   
    let users = [];

    // Función para obtener usuarios desde el servidor
    function fetchUsers() {
        fetch("controllers/fetch_users.php")
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
                <td>${user.nombre_usuario}</td>
                <td>${user.nombre}</td>
                <td>${user.email}</td>
                <td>
                    <button class="delete-button" data-id="${user.id}">Eliminar</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
        
        // Agregar evento a los botones de eliminación
        document.querySelectorAll(".delete-button").forEach(button => {
            button.addEventListener("click", function () {
                const userId = this.getAttribute("data-id");
                deleteUser(userId);
            });
        });
    }

    // Función para eliminar usuario
    function deleteUser(userId) {
        if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
            fetch("controllers/delete_user.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: userId })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchUsers(); // Recargar la lista después de eliminar
            })
            .catch(error => console.error("Error al eliminar usuario:", error));
        }
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

    // Event listeners
    filterUsername.addEventListener("input", filterTable);
    filterName.addEventListener("input", filterTable);
    filterEmail.addEventListener("input", filterTable);

    // Cargar datos al inicio
    fetchUsers();
});
