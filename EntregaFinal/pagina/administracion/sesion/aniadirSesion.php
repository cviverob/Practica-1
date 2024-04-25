<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Añadir Sesión';

        if (isset($_GET['id'])) $formulario = new es\ucm\fdi\aw\formularioSesion($_GET['id']);
        else $formulario = new es\ucm\fdi\aw\formularioSesion();

        $htmlFormularioSesion = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Añadir Sesión</h1>
            $htmlFormularioSesion
        EOS;

        require(RUTA_RAIZ . RUTA_PLNT);
    }
  