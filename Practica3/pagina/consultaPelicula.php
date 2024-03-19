<?php
    require_once('../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_PLCL);

    $tituloPagina = 'Consultar película';

    // Faltan las sesiones y el trailer
    
    // Función urlencode extraída del chatgpt para evitar problemas con espacios en la URL
    $n = urldecode($_GET['n']);

    $ruta_selc_but = RUTA_APP . RUTA_SELC_BUT;
    $pelicula = Pelicula::buscaPelicula($n);
    $imagen = $pelicula->getRutaPoster();
    $contenidoPrincipal = <<< EOS
        <h1>{$pelicula->getTitulo()}</h1>
        <div>
            <img src = "$imagen" alt = 'Póster de la película' width = '150' height = '200'>
            <video width = "320" height = "240" controls>
                <source src = "{$pelicula->getRutaTrailer()}" type = "video/mp4">
                Tu navegador no soporta este tipo de vídeo
            </video>
        </div>
        <p> Sinopsis: {$pelicula->getSinopsis()} </p>
        <p> Edad mínima: {$pelicula->getPegi()} </p>
        <p> Género:  {$pelicula->getGenero()} </p>
        <p> Duración: {$pelicula->getDuracion()} minutos </p>
        <a href  = "$ruta_selc_but"><button type = 'button'>Seleccionar butacas</button></a>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);