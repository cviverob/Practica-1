<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    $sala = es\ucm\fdi\aw\salas::buscar($_POST['id']);
    $idButaca = $_POST["idButaca"];
    if ($sala->actualizarButacaAdmin($idButaca)) $estado = $sala->devolverAsiento($idButaca);
    else $estado = false;
    
    $respuesta = array (
        'butaca' => $idButaca,
        'estado' => $estado
    );
    echo json_encode($respuesta);