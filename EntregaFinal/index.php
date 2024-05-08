<?php
    // Este fichero hará la función del menú principal, donde se muestra la cartelera

    require_once('includes/config.php');

    $_SESSION['modo'] = "usuario";

    $tituloPagina = 'Cartelera';

    if (isset($_SESSION['idSesion']) && isset($_SESSION['id'])) $comprobarCompra = es\ucm\fdi\aw\compra::eliminaSiCompraEstaPendiente($_SESSION['id'], $_SESSION['idSesion']);

    $peli = es\ucm\fdi\aw\pelicula::getPeliculas();
    $pintar = '';
    foreach ($peli as $p) {
        $pintar .= "<a href = " . RUTA_APP . RUTA_CONS_PELI . "?idSesion=" . $p->getId() . 
        " ><img src = '". RUTA_APP . RUTA_PSTR . '/' . $p->getRutaPoster() ."' width = '150' height = '200' class = 'pelisCartelera'></a> ";
    }
    $contenidoPrincipal =<<<EOS
        <h1 class = "texto">Cartelera</h1>
        $pintar
    EOS;
    
    require_once(RUTA_RAIZ . RUTA_PLNT);