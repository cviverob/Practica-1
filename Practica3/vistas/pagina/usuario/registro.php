<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_FORM_REG);

    $tituloPagina = 'Registro';

    $contenidoPrincipal = creaFormularioRegistro();

    require_once(RUTA_RAIZ . RUTA_PLNT);