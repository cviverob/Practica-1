<?php
    require_once('../includes/config.php');
    
    $tituloPagina = 'Seleccion de Butacas';

    $ruta_proc_comp = RUTA_APP . RUTA_PROC_COMP;

    if (isset($_GET["id"])) {
        $sesion = es\ucm\fdi\aw\sesion::buscar($_GET["id"]);
        if ($sesion) {
            $contenidoPrincipal = <<< EOS
                <h1>Selección de butacas</h1>
                <div>
                    <fieldset>
                    <legend>Sala</legend>
            EOS;
            $sala = es\ucm\fdi\aw\salas::buscar($sesion->getIdSala());
            for ($fila = 1; $fila <= $sala->getNumFilas(); $fila++) {
                $contenidoPrincipal .= "<div class = fila-butacas'>";
                for ($columna = 1; $columna <= $sala->getNumColumnas(); $columna++) {
                    $formButaca = new es\ucm\fdi\aw\formularioButaca($sala, $fila, $columna, $sesion, RUTA_SELC_BUT);
                    $contenidoPrincipal .= "<div class = 'crearSala'>" . $formButaca->gestiona() . "</div>";
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
        }
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);