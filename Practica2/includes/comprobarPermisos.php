<?php
    function comprobarPermisos($esAdmin = false) {
        if ($esAdmin) {
            return null;
        }
        else  {
            $ruta_indx = RUTA_APP . RUTA_INDX;
            return <<< EOS
                <h1>No tienes permisos para usar esta página</h1>
                <a href = "$ruta_indx"><button type = 'button'>Volver al menú principal</button></a>
            EOS;
        }
    }