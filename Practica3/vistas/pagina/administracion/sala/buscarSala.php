<?php
    require_once('../../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);

    $tituloPagina = 'Buscar sala';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        $ruta_admn = RUTA_APP . RUTA_ADMN;
        $ruta_proc_bsc_sala = RUTA_APP . RUTA_PROC_BSC_SALA;
        $contenidoPrincipal = <<< EOS
            <form action = "$ruta_proc_bsc_sala" method = "POST">
            <p></p>
            Sala:
            <input type='text' name='sala' value="" />
            <p></p>
            Número de filas:
            <input type = "text" name = "filas" value = "" />
            <p></p>
            Número de columnas:
            <input type='text' name='columnas' value="" />
            <p></p>
            <button type = "submit">Buscar</button>
        </form>
        <p></p>
        <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);