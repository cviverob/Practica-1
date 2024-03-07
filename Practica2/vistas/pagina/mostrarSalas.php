<?php
    require_once('../../includes/config.php');

    $rutaEstilos = '../comun/estilo.css';

    $tituloPagina = 'Selección de butacas';

    // Ver qué usar de aquí

    $contenidoPrincipal = <<< EOS
        $datos = json_decode($json_data, true);

        //obtener el número de filas y columnas, si existe "fila" se le asigna el valor, sino le asigna el valor 0
        $num_filas = isset($datos['filas']) ? intval($datos['filas']) : 0;
        $num_columnas = isset($datos['columnas']) ? intval($datos['columnas']) : 0;

        for($i = 0; $i < $num_filas; $i++){
            for($j = 1; $i <= $num_columnas; $j++){
                echo "$j ";
            }
            echo "\n";
        }

        /*for ($i = 1; $i <= $total_asientos; $i++) {
        if (in_array($i, $asientos_ocupados)) {
            echo "X ";
        } else {
            echo "- ";
        }*/
        ?>

        <p>Pantalla</p>

        <form action="mostrarCompra.php" method="post">
        <input type="submit" value="Ir a página de compra">
        </form>
    EOS;

    require('../comun/plantilla.php');