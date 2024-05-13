<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Listar Salas';

        $listaSalas = es\ucm\fdi\aw\salas::getSalas();
        $pintar = '';

        $rutaBorrarSala = RUTA_APP . RUTA_BRR_SALA;

        $rutaBotonMod = RUTA_APP . RUTA_BTN . '/lapiz.png';
        $rutaBotonBorrar = RUTA_APP . RUTA_BTN . '/cruz.png';
        
        foreach ($listaSalas as $salas) {
            $rutaModificarSala = RUTA_APP . RUTA_MOD_SALA . "?id=" . $salas->getId();
            $pintar .= <<<EOS
                <tr>
                <td>{$salas->getNumSala()}</td>
                    <td>
                        <form action = $rutaModificarSala method = "post">
                            <button type = "submit" class = "adminMod"><img src = $rutaBotonMod width = '25' height = '25'></button>
                        </form>
                    </td>
                    <td>
                        <form action = $rutaBorrarSala method = "post">
                            <input type = "hidden" name = "id" value = {$salas->getId()}>
                            <button type = "submit" class = "adminDelete"><img src = $rutaBotonBorrar width = '25' height = '25'></button>
                        </form>
                    </td>
                </tr>
            EOS;
        }

        $contenidoPrincipal = <<< EOS
            <p></p>
            <table class = "listarAdmin">
                <thead>
                    <tr>
                        <th>Número de sala</th>
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