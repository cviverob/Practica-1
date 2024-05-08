<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Consultar película';

    // Faltan las sesiones y el trailer

    if (!(isset($_SESSION["login"]) || !$_SESSION["login"])) {
        $comprobarCompra = es\ucm\fdi\aw\compra::eliminaSiCompraEstaPendiente($_SESSION['id'], $_GET['idSesion']);
    }
    
    $pelicula = es\ucm\fdi\aw\pelicula::buscar($_GET['idSesion']);
    $poster = RUTA_APP . RUTA_PSTR . '/' . $pelicula->getRutaPoster();
    $trailer = RUTA_APP . RUTA_TRL . '/' . $pelicula->getRutaTrailer();
    $contenidoPrincipal = <<< EOS
        <h1 class = "texto">{$pelicula->getTitulo()}</h1>
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
    EOS;
    $listaSesiones = es\ucm\fdi\aw\sesion::getSesiones();
    foreach ($listaSesiones as $sesion) {
        if ($sesion->getIdPelicula() == $pelicula->getId() && $sesion->getVisibilidad()) {
            $fechaYHora = $sesion->getFecha() . " | " . $sesion->getHoraIni();
            $ruta_selc_but = RUTA_APP . RUTA_SELC_BUT . "?id=" . $sesion->getId();
            $contenidoPrincipal .= <<< EOS
                <a href = $ruta_selc_but class = "seleccionarPelicula">$fechaYHora</a>
            EOS;
        }
    }
    require_once(RUTA_RAIZ . RUTA_PLNT);