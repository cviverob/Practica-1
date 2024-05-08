<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Añadir Sesión';

        $formulario = new es\ucm\fdi\aw\formularioSesion();
        $htmlFormularioSesion = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Añadir Sesión</h1>
            $htmlFormularioSesion
        EOS;
        $scripts = array(RUTA_APP . RUTA_JS_FORM);

        require(RUTA_RAIZ . RUTA_PLNT);
    }
  