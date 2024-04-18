<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    
    if (comprobarPermisos($_SESSION["esAdmin"])) {
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
    }