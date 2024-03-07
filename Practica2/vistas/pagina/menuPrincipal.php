<?php 
    $rutaEstilos = '../comun/estilo.css';
    $tituloPagina = 'Cartelera';

    $contenidoPrincipal = <<<EOS
        <img src = "../../img/Dune.png"><p></p>
        <a href = "consultaPelicula.php"><button type = "button">Ir a la peli</button>
    EOS;

    require '../comun/plantilla.php';