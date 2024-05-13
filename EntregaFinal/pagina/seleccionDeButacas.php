<?php
    require_once('../includes/config.php');
    
    $tituloPagina = 'Seleccion de Butacas';

    $ruta_proc_comp = RUTA_APP . RUTA_PROC_COMP;
    $ruta_reg = RUTA_APP . RUTA_REG;
    
    es\ucm\fdi\aw\compra::eliminarButacasCaducadas();
    if (!isset($_SESSION["login"]) || !$_SESSION["login"]) {
        $contenidoPrincipal = <<< EOS
        <h1>Error:</h1>
        <p>Debes estar registrado para realizar la compra</p>
        <a href = "$ruta_reg"><button type = "button" class = 'RegisterUserButton'>Registrarse</button></a>
        EOS;
    }
    else {
        if (isset($_GET["id"])) {
            $sesion = es\ucm\fdi\aw\sesion::buscar($_GET["id"]);
            $id = $sesion->getId();
            if ($sesion) {
                $contenidoPrincipal = <<< EOS
                    <h1>Selección de butacas</h1>
                    <div>
                        <fieldset>
                        <legend>Sala</legend>
                EOS;
                $sala = es\ucm\fdi\aw\salas::buscar($sesion->getIdSala());

                for ($fila = 1; $fila <= $sala->getNumFilas(); $fila++) {
                    $contenidoPrincipal .= "<div class='fila'>";
                    for ($columna = 1; $columna <=  $sala->getNumColumnas(); $columna++) {
                        $butaca = "$fila-$columna";
                        $estado = $sesion->devolverAsiento($butaca);
                        $enable = $estado == "nulo" ? "disabled" : "";
                        $contenidoPrincipal .= <<<EOS
                            <button type='button' class = "botonButaca" id='$butaca-$estado' 
                                value='$estado' $enable>$fila-$columna</button>
                        EOS;
                    }
                    $contenidoPrincipal .= "</div>";
                }
                $formularioCompra = new es\ucm\fdi\aw\formularioCompra($sesion->getId());
                $contenidoPrincipal .= <<< EOS
                        </fieldset>
                    </div>
                    {$formularioCompra->gestiona()}
                EOS;
                $rutaSelecButJs = RUTA_APP . RUTA_JS_SELEC_BUT . "?id=$id";
                $scripts = array($rutaSelecButJs);
            }
        }
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);