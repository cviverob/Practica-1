-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: vm003.db.swarm.test
-- Tiempo de generación: 10-04-2024 a las 09:37:18
-- Versión del servidor: 10.4.32-MariaDB-1:10.4.32+maria~ubu2004
-- Versión de PHP: 8.2.8

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
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`Id`, `Titulo`, `Genero`, `Pegi`, `Duracion`, `Sinopsis`, `Poster`, `Trailer`) VALUES
(1, 'Dune', 'Ciencia-Ficcion', 12, 155, 'En el A&ntilde;o 10191 el des&eacute;rtico planeta Arrakis, feudo de la familia Harkonnen desde hace generaciones, queda en manos de la Casa de los Atreides por orden del emperador. Con ello les cede la explotaci&oacute;n de las reservas de especia, la materia prima m&aacute;s valiosa de la galaxia, necesaria para los viajes interestelares y tambi&eacute;n una droga capaz de amplificar la conciencia y extender la vida. El duque Leto (Oscar Isaac), la dama Jessica (Rebecca Ferguson) y el hijo de ambos, Paul Atreides (Timoth&eacute;e Chalamet), llegan a Arrakis con la esperanza de mantener el buen nombre de su casa y ser fieles al emperador, pero pronto se ver&aacute;n envueltos en una trama de traiciones y enga&ntilde;os que les llevar&aacute; a cuestionar su confianza entre sus m&aacute;s allegados y a valorar a los lugare&ntilde;os, los Fremen, una estirpe de habitantes del desierto con una estrecha relaci&oacute;n con la especie', 'Dune.png', 'Dune.mp4'),
(2, 'Infiltrados en la universidad', 'Comedia', 16, 120, 'Los agentes de polic&iacute;a Jenko (Channing Tatum) y Schmidt (Jonah Hill) tendr&aacute;n que infiltrarse en un campus universitario para intentar desarticular una red de narcotr&aacute;fico. Secuela de &quot;Infiltrados en clase&quot;', 'InfiltradosEnLaUniversidad.jpg', 'InfiltradosEnLaUniversidad.mp4'),
(3, 'Pitch Black', 'Accion', 12, 109, 'Durante un viaje interestelar, un carguero espacial sufre una aver&iacute;a a causa de una tormenta de asteroides, vi&eacute;ndose obligado a efectuar un aterrizaje de emergencia en el que muere parte del pasaje. Un asesino muy peligroso, Riddick, que formaba parte de la carga, huye del lugar dejando a los supervivientes con dos preocupaciones, &eacute;l y unas peligrosas criaturas nocturnas que salen a la superficie cuando los tres soles del planeta se oscurecen a causa de un eclipse.', 'PitchBlack.jpg', 'PitchBlack.mp4');

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `edad`, `email`, `contraseña`, `rol`) VALUES
(1, 'admin', 18, 'admin@ucm.es', '$2y$10$h7B9xHZ/HjUjnO9xt6UaAeDw2Uje2jt4HxBbTm45P5Fokj797S/AO', 1),
(2, 'user', 18, 'user@ucm.es', '$2y$10$5AOOBEjaTpz4EC6wXkEGs.eMcGhTHLwypzAmVm7DIoV9BjAlfHTnG', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
