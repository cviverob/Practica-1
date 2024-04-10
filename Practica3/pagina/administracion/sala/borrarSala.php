<?php

    require_once('../../../includes/config.php');
    
    if (comprobarPermisos($_SESSION["esAdmin"])) {
        if (isset($_POST['id'])) {
            if (es\ucm\fdi\aw\salas::borrar($_POST['id'])) {
                header('location: ' . RUTA_APP . RUTA_ADMN);
            }
        }
        else {
            echo 'Error al borrar la sala';
            exit();
        }
    }