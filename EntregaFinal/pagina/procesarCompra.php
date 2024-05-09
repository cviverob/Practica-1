<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Procesar la Compra';

    /* conectado a algo que cree PDFs */
    $ruta_indx = RUTA_APP . RUTA_INDX;
    //esto es para que la compra se finalice
    $procesado = es\ucm\fdi\aw\compra::procesarCompra($_SESSION['id'],$_GET['idSesion']);
    //ahora nos toca actualizar las butacas a ocupadas
    
    if ($procesado) {
        $contenidoPrincipal = <<< EOS
        <h1>Compra efectuada</h1>
        <p>Puedes consultar en tu perfil las entradas o descargarlas aquí</p>
        <form action = "generarPDF.php" method = "post">
            <button type="submit">Descargar Entradas</button>
        </form>
        <a href = "$ruta_indx">Menu principal</a>
    EOS;
    }
    else {
        $contenidoPrincipal = '<h1>No hemos podido procesar tu compra</h1>';
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);        