<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_FORM_LGIN);

    $tituloPagina = 'Login';

    $contenidoPrincipal = creaFormularioLogin();

    require_once(RUTA_RAIZ . RUTA_PLNT);