<?php
    require_once('../../includes/config.php');

    $rutaEstilos = '../comun/estilo.css';

    $tituloPagina = 'Consulta de películas';

    // Ver Qué usar de aquí

    $contenidoPrincipal = <<< EOS
        $fecha = new DateTime();

        echo $fecha_actual->format('m-d'); ?>

        <img src = "../../img/Poster_UP.png" alt = "Poster UP">
        <textarea>Descripción de la peli</textarea>
        <p>Duración        Género      Edad min</p>

        {$fecha_actual->format('H:i')}

        <form action="mostrarSalas.php" method="post">
        <input type="submit" value="Ir a comprar asientos">
        </form>

        <?php require("../comun/pie.php") ?>
    EOS;

    require('../comun/plantilla.php');