<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Listar Sesiones';

        $listaSesiones = es\ucm\fdi\aw\sesion::getSesiones();
        $pintar = '';

        $rutaBorrarSesion = RUTA_APP . RUTA_BRR_SES;
        
        foreach ($listaSesiones as $sesion) {
            $pintar .= <<<EOS
                <tr>
                <td>{$sesion->getId()}</td>
                    <td>
                        <form action = "aniadirSesion.php?id={$sesion->getId()}" method = "post">
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
                    <th>Id de la sesión</th>
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