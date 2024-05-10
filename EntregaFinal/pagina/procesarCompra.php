<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Procesar la Compra';

    $idCompra = $_GET["idCompra"] ?? null;
    if ($idCompra) {
        $compra = es\ucm\fdi\aw\compra::buscar($idCompra);
        if ($compra &&
            ($sesion = es\ucm\fdi\aw\sesion::buscar($compra->getIdSesion())) &&
            ($peli = es\ucm\fdi\aw\pelicula::buscar($compra->getIdPeli()))
            ) {
            $contenidoPrincipal = <<< EOS
            <h1>Compra efectuada</h1>
            <fieldset>
            <legend>{$peli->getTitulo()}</legend>
            <h3>{$sesion->getFecha()} a las {$sesion->getHoraIni()}</h3>
            <h3>
            EOS;
            foreach ($compra->getButacas() as $b) {
                $contenidoPrincipal .= $b . " " ;
            }
            $ruta_indx = RUTA_APP . RUTA_INDX;
            $ruta_ticket = RUTA_APP . RUTA_PGN . '/generarPDF.php?idCompra=' . $idCompra;
            $contenidoPrincipal .= <<< EOS
            </fieldset>
                </h3>
                <h3>Puedes consultar en tu perfil las entradas o descargarlas aquí</h3>
                <a href = "$ruta_ticket" class = "seleccionarPelicula">Descargar entradas</a>
                <a href="$ruta_indx" class="seleccionarPelicula">Menu principal</a>
            EOS;
        }
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);        