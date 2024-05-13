-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2024 a las 20:23:27
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
-- Volcado de datos para la tabla `cartelera`
--

INSERT INTO `cartelera` (`Id`, `Id_peli`, `Fecha`, `Hora_ini`, `Hora_fin`, `Id_sala`, `Butacas`, `Visible`, `archivado`) VALUES
(5, 1, '2024-05-17', '12:30:00', '15:15:00', 1, '{\"1-1\":{\"fila\":1,\"columna\":1,\"estado\":\"ocupada\"},\"1-2\":{\"fila\":1,\"columna\":2,\"estado\":\"ocupada\"},\"1-3\":{\"fila\":1,\"columna\":3,\"estado\":\"ocupada\"},\"1-4\":{\"fila\":1,\"columna\":4,\"estado\":\"ocupada\"},\"1-5\":{\"fila\":1,\"columna\":5,\"estado\":\"ocupada\"},\"1-6\":{\"fila\":1,\"columna\":6,\"estado\":\"ocupada\"},\"1-7\":{\"fila\":1,\"columna\":7,\"estado\":\"ocupada\"},\"1-8\":{\"fila\":1,\"columna\":8,\"estado\":\"disponible\"},\"1-9\":{\"fila\":1,\"columna\":9,\"estado\":\"disponible\"},\"1-10\":{\"fila\":1,\"columna\":10,\"estado\":\"disponible\"},\"2-1\":{\"fila\":2,\"columna\":1,\"estado\":\"nulo\"},\"2-2\":{\"fila\":2,\"columna\":2,\"estado\":\"disponible\"},\"2-3\":{\"fila\":2,\"columna\":3,\"estado\":\"disponible\"},\"2-4\":{\"fila\":2,\"columna\":4,\"estado\":\"disponible\"},\"2-5\":{\"fila\":2,\"columna\":5,\"estado\":\"disponible\"},\"2-6\":{\"fila\":2,\"columna\":6,\"estado\":\"disponible\"},\"2-7\":{\"fila\":2,\"columna\":7,\"estado\":\"disponible\"},\"2-8\":{\"fila\":2,\"columna\":8,\"estado\":\"disponible\"},\"2-9\":{\"fila\":2,\"columna\":9,\"estado\":\"disponible\"},\"2-10\":{\"fila\":2,\"columna\":10,\"estado\":\"disponible\"},\"3-1\":{\"fila\":3,\"columna\":1,\"estado\":\"nulo\"},\"3-2\":{\"fila\":3,\"columna\":2,\"estado\":\"disponible\"},\"3-3\":{\"fila\":3,\"columna\":3,\"estado\":\"disponible\"},\"3-4\":{\"fila\":3,\"columna\":4,\"estado\":\"disponible\"},\"3-5\":{\"fila\":3,\"columna\":5,\"estado\":\"ocupada\"},\"3-6\":{\"fila\":3,\"columna\":6,\"estado\":\"ocupada\"},\"3-7\":{\"fila\":3,\"columna\":7,\"estado\":\"disponible\"},\"3-8\":{\"fila\":3,\"columna\":8,\"estado\":\"disponible\"},\"3-9\":{\"fila\":3,\"columna\":9,\"estado\":\"disponible\"},\"3-10\":{\"fila\":3,\"columna\":10,\"estado\":\"disponible\"},\"4-1\":{\"fila\":4,\"columna\":1,\"estado\":\"nulo\"},\"4-2\":{\"fila\":4,\"columna\":2,\"estado\":\"disponible\"},\"4-3\":{\"fila\":4,\"columna\":3,\"estado\":\"disponible\"},\"4-4\":{\"fila\":4,\"columna\":4,\"estado\":\"disponible\"},\"4-5\":{\"fila\":4,\"columna\":5,\"estado\":\"disponible\"},\"4-6\":{\"fila\":4,\"columna\":6,\"estado\":\"disponible\"},\"4-7\":{\"fila\":4,\"columna\":7,\"estado\":\"disponible\"},\"4-8\":{\"fila\":4,\"columna\":8,\"estado\":\"disponible\"},\"4-9\":{\"fila\":4,\"columna\":9,\"estado\":\"disponible\"},\"4-10\":{\"fila\":4,\"columna\":10,\"estado\":\"disponible\"},\"5-1\":{\"fila\":5,\"columna\":1,\"estado\":\"nulo\"},\"5-2\":{\"fila\":5,\"columna\":2,\"estado\":\"disponible\"},\"5-3\":{\"fila\":5,\"columna\":3,\"estado\":\"disponible\"},\"5-4\":{\"fila\":5,\"columna\":4,\"estado\":\"disponible\"},\"5-5\":{\"fila\":5,\"columna\":5,\"estado\":\"disponible\"},\"5-6\":{\"fila\":5,\"columna\":6,\"estado\":\"disponible\"},\"5-7\":{\"fila\":5,\"columna\":7,\"estado\":\"disponible\"},\"5-8\":{\"fila\":5,\"columna\":8,\"estado\":\"disponible\"},\"5-9\":{\"fila\":5,\"columna\":9,\"estado\":\"disponible\"},\"5-10\":{\"fila\":5,\"columna\":10,\"estado\":\"disponible\"},\"6-1\":{\"fila\":6,\"columna\":1,\"estado\":\"nulo\"},\"6-2\":{\"fila\":6,\"columna\":2,\"estado\":\"disponible\"},\"6-3\":{\"fila\":6,\"columna\":3,\"estado\":\"disponible\"},\"6-4\":{\"fila\":6,\"columna\":4,\"estado\":\"disponible\"},\"6-5\":{\"fila\":6,\"columna\":5,\"estado\":\"disponible\"},\"6-6\":{\"fila\":6,\"columna\":6,\"estado\":\"disponible\"},\"6-7\":{\"fila\":6,\"columna\":7,\"estado\":\"disponible\"},\"6-8\":{\"fila\":6,\"columna\":8,\"estado\":\"disponible\"},\"6-9\":{\"fila\":6,\"columna\":9,\"estado\":\"disponible\"},\"6-10\":{\"fila\":6,\"columna\":10,\"estado\":\"disponible\"}}', 1, 0);

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`Id_compra`, `Id_usuario`, `Id_sesion`, `Id_peli`, `Butacas`, `Pendiente`, `Hora`) VALUES
(1, 1, 5, 1, '[\"3-5\",\"3-6\"]', 0, '2024-05-13 19:45:40'),
(2, 2, 5, 1, '[\"1-1\",\"1-2\"]', 0, '2024-05-13 19:48:59'),
(3, 2, 5, 1, '[\"1-3\"]', 0, '2024-05-13 20:03:05'),
(4, 2, 5, 1, '[\"1-4\",\"1-5\"]', 0, '2024-05-13 20:03:56'),
(5, 3, 5, 1, '[\"1-6\",\"1-7\"]', 0, '2024-05-13 20:09:41');

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`Id_sesion`, `Id_butaca`) VALUES
(5, '1-1'),
(5, '1-2'),
(5, '1-3'),
(5, '1-4'),
(5, '1-5'),
(5, '1-6'),
(5, '1-7'),
(5, '3-5'),
(5, '3-6');

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`Id`, `Titulo`, `Genero`, `Pegi`, `Duracion`, `Sinopsis`, `Poster`, `Trailer`, `archivado`) VALUES
(1, 'Dune', 'Ciencia-Ficcion', 12, 155, 'En el A&ntilde;o 10191 el des&eacute;rtico planeta Arrakis, feudo de la familia Harkonnen desde hace generaciones, queda en manos de la Casa de los Atreides por orden del emperador. Con ello les cede la explotaci&oacute;n de las reservas de especia, la materia prima m&aacute;s valiosa de la galaxia, necesaria para los viajes interestelares y tambi&eacute;n una droga capaz de amplificar la conciencia y extender la vida. El duque Leto (Oscar Isaac), la dama Jessica (Rebecca Ferguson) y el hijo de ambos, Paul Atreides (Timoth&eacute;e Chalamet), llegan a Arrakis con la esperanza de mantener el buen nombre de su casa y ser fieles al emperador, pero pronto se ver&aacute;n envueltos en una trama de traiciones y enga&ntilde;os que les llevar&aacute; a cuestionar su confianza entre sus m&aacute;s allegados y a valorar a los lugare&ntilde;os, los Fremen, una estirpe de habitantes del desierto con una estrecha relaci&oacute;n con la especie', 'Dune.png', 'Dune.mp4', 0),
(2, 'Infiltrados en la universidad', 'Comedia', 16, 120, 'Los agentes de polic&iacute;a Jenko (Channing Tatum) y Schmidt (Jonah Hill) tendr&aacute;n que infiltrarse en un campus universitario para intentar desarticular una red de narcotr&aacute;fico. Secuela de &quot;Infiltrados en clase&quot;', 'InfiltradosEnLaUniversidad.jpg', 'InfiltradosEnLaUniversidad.mp4', 0),
(3, 'Pitch Black', 'Accion', 12, 109, 'Durante un viaje interestelar, un carguero espacial sufre una aver&iacute;a a causa de una tormenta de asteroides, vi&eacute;ndose obligado a efectuar un aterrizaje de emergencia en el que muere parte del pasaje. Un asesino muy peligroso, Riddick, que formaba parte de la carga, huye del lugar dejando a los supervivientes con dos preocupaciones, &eacute;l y unas peligrosas criaturas nocturnas que salen a la superficie cuando los tres soles del planeta se oscurecen a causa de un eclipse.', 'PitchBlack.jpg', 'PitchBlack.mp4', 0);

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`Id`, `Num_sala`, `Num_filas`, `Num_columnas`, `Butacas`, `archivado`) VALUES
(1, 1, 6, 10, '{\"1-1\":{\"fila\":1,\"columna\":1,\"estado\":\"disponible\"},\"1-2\":{\"fila\":1,\"columna\":2,\"estado\":\"disponible\"},\"1-3\":{\"fila\":1,\"columna\":3,\"estado\":\"disponible\"},\"1-4\":{\"fila\":1,\"columna\":4,\"estado\":\"disponible\"},\"1-5\":{\"fila\":1,\"columna\":5,\"estado\":\"disponible\"},\"1-6\":{\"fila\":1,\"columna\":6,\"estado\":\"disponible\"},\"1-7\":{\"fila\":1,\"columna\":7,\"estado\":\"disponible\"},\"1-8\":{\"fila\":1,\"columna\":8,\"estado\":\"disponible\"},\"1-9\":{\"fila\":1,\"columna\":9,\"estado\":\"disponible\"},\"1-10\":{\"fila\":1,\"columna\":10,\"estado\":\"disponible\"},\"2-1\":{\"fila\":2,\"columna\":1,\"estado\":\"nulo\"},\"2-2\":{\"fila\":2,\"columna\":2,\"estado\":\"disponible\"},\"2-3\":{\"fila\":2,\"columna\":3,\"estado\":\"disponible\"},\"2-4\":{\"fila\":2,\"columna\":4,\"estado\":\"disponible\"},\"2-5\":{\"fila\":2,\"columna\":5,\"estado\":\"disponible\"},\"2-6\":{\"fila\":2,\"columna\":6,\"estado\":\"disponible\"},\"2-7\":{\"fila\":2,\"columna\":7,\"estado\":\"disponible\"},\"2-8\":{\"fila\":2,\"columna\":8,\"estado\":\"disponible\"},\"2-9\":{\"fila\":2,\"columna\":9,\"estado\":\"disponible\"},\"2-10\":{\"fila\":2,\"columna\":10,\"estado\":\"disponible\"},\"3-1\":{\"fila\":3,\"columna\":1,\"estado\":\"nulo\"},\"3-2\":{\"fila\":3,\"columna\":2,\"estado\":\"disponible\"},\"3-3\":{\"fila\":3,\"columna\":3,\"estado\":\"disponible\"},\"3-4\":{\"fila\":3,\"columna\":4,\"estado\":\"disponible\"},\"3-5\":{\"fila\":3,\"columna\":5,\"estado\":\"disponible\"},\"3-6\":{\"fila\":3,\"columna\":6,\"estado\":\"disponible\"},\"3-7\":{\"fila\":3,\"columna\":7,\"estado\":\"disponible\"},\"3-8\":{\"fila\":3,\"columna\":8,\"estado\":\"disponible\"},\"3-9\":{\"fila\":3,\"columna\":9,\"estado\":\"disponible\"},\"3-10\":{\"fila\":3,\"columna\":10,\"estado\":\"disponible\"},\"4-1\":{\"fila\":4,\"columna\":1,\"estado\":\"nulo\"},\"4-2\":{\"fila\":4,\"columna\":2,\"estado\":\"disponible\"},\"4-3\":{\"fila\":4,\"columna\":3,\"estado\":\"disponible\"},\"4-4\":{\"fila\":4,\"columna\":4,\"estado\":\"disponible\"},\"4-5\":{\"fila\":4,\"columna\":5,\"estado\":\"disponible\"},\"4-6\":{\"fila\":4,\"columna\":6,\"estado\":\"disponible\"},\"4-7\":{\"fila\":4,\"columna\":7,\"estado\":\"disponible\"},\"4-8\":{\"fila\":4,\"columna\":8,\"estado\":\"disponible\"},\"4-9\":{\"fila\":4,\"columna\":9,\"estado\":\"disponible\"},\"4-10\":{\"fila\":4,\"columna\":10,\"estado\":\"disponible\"},\"5-1\":{\"fila\":5,\"columna\":1,\"estado\":\"nulo\"},\"5-2\":{\"fila\":5,\"columna\":2,\"estado\":\"disponible\"},\"5-3\":{\"fila\":5,\"columna\":3,\"estado\":\"disponible\"},\"5-4\":{\"fila\":5,\"columna\":4,\"estado\":\"disponible\"},\"5-5\":{\"fila\":5,\"columna\":5,\"estado\":\"disponible\"},\"5-6\":{\"fila\":5,\"columna\":6,\"estado\":\"disponible\"},\"5-7\":{\"fila\":5,\"columna\":7,\"estado\":\"disponible\"},\"5-8\":{\"fila\":5,\"columna\":8,\"estado\":\"disponible\"},\"5-9\":{\"fila\":5,\"columna\":9,\"estado\":\"disponible\"},\"5-10\":{\"fila\":5,\"columna\":10,\"estado\":\"disponible\"},\"6-1\":{\"fila\":6,\"columna\":1,\"estado\":\"nulo\"},\"6-2\":{\"fila\":6,\"columna\":2,\"estado\":\"disponible\"},\"6-3\":{\"fila\":6,\"columna\":3,\"estado\":\"disponible\"},\"6-4\":{\"fila\":6,\"columna\":4,\"estado\":\"disponible\"},\"6-5\":{\"fila\":6,\"columna\":5,\"estado\":\"disponible\"},\"6-6\":{\"fila\":6,\"columna\":6,\"estado\":\"disponible\"},\"6-7\":{\"fila\":6,\"columna\":7,\"estado\":\"disponible\"},\"6-8\":{\"fila\":6,\"columna\":8,\"estado\":\"disponible\"},\"6-9\":{\"fila\":6,\"columna\":9,\"estado\":\"disponible\"},\"6-10\":{\"fila\":6,\"columna\":10,\"estado\":\"disponible\"}}', 0);

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `edad`, `email`, `contraseña`, `rol`) VALUES
(1, 'admin', 18, 'admin@ucm.es', '$2y$10$h7B9xHZ/HjUjnO9xt6UaAeDw2Uje2jt4HxBbTm45P5Fokj797S/AO', 1),
(2, 'user', 18, 'user@ucm.es', '$2y$10$5AOOBEjaTpz4EC6wXkEGs.eMcGhTHLwypzAmVm7DIoV9BjAlfHTnG', 0),
(3, 'paco', 18, 'paco@ucm.es', '$2y$10$JUTrv.rL5PwTuXU2so1.1.JX/liiHaK0OEFeeRpsnD87K1zY1cFRa', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
