<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Procesar la Compra';

    $ruta_indx = RUTA_APP . RUTA_INDX;
    $ruta_ticket = RUTA_APP . RUTA_PGN . '/generarPDF.php';

    $idCompra = $_GET["idCompra"] ?? null;
    if ($idCompra) {
        $compra = es\ucm\fdi\aw\compra::buscarPorIdYUsuario($idCompra, $_SESSION["id"]);
        if ($compra) {
            $contenidoPrincipal = <<< EOS
            <h1>Compra efectuada</h1>
            <fieldset>
            <legend>{$compra->getTituloPeli()}</legend>
            <h3>{$compra->getFecha()} a las {$compra->getHora()}</h3>
            <h3>
            EOS;
            foreach ($compra->getButacas() as $b) {
                $contenidoPrincipal .= $b . " " ;
            }
            $contenidoPrincipal .= <<< EOS
            </fieldset>
                </h3>
                <h3>Puedes consultar en tu perfil las entradas o descargarlas aquí</h3>
                <form action = "generarPDF.php" method = "post">
                    <a href="$ruta_ticket?idCompra=$idCompra"class="seleccionarPelicula">Descargar Entradas </a>
                </form>
                <a href="$ruta_indx" class="seleccionarPelicula">Menu principal</a>
            EOS;
        }
    }
    /*
    if ($procesado) {
        $contenidoPrincipal = <<< EOS
            <h1>Compra efectuada</h1>
            <fieldset>
            <legend>{$procesado->getTituloPeli()}</legend>
            <h3>{$procesado->getFecha()} a las {$procesado->getHora()}</h3>
            <h3>
        EOS;
        foreach ($procesado->getButacas() as $b) {
            $contenidoPrincipal .= $b . " " ;
        }
        $contenidoPrincipal .= <<< EOS
        </fieldset>
            </h3>
            <h3>Puedes consultar en tu perfil las entradas o descargarlas aquí</h3>
            <form action = "generarPDF.php" method = "post">
                <button type="submit" class="seleccionarPelicula">Descargar Entradas</button>
            </form>
            <a href="$ruta_indx" class="seleccionarPelicula">Menu principal</a>
        EOS;
    }
    else {
        $contenidoPrincipal = '<h1>No hemos podido procesar tu compra</h1>';
    }
    $contenidoPrincipal = <<< EOS
        <h1>Compra efectuada</h1>
        <p>Puedes consultar en tu perfil las entradas o descargarlas aquí</p>
        <form action = "generarPDF.php" method = "post">
            <button type="submit">Descargar Entradas</button>
        </form>
        <a href = "$ruta_indx"><button type = 'button' class = 'RegisterUserButton'>Volver al menú de principal</button></a>
    EOS;*/

    require_once(RUTA_RAIZ . RUTA_PLNT);        