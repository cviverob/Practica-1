<?php
    require_once('../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    $sesion = es\ucm\fdi\aw\sesion::buscar($_POST['id']);
    $idButaca = $_POST['idButaca'];

    //comprobar que esa butaca esta disponible
    if ($sesion->comprobarSeleccionada($idButaca) && $sesion->actualizaButacaSeleccionar($idButaca)) $estado = $sesion->devolverAsiento($idButaca);
    else $estado = false;

    //si esta disponible intentamos crear una operacion de compra
    $compra = es\ucm\fdi\aw\compra::crear($_SESSION['id'], $sesion->getId(), date("Y-m-d"), date("H:i:s"), '0', '1');
    //si se ha podido crear, no existia ninguno. Si existia, tambien se inserta. Insertamos el idButaca para saber que esta pendiente
    $insertado = $compra->insertarButaca($idButaca);

    $respuesta = array (
        'idButaca' => $idButaca,
        'estado' => $estado
    );

    echo json_encode($respuesta);