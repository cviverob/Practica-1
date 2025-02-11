<?php

    require_once('../config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    $sesion = es\ucm\fdi\aw\sesion::buscar($_POST['id']);
    $tituloPeli = es\ucm\fdi\aw\pelicula::buscar($sesion->getIdPelicula());
    $idButaca = $_POST['idButaca'];
    $compra = es\ucm\fdi\aw\compra::crear($_SESSION['id'], $sesion->getId(), $sesion->getIdPelicula(), true);
    
    $estado = $sesion->devolverAsiento($idButaca);
    if ($estado == "disponible") {
        if ($compra->insertarButaca($idButaca)) {
            $sesion->actualizaButacaSeleccionar($idButaca);
        }
        $estado = "seleccionada";
    }
    else if ($compra->estaOcupadaPorMi($idButaca)) {
        $compra->desocuparButaca($idButaca, $_POST['id']);
        $sesion->actualizaButacaSeleccionar($idButaca);
        $estado = "disponible";
    }

    $respuesta = array (
        'idButaca' => $idButaca,
        'estado' => $estado
    );

    echo json_encode($respuesta);