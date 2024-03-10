<?php
    require_once('../../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);
    require_once(RUTA_RAIZ . RUTA_FORM_PLCL);

    $tituloPagina = 'Añadir película';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        $contenidoPrincipal = $contenidoPrincipal = crearFormularioPelicula();
    }
    require(RUTA_RAIZ . RUTA_PLNT);
  