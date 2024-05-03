<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    
    if (comprobarPermisos($_SESSION["esAdmin"])) {
        if (isset($_GET['id'])) {
            $tituloPagina = 'Modificar Sesión';
            $formulario = new es\ucm\fdi\aw\formularioSesion($_GET['id']);
            $htmlFormularioSesion = $formulario->gestiona();
            $contenidoPrincipal = <<<EOS
                <h1>Modificar sesión</h1>
                $htmlFormularioSesion
            EOS;
            require_once(RUTA_RAIZ . RUTA_PLNT);
        }
        else {
            echo 'Error al modificar la sesión';
            exit();
        }
    }