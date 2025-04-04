-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2025 a las 10:28:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_daw`
--
CREATE DATABASE IF NOT EXISTS `proyecto_daw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyecto_daw`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre de la categoría',
  `permitir_crear_temas` tinyint(1) DEFAULT 1 COMMENT 'Indica si se pueden crear temas en esta categoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `permitir_crear_temas`) VALUES
(1, 'Normas del Foro', 0),
(2, 'General', 1),
(4, 'Semillas para para lore de partidas.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Título del evento',
  `description` text NOT NULL COMMENT 'Descripción del evento',
  `master` varchar(255) NOT NULL COMMENT 'Organizador del evento',
  `players` int(11) NOT NULL COMMENT 'Cantidad de asistentes permitidos',
  `date` date NOT NULL COMMENT 'Fecha del evento',
  `time` time NOT NULL COMMENT 'Hora de inicio del evento',
  `end_time` time NOT NULL COMMENT 'Hora de finalización del evento',
  `mode` enum('online','presencial') NOT NULL COMMENT 'Modo del evento (online o presencial)',
  `location` varchar(255) DEFAULT NULL COMMENT 'Ubicación del evento si es presencial',
  `adults` tinyint(1) DEFAULT 0 COMMENT 'Indica si es solo para adultos',
  `image` varchar(255) DEFAULT NULL COMMENT 'Ruta de la Imagen representativa del evento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `description`, `master`, `players`, `date`, `time`, `end_time`, `mode`, `location`, `adults`, `image`) VALUES
(1, 'evento en el futuro cargando una imagen menor de 18 años', '¡Ya llega Mangafest Mérida! El Festival de Cultura Asiática, Videojuegos y Entretenimiento, organizado por el Ayuntamiento de Mérida de la mano de la promotora de eventos BWG, vuelve a IFEME los días 22 y 23 de febrero con lo mejor de la cultura asiática, grandes invitados y una gran selección de actividades ideadas específicamente para las fan', 'manuel', 200, '2027-04-01', '10:00:00', '21:00:00', 'presencial', 'poligo inventado', 0, 'assets/images/uploads/1743505596_67ebc8bc47f73.jpg'),
(2, 'evento en el pasado', '¡Ya llega Mangafest Mérida! El Festival de Cultura Asiática, Videojuegos y Entretenimiento, organizado por el Ayuntamiento de Mérida de la mano de la promotora de eventos BWG, vuelve a IFEME los días 22 y 23 de febrero con lo mejor de la cultura asiática, grandes invitados y una gran selección de actividades ideadas específicamente para las fa...', 'manuel', 100, '2025-02-02', '12:00:00', '19:00:00', 'presencial', 'poligo inventado', 0, 'assets/images/uploads/1743505701_67ebc9255f6b7.jpg'),
(3, 'evento para mayores de 18', '¡Ya llega Mangafest Mérida! El Festival de Cultura Asiática, Videojuegos y Entretenimiento, organizado por el Ayuntamiento de Mérida de la mano de la promotora de eventos BWG, vuelve a IFEME los días 22 y 23 de febrero con lo mejor de la cultura asiática, grandes invitados y una gran selección de actividades ideadas específicamente para las fa...', 'luis', 100, '2026-04-12', '10:00:00', '12:00:00', 'online', NULL, 1, NULL),
(4, 'evento completo', '¡Ya llega Mangafest Mérida! El Festival de Cultura Asiática, Videojuegos y Entretenimiento, organizado por el Ayuntamiento de Mérida de la mano de la promotora de eventos BWG, vuelve a IFEME los días 22 y 23 de febrero con lo mejor de la cultura asiática, grandes invitados y una gran selección de actividades ideadas específicamente para las fa...', 'luis', 2, '2026-04-08', '21:00:00', '22:00:00', 'online', NULL, 0, NULL),
(5, 'evento todos los publicos', '¡Ya llega Mangafest Mérida! El Festival de Cultura Asiática, Videojuegos y Entretenimiento, organizado por el Ayuntamiento de Mérida de la mano de la promotora de eventos BWG, vuelve a IFEME los días 22 y 23 de febrero con lo mejor de la cultura asiática, grandes invitados y una gran selección de actividades ideadas específicamente para las fa...', 'antonio', 4, '2025-06-21', '10:00:00', '12:00:00', 'online', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_eventos`
--

