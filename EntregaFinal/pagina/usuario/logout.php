<?php
    require_once('../../includes/config.php');

    $tituloPagina = 'Logout';
    
    $ruta_indx = RUTA_APP . RUTA_INDX;

    $urlImagen = RUTA_APP . RUTA_GIFS . '/adios.gif';

    $contenidoPrincipal = <<< EOS
        <div class="containerLogout">
            <h1>Hasta la próxima!!</h1>
            <img src="$urlImagen" alt="Imagen de ejemplo" width="200" height="200" class="gif">
            <br> <!-- Insertar un salto de línea antes del enlace -->
            <a href="$ruta_indx"><button type="button" class="seleccionarPelicula">Volver al menú principal</button></a>
        </div>
    EOS;

    if (isset($_SESSION['idSesion']) && isset($_SESSION['id'])) es\ucm\fdi\aw\compra::eliminaSiCompraEstaPendiente($_SESSION['id'], $_SESSION['idSesion']);
    
    unset($_SESSION['idSesion']);
    unset($_SESSION["login"]);
    unset($_SESSION['id']);
    unset($_SESSION["nombre"]);
    unset($_SESSION["esAdmin"]);
    unset($_SESSION["modo"]);
    session_destroy();

    require_once(RUTA_RAIZ . RUTA_PLNT);
?>
