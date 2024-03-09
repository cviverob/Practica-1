<?php
    require_once('../../../includes/config.php');

    $tituloPagina = 'Logout';
    
    $ruta_menu_prncpl = RUTA_APP . '/index.php';
    echo RUTA_APP . "index.php";

    $contenidoPrincipal = <<< EOS
        <h1>Hasta la próxima!!</h1>
        <a href = "$ruta_menu_prncpl"><button type = 'button'>Volver al menú principal</button></a>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);
    
    unset($_SESSION["usuario"]);
    unset($_SESSION["correo"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["edad"]);
    unset($_SESSION["pelicula"]);
    session_destroy();