<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Contacta con el personal';

    $formulario = new es\ucm\fdi\aw\formularioContacto();
    $contenidoPrincipal = $formulario->gestiona();

    require_once(RUTA_RAIZ . RUTA_PLNT);