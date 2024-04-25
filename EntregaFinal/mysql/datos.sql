-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: vm003.db.swarm.test
-- Tiempo de generación: 12-04-2024 a las 14:34:52
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
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`Id`, `Num_sala`, `Num_filas`, `Num_columnas`, `Butacas`) VALUES
(1, 1, 6, 10, '{\"1\":{\"fila\":1,\"columna\":1,\"estado\":\"disponible\"},\"2\":{\"fila\":1,\"columna\":2,\"estado\":\"disponible\"},\"3\":{\"fila\":1,\"columna\":3,\"estado\":\"disponible\"},\"4\":{\"fila\":1,\"columna\":4,\"estado\":\"disponible\"},\"5\":{\"fila\":1,\"columna\":5,\"estado\":\"disponible\"},\"6\":{\"fila\":1,\"columna\":6,\"estado\":\"disponible\"},\"7\":{\"fila\":1,\"columna\":7,\"estado\":\"disponible\"},\"8\":{\"fila\":1,\"columna\":8,\"estado\":\"disponible\"},\"9\":{\"fila\":1,\"columna\":9,\"estado\":\"disponible\"},\"10\":{\"fila\":1,\"columna\":10,\"estado\":\"disponible\"},\"11\":{\"fila\":2,\"columna\":1,\"estado\":\"disponible\"},\"12\":{\"fila\":2,\"columna\":2,\"estado\":\"disponible\"},\"13\":{\"fila\":2,\"columna\":3,\"estado\":\"nulo\"},\"14\":{\"fila\":2,\"columna\":4,\"estado\":\"disponible\"},\"15\":{\"fila\":2,\"columna\":5,\"estado\":\"disponible\"},\"16\":{\"fila\":2,\"columna\":6,\"estado\":\"disponible\"},\"17\":{\"fila\":2,\"columna\":7,\"estado\":\"disponible\"},\"18\":{\"fila\":2,\"columna\":8,\"estado\":\"nulo\"},\"19\":{\"fila\":2,\"columna\":9,\"estado\":\"disponible\"},\"20\":{\"fila\":2,\"columna\":10,\"estado\":\"disponible\"},\"21\":{\"fila\":3,\"columna\":1,\"estado\":\"disponible\"},\"22\":{\"fila\":3,\"columna\":2,\"estado\":\"disponible\"},\"23\":{\"fila\":3,\"columna\":3,\"estado\":\"nulo\"},\"24\":{\"fila\":3,\"columna\":4,\"estado\":\"disponible\"},\"25\":{\"fila\":3,\"columna\":5,\"estado\":\"disponible\"},\"26\":{\"fila\":3,\"columna\":6,\"estado\":\"disponible\"},\"27\":{\"fila\":3,\"columna\":7,\"estado\":\"disponible\"},\"28\":{\"fila\":3,\"columna\":8,\"estado\":\"nulo\"},\"29\":{\"fila\":3,\"columna\":9,\"estado\":\"disponible\"},\"30\":{\"fila\":3,\"columna\":10,\"estado\":\"disponible\"},\"31\":{\"fila\":4,\"columna\":1,\"estado\":\"disponible\"},\"32\":{\"fila\":4,\"columna\":2,\"estado\":\"disponible\"},\"33\":{\"fila\":4,\"columna\":3,\"estado\":\"nulo\"},\"34\":{\"fila\":4,\"columna\":4,\"estado\":\"disponible\"},\"35\":{\"fila\":4,\"columna\":5,\"estado\":\"disponible\"},\"36\":{\"fila\":4,\"columna\":6,\"estado\":\"disponible\"},\"37\":{\"fila\":4,\"columna\":7,\"estado\":\"disponible\"},\"38\":{\"fila\":4,\"columna\":8,\"estado\":\"nulo\"},\"39\":{\"fila\":4,\"columna\":9,\"estado\":\"disponible\"},\"40\":{\"fila\":4,\"columna\":10,\"estado\":\"disponible\"},\"41\":{\"fila\":5,\"columna\":1,\"estado\":\"disponible\"},\"42\":{\"fila\":5,\"columna\":2,\"estado\":\"disponible\"},\"43\":{\"fila\":5,\"columna\":3,\"estado\":\"nulo\"},\"44\":{\"fila\":5,\"columna\":4,\"estado\":\"disponible\"},\"45\":{\"fila\":5,\"columna\":5,\"estado\":\"disponible\"},\"46\":{\"fila\":5,\"columna\":6,\"estado\":\"disponible\"},\"47\":{\"fila\":5,\"columna\":7,\"estado\":\"disponible\"},\"48\":{\"fila\":5,\"columna\":8,\"estado\":\"nulo\"},\"49\":{\"fila\":5,\"columna\":9,\"estado\":\"disponible\"},\"50\":{\"fila\":5,\"columna\":10,\"estado\":\"disponible\"},\"51\":{\"fila\":6,\"columna\":1,\"estado\":\"disponible\"},\"52\":{\"fila\":6,\"columna\":2,\"estado\":\"disponible\"},\"53\":{\"fila\":6,\"columna\":3,\"estado\":\"nulo\"},\"54\":{\"fila\":6,\"columna\":4,\"estado\":\"disponible\"},\"55\":{\"fila\":6,\"columna\":5,\"estado\":\"disponible\"},\"56\":{\"fila\":6,\"columna\":6,\"estado\":\"disponible\"},\"57\":{\"fila\":6,\"columna\":7,\"estado\":\"disponible\"},\"58\":{\"fila\":6,\"columna\":8,\"estado\":\"nulo\"},\"59\":{\"fila\":6,\"columna\":9,\"estado\":\"disponible\"},\"60\":{\"fila\":6,\"columna\":10,\"estado\":\"disponible\"}}'),
(2, 2, 5, 5, '{\"1\":{\"fila\":1,\"columna\":1,\"estado\":\"disponible\"},\"2\":{\"fila\":1,\"columna\":2,\"estado\":\"disponible\"},\"3\":{\"fila\":1,\"columna\":3,\"estado\":\"disponible\"},\"4\":{\"fila\":1,\"columna\":4,\"estado\":\"disponible\"},\"5\":{\"fila\":1,\"columna\":5,\"estado\":\"disponible\"},\"6\":{\"fila\":2,\"columna\":1,\"estado\":\"disponible\"},\"7\":{\"fila\":2,\"columna\":2,\"estado\":\"disponible\"},\"8\":{\"fila\":2,\"columna\":3,\"estado\":\"nulo\"},\"9\":{\"fila\":2,\"columna\":4,\"estado\":\"disponible\"},\"10\":{\"fila\":2,\"columna\":5,\"estado\":\"disponible\"},\"11\":{\"fila\":3,\"columna\":1,\"estado\":\"disponible\"},\"12\":{\"fila\":3,\"columna\":2,\"estado\":\"disponible\"},\"13\":{\"fila\":3,\"columna\":3,\"estado\":\"nulo\"},\"14\":{\"fila\":3,\"columna\":4,\"estado\":\"disponible\"},\"15\":{\"fila\":3,\"columna\":5,\"estado\":\"disponible\"},\"16\":{\"fila\":4,\"columna\":1,\"estado\":\"disponible\"},\"17\":{\"fila\":4,\"columna\":2,\"estado\":\"disponible\"},\"18\":{\"fila\":4,\"columna\":3,\"estado\":\"nulo\"},\"19\":{\"fila\":4,\"columna\":4,\"estado\":\"disponible\"},\"20\":{\"fila\":4,\"columna\":5,\"estado\":\"disponible\"},\"21\":{\"fila\":5,\"columna\":1,\"estado\":\"disponible\"},\"22\":{\"fila\":5,\"columna\":2,\"estado\":\"disponible\"},\"23\":{\"fila\":5,\"columna\":3,\"estado\":\"nulo\"},\"24\":{\"fila\":5,\"columna\":4,\"estado\":\"disponible\"},\"25\":{\"fila\":5,\"columna\":5,\"estado\":\"disponible\"}}');

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
