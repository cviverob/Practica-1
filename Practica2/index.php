<!--
    require_once('./includes/config.php');
    
    /*
        Al hacer require del menu principal, este intenta abrir el config.php pero no lo consigue
        ya que sigue en el contexto de index.php, por lo que de momento dejamos este código duplicado
    */

    /*$tituloPagina = 'Cartelera';

    $ruta_Dune = RUTA_APP . RUTA_PSTR . '/Dune.png';
    $ruta_cons_peli = RUTA_APP . RUTA_CONS_PELI;

    $contenidoPrincipal = <<<EOS
        <p/>
        <img src = "$ruta_Dune" alt = 'Póster de Dune'>
        <p/>
        <a href = "$ruta_cons_peli"><button type = "button">Ir a la peli</button></a>
    EOS;*/

    require('vistas/pagina/menuPrincipal.php');-->

    <?php
    require_once('includes/config.php');
    require_once('src/peliculas/peliculas.php');

    $tituloPagina = 'Cartelera';

    $ruta_Dune = RUTA_APP . RUTA_PSTR . '/Dune.png';
    $ruta_cons_peli = RUTA_APP . RUTA_CONS_PELI;

    $peli = Pelicula::mostrarPeliculas();

    $contenidoPrincipal =<<<EOS
        $peli 
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);