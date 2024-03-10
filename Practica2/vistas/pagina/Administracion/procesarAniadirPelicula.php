<?php
    require_once('../../../includes/config.php');
    require_once('../../../src/peliculas/peliculas.php');

    $tituloPagina = 'Proceso de login';

    $titulo = htmlspecialchars(strip_tags($_POST["nombre"]));
    $sinopsis = htmlspecialchars(strip_tags($_POST["sinopsis"]));
    /* 
        Líneas 13-15 generadas con chatgpt, usadas para guardar en img/posters/ la imagen seleccionada 
        Para los trailers se ha usado la misma técnica    
    */
    $rutaPoster = $_FILES["poster"]["name"];
    $ruta_destino_poster = RUTA_RAIZ . RUTA_PSTR .'/' . $rutaPoster;
    move_uploaded_file($_FILES["poster"]["tmp_name"], $ruta_destino_poster);
    $rutaTrailer = $_FILES["trailer"]["name"];
    $ruta_destino_trailer = RUTA_RAIZ . RUTA_TRL .'/' . $rutaTrailer;
    move_uploaded_file($_FILES["trailer"]["tmp_name"], $ruta_destino_trailer);
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
    