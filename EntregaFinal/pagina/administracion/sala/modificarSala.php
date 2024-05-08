<?php 

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    
    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $id = $_GET['id'];
        if (isset($id)) {
            // Parte de los campos del número de sala y número filas, y columnas
            $tituloPagina = 'Modificar Sala';
            $formulario = new es\ucm\fdi\aw\formularioSala($id);
            $htmlFormularioButacas = $formulario->gestiona();
            $contenidoPrincipal = <<<EOS
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Sala de Cine Interactiva</title>
                </head>
                <body>
                    <h1>Modificar sala</h1>
                    $htmlFormularioButacas
                    <fieldset>
                    <legend>Sala</legend>
                    <div id="sala">
            EOS;
            // Parte de la sala en sí
            $sala = es\ucm\fdi\aw\salas::buscar($id);
            if (!$sala) {
                echo("Sala no encontrada");
                exit();
            }
            for ($fila = 1; $fila <= $sala->getNumFilas(); $fila++) {
                $contenidoPrincipal .= "<div class='fila'>";
                for ($columna = 1; $columna <=  $sala->getNumColumnas(); $columna++) {
                    $butaca = "$fila-$columna";
                    $estado = $sala->devolverAsiento($butaca);
                    $valorBoton = ($estado == "disponible") ? "disponible" : "nulo";
                    $contenidoPrincipal .= "<button type='button' class='botonButaca' id='$butaca' value='$valorBoton'>$fila-$columna</button>";
                }
                $contenidoPrincipal .= "</div>";
            }
            $rutaAdmin = RUTA_APP . RUTA_ADMN;
            $contenidoPrincipal .= <<<EOS
                </div>
                </fieldset>
                <div>
                    <a href = $rutaAdmin class ="seleccionarPelicula">Terminar</a>
                </div>
                </body>
                </html>
            EOS;
            $rutaButJs = RUTA_APP . RUTA_JS_BUT . "?id=" . $id;
            $scripts = array(RUTA_APP . RUTA_JS_FORM, $rutaButJs);
    
            require_once(RUTA_RAIZ . RUTA_PLNT);
        } else {
            echo 'Error al modificar la sala';
            exit();
        }
    }
    ?>
    
    
