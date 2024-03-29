<?php
    require_once('../../includes/config.php');

    $tituloPagina = 'Logout';
    
    $ruta_indx = RUTA_APP . RUTA_INDX;

    $contenidoPrincipal = <<< EOS
        <h1>Hasta la próxima!!</h1>
        <a href = "$ruta_indx"><button type = 'button'>Volver al menú principal</button></a>
    EOS;
    
    unset($_SESSION["login"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["esAdmin"]);
    unset($_SESSION["modo"]);
    session_destroy();

    require_once(RUTA_RAIZ . RUTA_PLNT);