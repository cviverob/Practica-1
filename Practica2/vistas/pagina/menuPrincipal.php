<?php
    require_once(RUTA_RAIZ . 'includes/config.php');

    $tituloPagina = 'Cartelera';

    $ruta_Dune = RUTA_APP . RUTA_PSTR . '/Dune.png';
    $ruta_cons_peli = RUTA_APP . RUTA_CONS_PELI;

    $contenidoPrincipal = <<<EOS
        <p></p>
        <a href = "$ruta_cons_peli"> <img src = "$ruta_Dune" alt = 'Póster de Dune'></a>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);