SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `proyecto_daw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyecto_daw`;

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del evento',
  `title` varchar(255) NOT NULL COMMENT 'Título del evento',
  `description` text NOT NULL COMMENT 'Breve descripción del evento o partida',
  `master` varchar(255) NOT NULL COMMENT 'Nombre del máster, director del juego o ponente a cargo del evento',
  `players` int(11) NOT NULL COMMENT 'Número de plazas para jugadores o asistentes',
  `date` date NOT NULL COMMENT 'Fecha del evento',
  `time` time NOT NULL COMMENT 'Hora de inicio del evento',
  `end_time` time NOT NULL COMMENT 'Hora de finalización del evento',
  `mode` enum('online','presencial') NOT NULL COMMENT 'Indica si el evento es en línea o presencial',
  `location` varchar(255) DEFAULT NULL COMMENT 'Ubicación del evento en caso de ser presencial',
  `adults` tinyint(1) DEFAULT 0 COMMENT 'Indica si el evento es solo para mayores de 18 años (1) o para todos los públicos (0)',
  `image` varchar(255) DEFAULT NULL COMMENT 'Ruta donde está la imagen del evento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que gestiona los eventos';

DROP TABLE IF EXISTS `jugadores_eventos`;
CREATE TABLE `jugadores_eventos` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del registro',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del asistente o jugador',
  `fk_eventos` int(11) NOT NULL COMMENT 'Clave foránea que relaciona esta tabla con la tabla eventos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que gestiona los asistentes a los eventos';

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del usuario',
  `nombre_usuario` varchar(50) NOT NULL COMMENT 'Nombre de usuario (nickname)',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre real del usuario',
  `email` varchar(100) NOT NULL COMMENT 'Correo electrónico del usuario',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña encriptada del usuario',
  `rol` enum('jugador','moderador','administrador') NOT NULL DEFAULT 'jugador' COMMENT 'Rol del usuario dentro del sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que gestiona los usuarios del sistema';

ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jugadores_eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_jugador_evento` (`nombre`,`fk_eventos`),
  ADD KEY `fk_eventos` (`fk_eventos`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `jugadores_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `jugadores_eventos`
  ADD CONSTRAINT `fk_eventos` FOREIGN KEY (`fk_eventos`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jugadores_eventos_ibfk_1` FOREIGN KEY (`nombre`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;