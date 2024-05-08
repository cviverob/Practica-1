<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Añadir Sala';

        if (isset($_GET['id'])) $formulario = new es\ucm\fdi\aw\formularioSala($_GET['id']);
        else $formulario = new es\ucm\fdi\aw\formularioSala();

        $htmlFormularioSala = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Añadir Sala</h1>
            $htmlFormularioSala
        EOS;
        $scripts = array(RUTA_APP . RUTA_JS_FORM);

        require(RUTA_RAIZ . RUTA_PLNT);
    }
  