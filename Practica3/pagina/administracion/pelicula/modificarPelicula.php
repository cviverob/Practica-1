<?php

    require_once('../../../includes/config.php');
    
    if (isset($_GET['id'])) {
        $tituloPagina = 'Añadir película';

        $formulario = new es\ucm\fdi\aw\formularioPelicula($_GET['id']);
        $htmlFormularioPelicula = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Modificar película</h1>
            $htmlFormularioPelicula
        EOS;
        
        require(RUTA_RAIZ . RUTA_PLNT);
    }
    else {
        echo 'Error al modificar la película';
        exit();
    }