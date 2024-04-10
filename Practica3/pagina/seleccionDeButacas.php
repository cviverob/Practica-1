<?php
    require_once('../includes/config.php');
    
    $tituloPagina = 'Seleccion de Butacas';

    $ruta_proc_comp = RUTA_APP . RUTA_PROC_COMP;

    $contenidoPrincipal = <<< EOS
        <h1>Selección de butacas</h1>
        <div>
            <fieldset>
            <legend>Sala</legend>
    EOS;
    
    for($fila = 1; $fila <= 10; $fila++){
        $contenidoPrincipal .= "<div>";
        for($columna = 1; $columna <= 10; $columna++){
            $contenidoPrincipal .= "<button type = 'button' class = 'botonButaca'>$fila-$columna</button>";
        }
        $contenidoPrincipal .= "</div>";
    }

    $contenidoPrincipal .= <<< EOS
            </fieldset>
        </div>
        <div>
            <a href="$ruta_proc_comp"><button type="button" class="seleccionarPelicula">Comprar</button></a>
        </div>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);