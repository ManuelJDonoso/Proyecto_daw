<div class="container-gestion">
    <h2 class="title">Asignar rol a usuarios</h2>

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
                    <th style="display: none">ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                <!-- Aquí se insertarán las filas con JavaScript -->
            </tbody>
        </table>
    </div>

    <button id="save-button" class="button">Guardar Cambios</button>
</div>
<script src="js/assing_role.js"></script>
