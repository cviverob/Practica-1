<?php

    require_once('../../../includes/config.php');
    
    if (isset($_GET['id'])) {
        $tituloPagina = 'Añadir Sala';

        $formulario = new es\ucm\fdi\aw\FormularioSala($_GET['id']);
        $htmlFormularioSala = $formulario->gestiona();
        $contenidoPrincipal = <<<EOS
            <h1>Modificar sala</h1>
            $htmlFormularioSala
        EOS;
        
        require(RUTA_RAIZ . RUTA_PLNT);
    }
    else {
        echo 'Error al modificar la sala';
        exit();
    }

    /*$tituloPagina = 'Modificar sala';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        // Poner la matriz en una función
        $ruta_admn = RUTA_APP . RUTA_ADMN;

        $contenidoPrincipal = <<< EOS
            <h1>Selección de butacas</h1>
            <div>
        EOS;

        $filas = $_POST["filas"];
        $columnas = $_POST["columnas"];
        for($i = 1; $i < $filas; $i++){
            $contenidoPrincipal .= "<div>";
            for($j = 1; $j <= $columnas; $j++){
                $contenidoPrincipal .= "<button type = 'button'>$i-$j</button>";
            }
            $contenidoPrincipal .= "</div>";
        }

        $contenidoPrincipal .= <<< EOS
            </div>
            <p></p>
            <a href = "$ruta_admn"><button type = 'button'>Confirmar</button></a>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }*/