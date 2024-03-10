<?php
    require_once('../../../includes/config.php');
    require_once('../../../src/peliculas/peliculas.php');

    $tituloPagina = 'Proceso de login';

    $titulo = htmlspecialchars(strip_tags($_POST["nombre"]));
    $sinopsis = htmlspecialchars(strip_tags($_POST["sinopsis"]));
    $rutaPoster = htmlspecialchars(strip_tags($_POST["poster"]));
    $rutaTrailer = htmlspecialchars(strip_tags($_POST["trailer"]));
    $pegi = htmlspecialchars(strip_tags($_POST["edad"]));
    $genero = htmlspecialchars(strip_tags($_POST["genero"]));
    $duracion = htmlspecialchars(strip_tags($_POST["duracion"]));

    $tipo = $_GET['tipo'];
    $nom = $_GET['nom'];
    $aux = ' ';
    if ($tipo == 'A') $aux = null;
    else $aux = $nom;
    
    $pelicula = Pelicula::crea($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion, $aux);

    require(RUTA_RAIZ . '/vistas/pagina/administracion/administracion.php');
    