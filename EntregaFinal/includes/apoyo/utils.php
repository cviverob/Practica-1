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

    /**
     * Función que comprueba si unas entradas son del propio usuario, sino, lo redirige al menú 
     * principal
     * @param int $idUsuario Identificador del usuario de la sesión
     * @param int $idUsuarioEntrada Identificador del dueño de las entradas
     */
    function comprobarEntrada($idUsuario, $idUsuarioEntrada) {
        if ($idUsuario != $idUsuarioEntrada) {
            header('Location: ' . RUTA_APP);
        }
        else {
            return true;
        }
    }