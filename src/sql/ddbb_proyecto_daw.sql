-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2025 
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

-- Tabla de categorías de los temas
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL COMMENT 'Identificador único de la categoría',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre de la categoría',
  `permitir_crear_temas` tinyint(1) DEFAULT 1 COMMENT 'Indica si se pueden crear temas en esta categoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Tabla de eventos
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del evento',
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

-- --------------------------------------------------------

-- Tabla de relación entre jugadores y eventos
DROP TABLE IF EXISTS `jugadores_eventos`;
CREATE TABLE `jugadores_eventos` (
  `id` int(11) NOT NULL COMMENT 'Identificador único',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del jugador',
  `fk_eventos` int(11) NOT NULL COMMENT 'Referencia al evento en el que participa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Tabla de "Me Gusta" en publicaciones
DROP TABLE IF EXISTS `me_gustas`;
CREATE TABLE `me_gustas` (
  `id` int(11) NOT NULL COMMENT 'Identificador único',
  `publicacion_id` int(11) NOT NULL COMMENT 'ID de la publicación que recibe el "Me Gusta"',
  `usuario_id` int(11) NOT NULL COMMENT 'ID del usuario que dio "Me Gusta"',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del "Me Gusta"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Tabla de publicaciones en los temas
DROP TABLE IF EXISTS `publicaciones`;
CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL COMMENT 'Identificador único de la publicación',
  `tema_id` int(11) NOT NULL COMMENT 'ID del tema al que pertenece',
  `contenido` text NOT NULL COMMENT 'Contenido de la publicación',
  `usuario_id` int(11) NOT NULL COMMENT 'ID del usuario que publicó',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora de la publicación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Tabla de roles de los usuarios
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del rol',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Datos iniciales de la tabla roles
INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'visitante'),
(2, 'jugador'),
(3, 'moderador'),
(4, 'administrador');

-- --------------------------------------------------------

-- Tabla de temas del foro
DROP TABLE IF EXISTS `temas`;
CREATE TABLE `temas` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del tema',
  `categoria_id` int(11) NOT NULL COMMENT 'ID de la categoría a la que pertenece',
  `titulo` varchar(255) NOT NULL COMMENT 'Título del tema',
  `contenido` text NOT NULL COMMENT 'Contenido del primer mensaje del tema',
  `usuario_id` int(11) NOT NULL COMMENT 'ID del usuario que creó el tema',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creación del tema',
  `permitir_publicaciones` tinyint(1) DEFAULT 1 COMMENT 'Indica si se permiten respuestas en este tema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Tabla de usuarios del sistema
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del usuario',
  `nombre_usuario` varchar(50) NOT NULL COMMENT 'Nombre de usuario único',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre completo',
  `email` varchar(100) NOT NULL COMMENT 'Correo electrónico',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña encriptada',
  `rol_id` int(11) DEFAULT 1 COMMENT 'Rol del usuario (relación con la tabla roles)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores_eventos`
--
ALTER TABLE `jugadores_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `me_gustas`
--
ALTER TABLE `me_gustas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugadores_eventos`
--
ALTER TABLE `jugadores_eventos`
  ADD CONSTRAINT `fk_eventos` FOREIGN KEY (`fk_eventos`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jugadores_eventos_ibfk_1` FOREIGN KEY (`nombre`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `me_gustas`
--
ALTER TABLE `me_gustas`
  ADD CONSTRAINT `me_gustas_ibfk_1` FOREIGN KEY (`publicacion_id`) REFERENCES `publicaciones` (`id`),
  ADD CONSTRAINT `me_gustas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `temas` (`id`),
  ADD CONSTRAINT `publicaciones_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

