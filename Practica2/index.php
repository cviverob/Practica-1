<?php
    // Este fichero hará la función del menú principal, donde se muestra la cartelera

    require_once('includes/config.php');
    require_once(RUTA_RAIZ . RUTA_PLCL);

    $_SESSION['modo'] = "usuario";

    $tituloPagina = 'Cartelera';

    $ruta_Dune = RUTA_APP . RUTA_PSTR . '/Dune.png';
    $ruta_cons_peli = RUTA_APP . RUTA_CONS_PELI;

    $peli = Pelicula::mostrarPeliculas();

    $contenidoPrincipal =<<<EOS
        <h1>Cartelera</h1>
        $peli 
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);