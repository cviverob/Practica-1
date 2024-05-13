<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    
    if (comprobarPermisos($_SESSION["esAdmin"])) {
        if (isset($_POST['id'])) {
            if (es\ucm\fdi\aw\pelicula::borrar($_POST['id'])) {
                unlink(RUTA_RAIZ . RUTA_PSTR . "/" . $pelicula->getRutaPoster()); 
                unlink(RUTA_RAIZ . RUTA_TRL . "/" . $pelicula->getRutaTrailer());
                header('location: ' . RUTA_APP . RUTA_ADMN);
            }
        }
        else {
            echo 'Error al borrar la película';
            exit();
        }
    }