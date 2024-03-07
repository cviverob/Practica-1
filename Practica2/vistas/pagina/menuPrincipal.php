<?php 
    require_once 'includes/config.php';

    $tituloPagina = 'Cartelera';

    $contenidoPrincipal = <<<EOS
        <img src="img/Posters/Dune.png"><p></p>
        <a href = "vistas/pagina/consultaPelicula.php"><button type = "button">Ir a la peli</button>
    EOS;

    require('vistas/comun/plantilla.php');