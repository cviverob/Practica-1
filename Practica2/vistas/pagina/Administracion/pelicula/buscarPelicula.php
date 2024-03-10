<?php
    require_once('../../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_PLCL);
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);
    
    $tituloPagina = 'Buscar película';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        $ruta_proc_bsc_pel = RUTA_APP . RUTA_PROC_BSC_PEL;
        $ruta_admn = RUTA_APP . RUTA_ADMN;
        $info = Pelicula::pintarTablas();
        $contenidoPrincipal = <<< EOS
        <p></p>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Modificar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                $info 
            </tbody>
        </table>
        <p></p>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);