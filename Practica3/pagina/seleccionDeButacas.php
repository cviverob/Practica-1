<?php
    require_once('../includes/config.php');
    
    $tituloPagina = 'Seleccion de Butacas';

    $ruta_proc_comp = RUTA_APP . RUTA_PROC_COMP;

    $contenidoPrincipal = <<< EOS
        <h1>Selección de butacas</h1>
        <div>
    EOS;

    for($i = 1; $i < 10; $i++){
        $contenidoPrincipal .= "<div>";
        for($j = 1; $j <= 10; $j++){
            $contenidoPrincipal .= "<button type = 'button' class = 'butaca'>$i-$j</button>";
        }
        $contenidoPrincipal .= "</div>";
    }

    $contenidoPrincipal .= <<< EOS
        </div>
        <p></p>
        <a href="$ruta_proc_comp"><button type="button" class="RegisterUserButton">Comprar</button></a>

    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);