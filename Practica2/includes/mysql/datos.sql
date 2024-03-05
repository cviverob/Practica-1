-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2024 a las 12:46:14
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
(1, 'Admin', 0, '', '', 0),
(2, 'admin', 20, 'admin@ucm.es', 'adminpass', 1),
(3, 'user', 20, 'user@ucm.es', 'userpass', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
