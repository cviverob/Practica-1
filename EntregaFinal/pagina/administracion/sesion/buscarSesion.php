<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Listar Sesiones';

        $listaSesiones = es\ucm\fdi\aw\sesion::getSesiones();
        $pintar = '';

        $rutaBorrarSesion = RUTA_APP . RUTA_BRR_SES;
        
        foreach ($listaSesiones as $sesion) {
            $rutaModificarSesion = RUTA_APP . RUTA_MOD_SES . "?id=" . $sesion->getId();
            $sala = es\ucm\fdi\aw\salas::buscar($sesion->getIdSala());
            $descripcionSesion = "Sala " . $sala->getNumSala() . " " . $sesion->getFecha() . 
                " " . $sesion->getHoraIni() . "-" . $sesion->getHoraFin();
            $pintar .= <<<EOS
                <tr>
                <td>$descripcionSesion</td>
                    <td>
                        <form action = "$rutaModificarSesion" method = "post">
                            <button type = "submit">Mod</button>
                        </form>
                    </td>
                    <td>
                        <form action = "$rutaBorrarSesion" method = "post">
                            <input type = "hidden" name = "id" value = {$sesion->getId()}>
                            <button type = "submit">Elim</button>
                        </form>
                    </td>
                </tr>
            EOS;
        }

        $contenidoPrincipal = <<< EOS
        <p></p>
        <table>
            <thead>
                <tr>
                    <th>Sesión</th>
                    <th>Modificar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                $pintar
            </tbody>
        </table>
        <p></p>
        EOS;
        
        require_once(RUTA_RAIZ . RUTA_PLNT);
    }