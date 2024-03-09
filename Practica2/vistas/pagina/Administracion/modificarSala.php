<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Modificar sala';
/*
    $usuario = $_SESSION["usuario"];
    if (!$usuario->esAdmin()) {
        $ruta_indx = RUTA_APP . RUTA_INDX;
        $contenidoPrincipal = <<< EOS
            <h1>No tienes permisos para usar esta página</h1>
            <a href = "$ruta_indx"><button type = 'button'>Volver al menú principal</button></a>
        EOS;
    }
    else {*/
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
    //}

    require_once(RUTA_RAIZ . RUTA_PLNT);