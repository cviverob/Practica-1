<?php
    require_once('../../includes/config.php');

    $tituloPagina = 'Procesar la Compra';

    $ruta_reg = RUTA_APP . RUTA_REG;

    if (!isset($_SESSION["usuario"]) || !$_SESSION["usuario"]) {
        $contenidoPrincipal = <<< EOS
        <h1>Error:</h1>
        <p>Debes estar registrado para realizar la compra</p>
        <a href = "$ruta_reg"><button type = "button">Registrarse</button></a>
        EOS;
    }/*
    else if (Algún error al seleccionar las butacas) {

    }*/
    else {
        /* conectado a algo que cree PDFs */
        $contenidoPrincipal = <<< EOS
        <h1>Compra efectuada</h1>
        <p>Puedes consultar en tu perfil las entradas o descargarlas aquí</p>
        <button type = "button">Descargar entradas</button>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);