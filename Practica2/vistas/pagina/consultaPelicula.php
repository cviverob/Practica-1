<?php
require_once('../../includes/config.php');
require_once('../../src/peliculas/peliculas.php');

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Proceso de login';

// Película de ejemplo
$pelicula = Pelicula::crea("Dune", "El duque Paul Atreides se une a los Fremen y comienza un 
viaje espiritual y marcial para convertirse en Muad'dib, mientras intenta evitar el horrible 
pero inevitable futuro que ha presenciado: una Guerra Santa en su nombre, que se extiende por
 todo el universo conocido. Secuela de la película estrenada en 2021.", "../../img/Dune.png", 
 "", 18, "acción", 120);

// Faltan las sesiones y el trailer
/*
    if (!isset($_SESSION["pelicula"]) || !isset($_SESSION["pelicula"])) {
        echo "<h1>Error:</h1>";
        echo "<p>Película no encontrada</p>";
    }
    else {
        $pelicula = $_SESSION["pelicula"];
        echo "<h1>" . $pelicula->getTitulo() . "</h1>";
        // Faltan las sesiones
        echo "<img src = \"" . $pelicula->getRutaPoster() . "\" alt = \"Póster de la película\">";
        echo "<p> Sinopsis: " . $pelicula->getSinopsis() . "</p>";
        echo "<p> Edad mínima: " . $pelicula->getPegi() . "</p>";
        echo "<p> Género: " . $pelicula->getGenero() . "</p>";
        echo "<p> Género: " . $pelicula->getDuracion() . "minutos </p>";
    } 
*/
$contenidoPrincipal = <<< EOS
    <h1>{$pelicula->getTitulo()}</h1>
    <img src = "{$pelicula->getRutaPoster()}" alt = \"Póster de la película\">";
    <p> Sinopsis: {$pelicula->getSinopsis()} </p>
    <p> Edad mínima: {$pelicula->getPegi()} </p>
    <p> Género:  {$pelicula->getGenero()} </p>
    <p> Género: {$pelicula->getDuracion()} minutos </p>
EOS;

require('../comun/plantilla.php');