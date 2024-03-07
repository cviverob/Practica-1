<?php
    $tituloPagina = 'Logout';

    $contenidoPrincipal = <<< EOS
        <h1>Hasta la próxima!!</h1>
        <a href = 'menuPrincipal.php><button type = 'button'>Volver al menú principal</button></a>
    EOS;

    require_once(RUTA_PLNT);
    
    unset($_SESSION["usuario"]);
    unset($_SESSION["correo"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["edad"]);
    unset($_SESSION["pelicula"]);
    session_destroy();