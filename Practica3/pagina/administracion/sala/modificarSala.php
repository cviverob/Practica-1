<?php

    require_once('../../../includes/config.php');
    
    if (isset($_GET['id'])) {
        $tituloPagina = 'Modificar Sala';
        $formulario2 = new es\ucm\fdi\aw\FormularioButacas($_GET['id']);
        $htmlFormularioButacas = $formulario2->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Modificar sala</h1>
            $htmlFormularioButacas
        EOS;
        
        require_once(RUTA_RAIZ . RUTA_PLNT);
    }
    else {
        echo 'Error al modificar la sala';
        exit();
    }