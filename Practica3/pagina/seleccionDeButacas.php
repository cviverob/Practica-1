<?php
    require_once('../includes/config.php');
    
    $tituloPagina = 'Seleccion de Butacas';

    $ruta_proc_comp = RUTA_APP . RUTA_PROC_COMP;

    $contenidoPrincipal = <<< EOS
        <h1>Selección de butacas</h1>
        <div>
    EOS;

    $datos = es\ucm\fdi\aw\salas::buscar(50);
    $contenidoPrincipal .= "<h2> Sala </h2>";
    
    $cont = 0;
    /*for($j = 0; $j < $datos->getNumColumnas(); $j++) {
        $cont++;
        $contenidoPrincipal .= $cont . " ";
        
    }*/
    
    for($i = 1; $i <= $datos->getNumFilas(); $i++){
        $contenidoPrincipal .= "<div>";
        for($j = 1; $j <= $datos->getNumColumnas(); $j++){
            $ocupado = es\ucm\fdi\aw\salas::devolverAsiento($datos, $i, $j);
            $contenidoPrincipal .= "<button type = 'button' class = 'botoneee'>{$ocupado}</button>";
        }
        $contenidoPrincipal .= "</div>";
    }

    $contenidoPrincipal .= <<< EOS
        </div>
        <p></p>
        <a href="$ruta_proc_comp"><button type="button" class="RegisterUserButton">Comprar</button></a>

    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);