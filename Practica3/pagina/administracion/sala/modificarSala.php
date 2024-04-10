<?php

    require_once('../../../includes/config.php');
    
    if (isset($_GET['id'])) {
        // Parte de los campos del número de sala y número filas, y columnas
        $tituloPagina = 'Modificar Sala';
        $formulario = new es\ucm\fdi\aw\formularioSala($_GET['id']);
        $htmlFormularioButacas = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Modificar sala</h1>
            $htmlFormularioButacas
        EOS;
        // Parte de la sala en sí
        $sala = es\ucm\fdi\aw\salas::buscar($_GET['id']);
        if (!$sala) {
            echo("Sala no encontrada");
            exit();
        }
        $contenidoPrincipal .= <<<EOS
            <fieldset>
            <legend>Sala</legend>
            <div class = "contenedor-butacas">
        EOS;
        for ($fila = 1; $fila <= $sala->getNumFilas(); $fila++) {
            $contenidoPrincipal .= "<div class = fila-butacas'>";
            for ($columna = 1; $columna <=  $sala->getNumColumnas(); $columna++) {
                $formButaca = new es\ucm\fdi\aw\formularioButaca($sala, $fila, $columna);
                $contenidoPrincipal .= $formButaca->gestiona();
            }
            $contenidoPrincipal .= "</div>";
        }
        $rutaAdmin = RUTA_APP . RUTA_ADMN;
        $contenidoPrincipal .= <<<EOS
            </div>
            </fieldset>
            <div>
                <a href = $rutaAdmin>Terminar</a>
            </div>
        EOS;

        require_once(RUTA_RAIZ . RUTA_PLNT);
    }
    else {
        echo 'Error al modificar la sala';
        exit();
    }