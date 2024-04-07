<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Añadir Sala';

        if (isset($_GET['id'])) $formulario = new es\ucm\fdi\aw\FormularioSala($_GET['id']);
        else $formulario = new es\ucm\fdi\aw\FormularioSala();

        $htmlFormularioSala = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Añadir Sala</h1>
            $htmlFormularioSala
        EOS;

        require(RUTA_RAIZ . RUTA_PLNT);
    }
  