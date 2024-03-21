<?php

    require_once('../../../includes/config.php');
    
    if (isset($_POST['id'])) {
        if (es\ucm\fdi\aw\Pelicula::borrar($_POST['id'])) {
            header('location: ' . RUTA_APP . RUTA_ADMN);
        }
    }
    echo 'Error al borrar la película';
    exit();