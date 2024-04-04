<?php

    require_once('../../../includes/config.php');
    
    if (isset($_POST['id'])) {
<<<<<<< HEAD
        if (es\ucm\fdi\aw\pelicula::borrar($_POST['id'])) {
=======
        $pelicula = es\ucm\fdi\aw\Pelicula::buscar($_POST['id']);
        if ($pelicula && es\ucm\fdi\aw\Pelicula::borrar($_POST['id'])) {
            unlink(RUTA_RAIZ . RUTA_PSTR . "/" . $pelicula->getRutaPoster()); 
            unlink(RUTA_RAIZ . RUTA_TRL . "/" . $pelicula->getRutaTrailer());
>>>>>>> 4224159e4408296b540749ef924fedbecd6dd9dd
            header('location: ' . RUTA_APP . RUTA_ADMN);
        }
    }
    else {
        echo 'Error al borrar la película';
        exit();
    }