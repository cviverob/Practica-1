<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Política de cookies';

    $contenidoPrincipal = <<<EOS
        <div class = "ayuda">
            <p>Nuestra página no dispone de cookies :D</p>
        </div>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);