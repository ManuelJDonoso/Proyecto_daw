<div class="container-gestion">
    <h2 class="title">Eliminar  usuarios</h2>

    <div class="filters">
        <input
            type="text"
            id="filter-username"
            class="filters__input"
            placeholder="Filtrar por usuario" />
        <input
            type="text"
            id="filter-name"
            class="filters__input"
            placeholder="Filtrar por nombre" />
        <input
            type="text"
            id="filter-email"
            class="filters__input"
            placeholder="Filtrar por email" />
    </div>

    <div class="table-container">
        <table class="user-table">
            <thead>
                <tr>
                  
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Ación</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                <!-- Aquí se insertarán las filas con JavaScript -->
            </tbody>
        </table>
    </div>


</div><script src="js/delete_user.js"></script>
