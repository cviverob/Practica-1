-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 20:36:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cines`
--
CREATE DATABASE IF NOT EXISTS `cines` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cines`;

--
-- Truncar tablas antes de insertar `cartelera`
--

TRUNCATE TABLE `cartelera`;
--
-- Truncar tablas antes de insertar `compras`
--

TRUNCATE TABLE `compras`;
--
-- Truncar tablas antes de insertar `peliculas`
--

TRUNCATE TABLE `peliculas`;
--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`Nombre`, `Genero`, `Edad`, `Duracion`, `Descripcion`, `Imagen`, `Trailer`) VALUES
('Dune', 'acción', 18, 120, 'El duque Paul Atreides se une a los Fremen y comienza un \r\n    viaje espiritual y marcial para conve', 'img/posters/Dune.png', ''),
('Infiltrados en la universidad', 'Comedia', 16, 112, 'Tras hacerse pasar por estudiantes de instituto y lograr desarticular a una banda de narcotraficantes, los oficiales de policía Schmidt y Jenko deben volver a las aulas como policías encubiertos, pero esta vez su destino será la Universidad.', 'img/posters/InfiltradosEnLaUniversidad.jpg', 'InfiltradosEnLaUniversidad.jpg'),
('Pitch Black', 'Ciencia-Ficcion', 16, 109, 'Una nave espacial averiada, que lleva a bordo a un prisionero extremadamente peligroso, se estrella en un planeta desconocido. La tripulación y los desafortunados viajeros que van en ella tendrán que luchar por sobrevivir en un nuevo mundo.', 'img/posters/PitchBlack.jpg', 'PitchBlack.jpg');

--
-- Truncar tablas antes de insertar `salas`
--

TRUNCATE TABLE `salas`;
--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `edad`, `email`, `contraseña`, `rol`) VALUES
(82, 'admin', 18, 'admin@ucm.es', '$2y$10$mNCZb8xiiXYicNHyNm.7QuOYhHZFzOXy3ork.sNbcSgbTBcruVpdm', 1),
(84, 'user', 18, 'user@ucm.es', '$2y$10$YxparQBwB3HagIyq/3m2CeIY31ZKMWFx1VC2ZrG4pa58du5ucHrfa', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
