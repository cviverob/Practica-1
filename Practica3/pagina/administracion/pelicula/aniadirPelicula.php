<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Añadir película';

        $formulario = new es\ucm\fdi\aw\formularioPelicula();
        $htmlFormularioPelicula = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Añadir película</h1>
            $htmlFormularioPelicula
        EOS;

        require(RUTA_RAIZ . RUTA_PLNT);
    }
  