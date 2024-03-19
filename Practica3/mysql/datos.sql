-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 23:09:40
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

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`Nombre`, `Genero`, `Edad`, `Duracion`, `Descripcion`, `Imagen`, `Trailer`) VALUES
('Dune', 'Acción', 18, 120, 'En el Año 10191 el desértico planeta Arrakis, feudo de la familia Harkonnen desde hace generaciones, queda en manos de la Casa de los Atreides por orden del emperador. Con ello les cede la explotación de las reservas de especia, la materia prima más valiosa de la galaxia, necesaria para los viajes interestelares y también una droga capaz de amplificar la conciencia y extender la vida. El duque Leto (Oscar Isaac), la dama Jessica (Rebecca Ferguson) y el hijo de ambos, Paul Atreides (Timothée Chalamet), llegan a Arrakis con la esperanza de mantener el buen nombre de su casa y ser fieles al emperador, pero pronto se verán envueltos en una trama de traiciones y engaños que les llevará a cuestionar su confianza entre sus más allegados y a valorar a los lugareños, los Fremen, una estirpe de habitantes del desierto con una estrecha relación con la especia. ', '/Practica-SW/Practica2/img/posters/Dune.png', '/Practica-SW/Practica2/img/trailers/Dune.mp4'),
('Infiltrados en la universidad', 'Comedia', 16, 112, 'Los agentes de policía Jenko (Channing Tatum) y Schmidt (Jonah Hill) tendrán que infiltrarse en un campus universitario para intentar desarticular una red de narcotráfico. Secuela de ', '/Practica-SW/Practica2/img/posters/InfiltradosEnLaUniversidad.jpg', '/Practica-SW/Practica2/img/trailers/InfiltradosEnLaUniversidad.mp4'),
('Pitch Black', 'Ciencia-Ficcion', 16, 109, 'Durante un viaje interestelar, un carguero espacial sufre una avería a causa de una tormenta de asteroides, viéndose obligado a efectuar un aterrizaje de emergencia en el que muere parte del pasaje. Un asesino muy peligroso, Riddick, que formaba parte de la carga, huye del lugar dejando a los supervivientes con dos preocupaciones, él y unas peligrosas criaturas nocturnas que salen a la superficie cuando los tres soles del planeta se oscurecen a causa de un eclipse.', '/Practica-SW/Practica2/img/posters/PitchBlack.jpg', '/Practica-SW/Practica2/img/trailers/PitchBlack.mp4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
