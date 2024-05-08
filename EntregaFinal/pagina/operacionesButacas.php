<?php
    require_once('../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    $sesion = es\ucm\fdi\aw\sesion::buscar($_POST['id']);
    $idButaca = $_POST['idButaca'];
    //intentamos crear una operacion de compra
    $compra = es\ucm\fdi\aw\compra::crear($_SESSION['id'], $sesion->getIdSala(), date("Y-m-d"), date("H:i:s"), '0', '1');
    //si se ha podido crear, no existia ninguno. Si existia, tambien se intenta inserta. Insertamos el idButaca para saber que esta pendiente
    $insertado = $compra->insertarButaca($idButaca);
    $sesion->actualizaButacaSeleccionar($idButaca);
    if ($insertado) {
        
        $estado = $sesion->devolverAsiento($idButaca);
    }
    else $estado = false;

    $respuesta = array (
        'idButaca' => $idButaca,
        'estado' => $estado
    );

    echo json_encode($respuesta);
    ?>