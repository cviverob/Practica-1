<?php
    // Este fichero hará la función del menú principal, donde se muestra la cartelera

    require_once('includes/config.php');
    require_once(RUTA_RAIZ . RUTA_PLCL);

    $_SESSION['modo'] = "usuario";

    $tituloPagina = 'Cartelera';

    $peli = Pelicula::getPeliculas();
    $pintar = '';

    // Función urlencode extraída del chatgpt para evitar problemas con espacios en la URL
    foreach ($peli as $p) {
        $pintar .= "<a href = " . RUTA_APP . RUTA_CONS_PELI . "?n=" . urlencode($p->getTitulo()) . " ><img src = '". $p->getRutaPoster() ."' width = '150' height = '200'></a>";
    }
    $contenidoPrincipal =<<<EOS
        <h1>Cartelera</h1>
        $pintar
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);