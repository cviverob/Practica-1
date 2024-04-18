<?php
    require_once('../includes/config.php');

    $tituloPagina = 'Política de privacidad';

    $contenidoPrincipal = <<<EOS
        <div class = "ayuda">
            <p>
                Desde Elmo Cines, valoramos la privacidad de nuestros clientes. Es
                por ello, que el uso de los datos personales del usuario será tratado
                únicamente con el fin del correcto funcionamiento de la página, esto es
                establecer un perfil personalizado y la gestión de compra de entradas.
            </p>
        </div>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);