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
     * Función que comprueba todos los parámetros del formulario de una sala
     * @param array datos Campos del formulario
     */
    function procesaFormularioSala(&$datos) {
        $errores = [];

        $num_sala = trim($datos['num_sala'] ?? '');
        $num_sala = filter_var($num_sala, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$num_sala || empty($num_sala)) {
            $errores['num_sala'] = 'La sala no puede estar vacía';
        }
        else if (!is_numeric($num_sala)) {
            $errores['num_sala'] = 'La sala debe ser un número';
        }

        $num_filas = trim($datos['num_filas'] ?? '');
        $num_filas = filter_var($num_filas, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$num_filas || empty($num_filas)) {
            $errores['num_filas'] = 'El número de filas no puede estar vacío';
        }
        else if (!is_numeric($num_filas)) {
            $errores['num_filas'] = 'El número de filas debe ser un número';
        }
        else if ($num_filas < 1 || $num_filas > MAX_FILAS) {
            $errores['num_filas'] = 'El número de filas debe ser un número entre 1 y ' . MAX_FILAS;
        }

        $num_columnas = trim($datos['num_columnas'] ?? '');
        $num_columnas = filter_var($num_columnas, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$num_columnas || empty($num_columnas)) {
            $errores['num_columnas'] = 'El número de columnas no puede estar vacío';
        }
        else if (!is_numeric($num_columnas)) {
            $errores['num_columnas'] = 'El número de columnas debe ser un número';
        }
        else if ($num_columnas < 1 || $num_columnas > MAX_COLS) {
            $errores['num_columnas'] = 'El número de columnas debe ser un número entre 1 y ' . MAX_COLS;
        }

        $retorno = ["errores" => $errores, "num_sala" => $num_sala,
            "num_filas" => $num_filas, "num_columnas" => $num_columnas];
        return $retorno;
    }