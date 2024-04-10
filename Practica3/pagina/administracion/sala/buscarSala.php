<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Listar Salas';

        $listaSalas = es\ucm\fdi\aw\salas::getSalas();
        $pintar = '';

        $rutaBorrarSala = RUTA_APP . RUTA_BRR_SALA;
        
        foreach ($listaSalas as $salas) {
            $pintar .= <<<EOS
                <tr>
                <td>{$salas->getNumSala()}</td>
                    <td>
                        <form action = "aniadirSala.php?id={$salas->getId()}" method = "post">
                            <button type = "submit">Mod</button>
                        </form>
                    </td>
                    <td>
                        <form action = "borrarSala.php" method = "post">
                            <input type = "hidden" name = "id" value = {$salas->getId()}>
                            <button type = "submit">Elim</button>
                        </form>
                    </td>
                </tr>"
            EOS;
        }

        $contenidoPrincipal = <<< EOS
        <p></p>
        <table>
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