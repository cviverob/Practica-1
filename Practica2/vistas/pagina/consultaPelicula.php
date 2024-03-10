<?php
    require_once('../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_PLCL);

    $tituloPagina = 'Consultar película';

// Faltan las sesiones y el trailer
    $n = $_GET['n'];

    $ruta_selc_but = RUTA_APP . RUTA_SELC_BUT;
    $pelicula = Pelicula::buscaPelicula($n);
    $imagen = RUTA_APP . '/' . $pelicula->getRutaPoster();
    $contenidoPrincipal = <<< EOS
        <h1>{$pelicula->getTitulo()}</h1>
        <img src = "{$imagen}" alt = 'Póster de la película'>
        <p> Sinopsis: {$pelicula->getSinopsis()} </p>
        <p> Edad mínima: {$pelicula->getPegi()} </p>
        <p> Género:  {$pelicula->getGenero()} </p>
        <p> Duración: {$pelicula->getDuracion()} minutos </p>
        <a href  = "$ruta_selc_but"><button type = 'button'>Seleccionar butacas</button></a>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);