DROP TABLE IF EXISTS `jugadores_eventos`;
CREATE TABLE `jugadores_eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del jugador',
  `fk_eventos` int(11) NOT NULL COMMENT 'Referencia al evento en el que participa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores_eventos`
--

INSERT INTO `jugadores_eventos` (`id`, `nombre`, `fk_eventos`) VALUES
(10, 'jugador1', 1),
(9, 'jugador1', 2),
(11, 'jugador1', 3),
(2, 'manuel', 1),
(3, 'manuel', 2),
(4, 'manuel', 3),
(1, 'manuel', 4),
(5, 'manuel', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `me_gustas`
--

DROP TABLE IF EXISTS `me_gustas`;
CREATE TABLE `me_gustas` (
  `id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL COMMENT 'ID de la publicación que recibe el "Me Gusta"',
  `usuario_id` int(11) NOT NULL COMMENT 'ID del usuario que dio "Me Gusta"',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del "Me Gusta"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `me_gustas`
--

INSERT INTO `me_gustas` (`id`, `publicacion_id`, `usuario_id`, `created_at`) VALUES
(7, 1, 2, '2025-04-02 15:22:13'),
(41, 1, 1, '2025-04-03 09:26:16'),
(45, 2, 1, '2025-04-03 14:39:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

DROP TABLE IF EXISTS `publicaciones`;
CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `tema_id` int(11) NOT NULL COMMENT 'ID del tema al que pertenece',
  `contenido` text NOT NULL COMMENT 'Contenido de la publicación',
  `usuario_id` int(11) NOT NULL COMMENT 'ID del usuario que publicó',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora de la publicación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `tema_id`, `contenido`, `usuario_id`, `created_at`) VALUES
(1, 4, 'yo quiero jugarla', 2, '2025-04-01 11:55:41'),
(2, 4, 'yo también quiero', 3, '2025-04-01 11:57:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'visitante'),
(2, 'jugador'),
(3, 'moderador'),
(4, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

DROP TABLE IF EXISTS `temas`;
CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL COMMENT 'ID de la categoría a la que pertenece',
  `titulo` varchar(255) NOT NULL COMMENT 'Título del tema',
  `contenido` text NOT NULL COMMENT 'Contenido del primer mensaje del tema',
  `usuario_id` int(11) NOT NULL COMMENT 'ID del usuario que creó el tema',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creación del tema',
  `permitir_publicaciones` tinyint(1) DEFAULT 1 COMMENT 'Indica si se permiten respuestas en este tema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `categoria_id`, `titulo`, `contenido`, `usuario_id`, `created_at`, `permitir_publicaciones`) VALUES
(1, 1, 'Normas generales', '1. Respeto y Cortesía\r\n\r\n    Trato Respetuoso: Trata a todos los demás usuarios con respeto y cortesía. No uses lenguaje ofensivo, insultos, o cualquier forma de acoso.\r\n    Diversidad y Aceptación: Acepta y respeta las diferencias de opinión, cultura, género, religión y orientación sexual. Promueve un ambiente inclusivo.\r\n\r\n2. Contenido Apropiado\r\n\r\n    Contenido Legal: No publiques contenido que sea ilegal, incluyendo material pornográfico, violento, o que promueva actividades ilegales.\r\n    Copyright y Derechos de Autor: No publiques contenido que infrinja derechos de autor o propiedad intelectual sin permiso del propietario original.\r\n    Spam y Publicidad: Evita el spam y la publicidad no solicitada. No publiques enlaces o contenido promocional que no esté relacionado con el tema del foro.\r\n\r\n3. Privacidad y Seguridad\r\n\r\n    Información Personal: No compartas información personal tuya o de otros sin su consentimiento explícito. Esto incluye direcciones, números de teléfono, correos electrónicos, etc.\r\n    Seguridad: No publiques contenido que pueda ser considerado como phishing o que pueda comprometer la seguridad de otros usuarios.\r\n\r\n4. Comportamiento en el Foro\r\n\r\n    Publicaciones Relevantes: Asegúrate de que tus publicaciones estén relacionadas con el tema del foro. Evita el off-topic.\r\n    No Duplicar Publicaciones: No publiques el mismo mensaje en múltiples hilos o secciones del foro.\r\n    Firma de Usuario: Si tienes una firma, asegúrate de que no sea excesivamente larga ni contenga contenido ofensivo o inapropiado.\r\n\r\n5. Interacción y Comunicación\r\n\r\n    Diálogo Constructivo: Participa en discusiones de manera constructiva. Evita los debates estériles y trata de aportar valor a las conversaciones.\r\n    Resolución de Conflictos: Si tienes un problema con otro usuario, intenta resolverlo de manera civilizada. Si no puedes, contacta a un moderador.\r\n    Reportar Problemas: Si ves contenido inapropiado o conducta que viola las normas del foro, reporta el problema a los moderadores.\r\n\r\n6. Uso de Imágenes y Multimedia\r\n\r\n    Imágenes Apropiadas: No subas imágenes que sean explícitas, violentas, o que puedan ser consideradas ofensivas.\r\n    Tamaño y Formato: Asegúrate de que las imágenes y otros archivos multimedia estén en un tamaño y formato adecuado para el foro.\r\n\r\n7. Moderación y Administración\r\n\r\n    Respetar a los Moderadores: Los moderadores están aquí para mantener el orden y aplicar las normas. Respetar sus decisiones y siguen sus instrucciones.\r\n    Sanciones: La violación de estas normas puede resultar en advertencias, suspensión temporal o expulsión permanente del foro, dependiendo de la gravedad de la infracción.\r\n\r\n8. Actualizaciones y Cambios\r\n\r\n    Normas en Evolución: Estas normas pueden ser actualizadas o modificadas según sea necesario. Es responsabilidad de los usuarios estar informados sobre los cambios.', 1, '2025-04-01 11:24:09', 0),
(2, 2, 'Presentación', 'Te recomendamos que publiques una presentación en la sección correspondiente. Puedes incluir:\r\n\r\n    Tu nombre (si deseas).\r\n    Un poco sobre ti y tus intereses.\r\n    Por qué te uniste a este foro.', 1, '2025-04-01 11:30:23', 1),
(3, 2, 'dudas o sugerencias', 'Detalle en la Pregunta: Sé lo más específico posible al formular tu pregunta. Incluye detalles relevantes y contexto para que otros usuarios puedan entender mejor tu problema.\r\n\r\nSugerencias Constructivas: Formula tus sugerencias de manera constructiva y respetuosa. Proporciona razones claras y posibles soluciones.\r\nDetalle en la Sugerencia: Sé lo más específico posible al describir tu sugerencia. Incluye cómo crees que mejorará el foro y por qué es importante.', 1, '2025-04-01 11:32:54', 1),
(4, 4, 'El Legado de las Sombras', 'En el antiguo reino de Eldoria, una antigua profecía ha comenzado a cumplirse. Durante siglos, se ha contado que cuando la luna se alinee con las estrellas de la constelación de la Serpiente, un legado oscuro resurgirá de las sombras. Este legado, conocido como \"El Legado de las Sombras\", es un poder antiguo que ha sido sellado durante generaciones para proteger al mundo de sus peligros.\r\nHace poco, una serie de eventos extraños ha comenzado a suceder en Eldoria. Antiguos símbolos han aparecido en las ruinas de un templo olvidado, y se han reportado avistamientos de criaturas que no deberían existir. Los aldeanos hablan en susurros de una presencia oscura que se cierne sobre el reino.\r\nLos jugadores son un grupo de aventureros que han sido reunidos por un misterioso erudito que cree que la profecía está a punto de cumplirse. Él les ha proporcionado una antigua runa que brilla con una luz tenue, y les ha dicho que es la clave para desentrañar el legado oscuro antes de que sea demasiado tarde.\r\nPuntos de partida:\r\n\r\n    El Encuentro Inicial: Los jugadores se reúnen en una taberna conocida como \"El Dragón Dormido\", donde el erudito les revela la profecía y les muestra la runa.\r\n    La Ruina Olvidada: El primer destino es un templo en ruinas en el bosque oscuro de Eldoria, donde los símbolos antiguos han aparecido.\r\n    Criaturas de la Oscuridad: En el camino, los jugadores se enfrentarán a criaturas que han sido corrompidas por el legado oscuro, como lobos con ojos rojos y espectros que vagan por el bosque.\r\n    El Pueblo Amenazado: Un pequeño pueblo cercano al templo ha comenzado a sufrir ataques nocturnos. Los aldeanos están asustados y necesitan ayuda para protegerse.\r\n    El Corazón del Misterio: Dentro del templo, los jugadores encontrarán pistas que los llevarán a un antiguo libro de hechizos y un mapa que indica la ubicación de otros lugares clave en el reino.', 1, '2025-04-01 11:37:19', 0),
(5, 4, 'El Canto del Fénix', 'En el reino de Solaria, una tierra bañada por el sol y conocida por su magia elemental, se ha perdido el equilibrio. Hace décadas, el Fénix, un ser mítico y guardián del equilibrio elemental, desapareció sin dejar rastro. Desde entonces, los elementos han comenzado a descontrolarse: tormentas inesperadas, sequías prolongadas y terremotos han azotado el reino.\r\nLos jugadores son un grupo de aventureros seleccionados por el Consejo de los Elementos, un grupo de sabios y magos que buscan restablecer el equilibrio. El Consejo ha descubierto que el Fénix no ha desaparecido por completo, sino que está atrapado en un ciclo de renacimiento fallido, y su energía se está dispersando en fragmentos por todo el reino.\r\nPuntos de partida:\r\n\r\n    El Encuentro Inicial: Los jugadores son convocados al Templo del Equilibrio, donde el Consejo de los Elementos les revela la situación y les encomienda la misión de encontrar y reunir los fragmentos del Fénix.\r\n    \r\n    La Primera Prueba: El primer fragmento se encuentra en una antigua ciudad desértica, donde un espíritu del fuego está causando estragos. Los jugadores deben enfrentarse al espíritu y recuperar el fragmento.´\r\n\r\n    El Bosque Encantado: Otro fragmento está escondido en el corazón de un bosque encantado, protegido por criaturas mágicas y un druida guardian. Los jugadores deben demostrar su respeto por la naturaleza para obtener el fragmento.\r\n\r\n    El Abismo de Hielo: En una región helada y remota, un fragmento está siendo custodiado por un antiguo guardián de hielo. Los jugadores deben superar los desafíos del frío y resolver un acertijo para recuperarlo.\r\n\r\n    El Templo Subterráneo: El último fragmento se encuentra en un templo subterráneo, donde un culto oscuro intenta aprovechar su poder para sus propios fines. Los jugadores deben infiltrarse y detener al culto antes de que sea demasiado tarde.', 1, '2025-04-01 11:39:31', 1),
(6, 4, 'La Maldición del Espejo Oscuro', 'En el reino de Nocturnia, una tierra conocida por sus antiguas leyendas y misterios, se ha desencadenado una maldición que ha sumido al reino en el caos. La fuente de esta maldición es un antiguo espejo mágico conocido como \"El Espejo Oscuro\", que ha sido robado de su lugar de descanso en el Templo de la Luz.\r\nEl Espejo Oscuro tiene el poder de reflejar y amplificar los peores miedos y deseos de aquellos que lo miran, y su poder ha comenzado a corromper a los habitantes del reino, haciéndolos actuar de manera irracional y violenta. Los aldeanos hablan de visiones perturbadoras y de una presencia oscura que se cierne sobre ellos.\r\n\r\nLos jugadores son un grupo de aventureros elegidos por la Alta Sacerdotisa del Templo de la Luz, quien cree que solo ellos pueden recuperar el Espejo Oscuro y detener la maldición antes de que sea demasiado tarde.\r\n\r\nPuntos de partida:\r\n\r\n    El Encuentro Inicial: Los jugadores son convocados al Templo de la Luz, donde la Alta Sacerdotisa les revela la historia del Espejo Oscuro y les encomienda la misión de recuperarlo.\r\n\r\n    El Bosque Encantado: El primer destino es un bosque encantado donde se ha visto por última vez al ladrón que robó el espejo. Los jugadores deben enfrentarse a criaturas mágicas y resolver acertijos para encontrar pistas sobre el paradero del espejo.\r\n\r\n    La Ciudad Perdida: Los jugadores descubren que el espejo ha sido llevado a una antigua ciudad perdida, donde un culto oscuro lo está usando para aumentar su poder. Los jugadores deben infiltrarse en la ciudad y enfrentarse al culto.\r\n\r\n    El Castillo de la Sombra: El espejo ha sido trasladado a un castillo en ruinas, donde un antiguo vampiro lo está usando para fortalecer su dominio sobre la región. Los jugadores deben superar las defensas del castillo y enfrentarse al vampiro.\r\n\r\n    El Templo de la Luz: Una vez que los jugadores han recuperado el espejo, deben devolverlo al Templo de la Luz para realizar un ritual que lo purifique y detenga la maldición.', 1, '2025-04-01 11:43:07', 1),
(7, 4, 'La Espada Perdida de Avalon', 'En el reino de Avalon, una tierra mítica conocida por su magia y leyendas, se ha perdido una reliquia antigua y poderosa: la Espada de Avalon. Esta espada, forjada por los dioses y dotada de poderes mágicos, ha sido robada de su lugar de descanso en el Castillo de la Colina.\r\nLa Espada de Avalon no es solo una reliquia valiosa; es la única arma capaz de derrotar a la oscuridad que se cierne sobre el reino. Hace décadas, un antiguo mal conocido como el Señor de las Sombras fue sellado por la espada, pero ahora ha comenzado a despertar. Sin la espada, el reino está en peligro.\r\nLos jugadores son un grupo de aventureros elegidos por la Reina de Avalon, quien cree que solo ellos pueden recuperar la espada y detener el despertar del Señor de las Sombras.\r\n\r\nPuntos de partida:\r\n\r\n    El Encuentro Inicial: Los jugadores son convocados al Castillo de la Colina, donde la Reina de Avalon les revela la historia de la Espada de Avalon y les encomienda la misión de recuperarla.\r\n\r\n    El Bosque Encantado: El primer destino es un bosque encantado donde se ha visto por última vez a los ladrones que robaron la espada. Los jugadores deben enfrentarse a criaturas mágicas y resolver acertijos para encontrar pistas sobre el paradero de la espada.\r\n\r\n    La Ciudad Perdida: Los jugadores descubren que la espada ha sido llevada a una antigua ciudad perdida, donde un culto oscuro la está usando para aumentar su poder. Los jugadores deben infiltrarse en la ciudad y enfrentarse al culto.\r\n\r\n    El Castillo de las Sombras: La espada ha sido trasladada a un castillo en ruinas, donde un antiguo vampiro la está usando para fortalecer su dominio sobre la región. Los jugadores deben superar las defensas del castillo y enfrentarse al vampiro.\r\n\r\n    El Templo de la Luz: Una vez que los jugadores han recuperado la espada, deben devolverla al Castillo de la Colina para realizar un ritual que la purifique y detenga el despertar del Señor de las Sombras.', 2, '2025-04-01 15:20:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL COMMENT 'Nombre de usuario único',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre completo',
  `email` varchar(100) NOT NULL COMMENT 'Correo electrónico',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña encriptada',
  `rol_id` int(11) DEFAULT 1 COMMENT 'Rol del usuario (relación con la tabla roles)',
  `reset_token` varchar(255) DEFAULT NULL COMMENT 'token para validar el cambio de contrasena',
  `token_expiracion` datetime DEFAULT NULL COMMENT 'fecha a la que el token deja de ser valido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `nombre`, `email`, `password`, `rol_id`, `reset_token`, `token_expiracion`) VALUES
(1, 'manuel', 'manuel j', 'donperma@gmail.com', '$2y$10$zpuNuYz1dMt6ubGfejSIhuKLknmnFqb6Bl6.dqeI69fgTi/zIEIwa', 4, NULL, NULL),
(2, 'jugador1', 'jugador1', 'jugador@example.com', '$2y$10$ntmxW3fQjRu.iHXCsL6AUu9lxPgOd3wgOn6Pv6u55nM9qymB3.wou', 2, 'f9b1624a933c299d04871faee53e5a14cfb63949be48176aabf9c87c5ac4eb49', '2025-04-04 11:08:14'),
(3, 'jugador2', 'jugador2', 'jugador2@example.com', '$2y$10$Tkagh/ayTUklr7/9z8.AdeV9OD9RZIJp6haYB41/BSNUmsuSmxhwi', 2, NULL, NULL),
(4, 'jugador3', 'jugador3', 'jugador3@example.com', '$2y$10$DBxdcfBtrbrLWkZZjkb.DeLRZVaKG6ko/IY.ca2wytHSf3K.G.yMu', 2, NULL, NULL),
(5, 'moderador', 'moderador', 'moderador@example.com', '$2y$10$IyenvWzOQSoiHL6vIdOxg.SJBqik/GF2n..jNZXod.s47VvlRL1ZS', 3, NULL, NULL),
(6, 'moderador2', 'moderador2', 'moderador2@example.com', '$2y$10$vSHN5Gdmg17ftmemoqX72eKLrLm2W7DuKcAaQUx88NoHQtrfW6GZ6', 3, NULL, NULL),
(7, 'administrador', 'administrador', 'administrador@example.com', '$2y$10$6iIDy8x.vxLYa.wXFGZRBeYQsnefKWVGAK/dzGos5.sSZPnoCRt5W', 4, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadores_eventos`
--
ALTER TABLE `jugadores_eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_jugador_evento` (`nombre`,`fk_eventos`),
  ADD KEY `fk_eventos` (`fk_eventos`);

--
-- Indices de la tabla `me_gustas`
--
ALTER TABLE `me_gustas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publicacion_id` (`publicacion_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tema_id` (`tema_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `usuarios_ibfk_1` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jugadores_eventos`
--
ALTER TABLE `jugadores_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `me_gustas`
--
ALTER TABLE `me_gustas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugadores_eventos`
--
ALTER TABLE `jugadores_eventos`
  ADD CONSTRAINT `fk_eventos` FOREIGN KEY (`fk_eventos`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugadores_eventos_ibfk_1` FOREIGN KEY (`nombre`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `me_gustas`
--
ALTER TABLE `me_gustas`
  ADD CONSTRAINT `me_gustas_ibfk_1` FOREIGN KEY (`publicacion_id`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `me_gustas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `temas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publicaciones_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
