<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Consultar película';

    // Faltan las sesiones y el trailer
    
    // Función urlencode extraída del chatgpt para evitar problemas con espacios en la URL
    
    $ruta_selc_but = RUTA_APP . RUTA_SELC_BUT;
    $pelicula = es\ucm\fdi\aw\Pelicula::buscar($_GET['id']);
    $poster = RUTA_APP . RUTA_PSTR . '/' . $pelicula->getRutaPoster();
    $trailer = RUTA_APP . RUTA_TRL . '/' . $pelicula->getRutaTrailer();
    $contenidoPrincipal = <<< EOS
        <h1>{$pelicula->getTitulo()}</h1>
        <div class = "pelicula">
            <img src = $poster alt = 'Póster de la película' width = '150' height = '210'>
            <video width = "320" height = "240" controls>
                <source src = $trailer type = "video/mp4">
                Tu navegador no soporta este tipo de vídeo
            </video>
        <p><span class="first-word">Sinopsis: </span>{$pelicula->getSinopsis()} </p>
        <p><span class="first-word">PEGI: </span>{$pelicula->getPegi()} </p>
        <p><span class="first-word">Género: </span>{$pelicula->getGenero()} </p>
        <p><span class="first-word">Duración: </span>{$pelicula->getDuracion()} minutos </p>
        </div>
        <a href="$ruta_selc_but" class="seleccionarPelicula">Seleccionar butacas</a>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);