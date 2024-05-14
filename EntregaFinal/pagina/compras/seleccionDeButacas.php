<?php
    require_once('../../includes/config.php');
    
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
                    
                        <fieldset>
                        <legend>Sala</legend>
                        <div class='sala'>
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
                $contenidoPrincipal .= <<< EOS
                    <fieldset class="fieldset-custom">
                        <legend>Significado del color de las butacas</legend>
                        <div class="leyenda">
                            <div class="leyenda-item">
                                <div class="cuadro disponible"></div>
                                <p>Butaca Disponible</p>
                            </div>
                            <div class="leyenda-item">
                                <div class="cuadro seleccionada"></div>
                                <p>Butaca Seleccionada</p>
                            </div>
                            <div class="leyenda-item">
                                <div class="cuadro ocupada"></div>
                                <p>Butaca ocupada</p>
                            </div>
                        </div>
                    </fieldset> 
                EOS;

                $formularioCompra = new es\ucm\fdi\aw\formularioCompra($sesion->getId());
                $contenidoPrincipal .= <<< EOS
                        </fieldset>
                    </div>
                    <div class="separar">
                    {$formularioCompra->gestiona()}
                    </div>
                EOS;
                $rutaSelecButJs = RUTA_APP . RUTA_JS_SELEC_BUT . "?id=$id";
                $scripts = array($rutaSelecButJs);
            }
        }
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);