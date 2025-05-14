
# Crónicas de Mérida

**Crónicas de Mérida** es una aplicación web diseñada para apoyar a comunidades de juegos de rol de mesa. Ofrece funcionalidades como foros, gestión de materiales, solicitudes de ayuda y control de usuarios, todo ello dentro de una arquitectura MVC simplificada y con control de acceso basado en roles.

## Índice

- [Características Principales](#características-principales)
- [Arquitectura del Sistema](#arquitectura-del-sistema)
- [Roles de Usuario](#roles-de-usuario)
- [Subsistemas Principales](#subsistemas-principales)
- [Esquema de la Base de Datos](#esquema-de-la-base-de-datos)
- [Guía de Desarrollo](#guía-de-desarrollo)
- [Licencia](#licencia)

## Características Principales

- **Foro estructurado**: Categorías, temas y publicaciones para fomentar la discusión.
- **Gestión de materiales**: Inventario, préstamos y administración de recursos.
- **Sistema de ayuda**: Solicitudes de asistencia y respuestas por parte de moderadores.
- **Notificaciones**: Alertas para usuarios sobre eventos y actualizaciones.
- **Diseño responsivo**: Adaptado para dispositivos móviles, tabletas y escritorios.

## Arquitectura del Sistema

El sistema sigue una arquitectura MVC simplificada:

- **Modelo**: Manejo de datos y lógica de negocio.
- **Vista**: Interfaz de usuario y presentación.
- **Controlador**: Gestión de las solicitudes y coordinación entre modelo y vista.

El archivo `index.php` actúa como enrutador central, dirigiendo las solicitudes basadas en el parámetro `pag`.

## Roles de Usuario

El sistema implementa un control de acceso basado en roles jerárquico:

| Rol          | Nivel de Acceso | Capacidades Principales                                     |
|--------------|-----------------|-------------------------------------------------------------|
| Visitante    | Mínimo          | Ver contenido público, registrarse                          |
| Jugador      | Básico          | Participar en eventos, usar el foro, solicitar materiales   |
| Moderador    | Extendido       | Moderar foros, gestionar eventos y solicitudes de ayuda     |
| Administrador| Completo        | Gestionar usuarios, roles y materiales                      |

## Subsistemas Principales

### Sistema de Enrutamiento

Todas las solicitudes pasan por `index.php`, que determina la vista adecuada según el parámetro `pag`. También verifica los permisos del usuario antes de cargar páginas restringidas.

### Gestión de Usuarios

- Registro y autenticación de usuarios.
- Recuperación de contraseñas vía correo electrónico.
- Gestión de perfiles y roles de usuario.

### Foro

- Organización jerárquica: categorías → temas → publicaciones.
- Funcionalidades de creación, edición y eliminación de contenido.
- Moderación por parte de usuarios con roles adecuados.

### Gestión de Materiales

- Inventario de materiales disponibles.
- Registro de préstamos y devoluciones.
- Administración de recursos por parte de administradores.

### Sistema de Ayuda

- Los usuarios pueden enviar solicitudes de ayuda.
- Los moderadores pueden responder y gestionar estas solicitudes.
- Seguimiento del estado de cada solicitud.

## Esquema de la Base de Datos

La aplicación utiliza una base de datos MySQL con las siguientes vistas destacadas:

- `vista_material_disponible`: Muestra los materiales disponibles.
- `vista_material_alquilado`: Muestra los materiales actualmente prestados.
- `vista_historial_material`: Historial de préstamos de materiales.
- `vista_mensaje_help`: Solicitudes de ayuda con información del usuario.
- `vista_notificacion_procesando`: Notificaciones activas en proceso.

## Guía de Desarrollo

### Requisitos Previos

- PHP 7.4 o superior
- Servidor web (por ejemplo, Apache o Nginx)
- MySQL 5.7 o superior

### Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/ManuelJDonoso/Proyecto_daw.git
   ```

2. Configurar la base de datos:

   - Crear una base de datos en MySQL.
   - Importar el archivo `ddbb_proyecto_daw.sql` ubicado en `src/sql/`.

3. Configurar la conexión a la base de datos:

   - Editar el archivo `src/www/config/conexion.php` con las credenciales de la base de datos.

4. Configurar el servidor web:

   - Asegurarse de que el servidor web apunte al directorio `src/www/`.

5. Acceder a la aplicación:

   - Abrir el navegador y navegar a `http://localhost/index.php`.

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](LICENSE).

---

Este `README.md` proporciona una visión general del proyecto **Crónicas de Mérida**. Para más detalles sobre la arquitectura y los subsistemas, consulta la documentación completa en [github wiki](https://github.com/ManuelJDonoso/Proyecto_daw/wiki).
