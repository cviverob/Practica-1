<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    
    if (comprobarPermisos($_SESSION["esAdmin"])) {
        if (isset($_POST['id'])) {
            if (es\ucm\fdi\aw\sesion::borrar($_POST['id'])) {
                header('location: ' . RUTA_APP . RUTA_ADMN);
            }
        }
        else {
            echo 'Error al borrar la sala';
            exit();
        }
    }