<?php

$rutaEstilo = '../comun/estilo.css';
$tituloPagina = 'Procesar la Compra';

    if (!isset($_SESSION["usuario"]) || !$_SESSION["usuario"]) {
        $contenidoPrincipal = <<< EOS
        echo "<h1>Error:</h1>";
        echo "<p>Debes estar registrado para realizar la compra</p>";
        echo "<a href = \"registro.php\"><button type = \"button\">Registrarse</button></a>";
        EOS;
    }/*
    else if (Algún error al seleccionar las butacas) {

    }*/
    else {
        /* conectado a algo que cree PDFs */
        $contenidoPrincipal = <<< EOS
        echo "<h1>Compra efectuada</h1>";
        echo "<p>Puedes consultar en tu perfil las entradas o descargarlas aquí</p>";
        echo "<button type = \"button\">Descargar entradas</button>";
        EOS;
    }

?>