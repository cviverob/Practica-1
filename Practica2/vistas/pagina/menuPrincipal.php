<?php 
    require_once 'includes/config.php';

    $tituloPagina = 'Cartelera';

    $contenidoPrincipal = <<<EOS
        <p></p>
        <a href = "vistas/pagina/consultaPelicula.php"><img src="img/Posters/Dune.png"></a>
    EOS;

    require('vistas/comun/plantilla.php');