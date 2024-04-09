<?php

    /**
     * Función que comprueba si un usuario tiene permisos de administrador, y de no
     * tenerlos, lo redirige al menú principal
     * @param boolean esAdmin False si no es admin, true en caso contrario
     */
    function comprobarPermisos($esAdmin = false) {
        if (!$esAdmin)  {
            header('Location: ' . RUTA_APP);
        }
        else {
            return true;
        }
    }