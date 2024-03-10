<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);
        
    $tituloPagina = 'Añadir sala';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        // Si estamos modificando una sala, deben salir los valores de dicha peli
        $ruta_admn = RUTA_ADMN;
        $ruta_mod_sala = RUTA_APP . RUTA_MOD_SALA;
        $contenidoPrincipal = <<< EOS
            <form action = "$ruta_mod_sala" method = "POST">
                <p></p>
                *Sala:
                <input type='text' name='sala' value="" required />
                <p></p>
                *Número de filas:
                <input type = "text" name = "filas" value = "" required />
                <p></p>
                *Número de columnas:
                <input type='text' name='columnas' value="" required />
                <p></p>
                <button type = "submit">Generar</button>
            </form>
            <p></p>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);