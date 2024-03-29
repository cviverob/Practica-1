-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2024 a las 10:52:40
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
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `edad`, `email`, `contraseña`, `rol`) VALUES
(1, 'admin', 18, 'admin@ucm.es', '$2y$10$h7B9xHZ/HjUjnO9xt6UaAeDw2Uje2jt4HxBbTm45P5Fokj797S/AO', 1),
(2, 'user', 18, 'user@ucm.es', '$2y$10$5AOOBEjaTpz4EC6wXkEGs.eMcGhTHLwypzAmVm7DIoV9BjAlfHTnG', 0),
(3, 'caca', 5, 'caca', '$2y$10$Z3/wOTHt9C1o3p4vbBvcjOfAnaFz6URsU6nsql6wvmQ2vLYPDusWG', 1),
(4, 'cacas', 5, 'cacas', '$2y$10$nJnoWXFxj4mJqgjd4cIVRuUsBjtDobuceGuOmKgXhfn3KB0TII7kK', 1),
(5, 'Nayra', 3, 'naybetan@ucm.es', '$2y$10$Ul1PoCMrEGIqN8cpiOQ0n.vtFtj2D9ErjJA1/s616/Pi4gKyJdEPO', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
