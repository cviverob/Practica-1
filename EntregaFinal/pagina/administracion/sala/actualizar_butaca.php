<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    $sala = es\ucm\fdi\aw\salas::buscar($_POST['id']);
    $butaca = $_POST['butaca'];
    if ($sala->actualizarButacaAdmin($butaca)) $estado = $sala->devolverAsiento($butaca);
    else $estado = false;
    
    $respuesta = array (
        //'fila' => $fila,
        //'columna' => $columna,
        'estado' => $estado
    );
    echo json_encode($respuesta);
    ?>