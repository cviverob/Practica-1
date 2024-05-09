<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Buscar película';

        $listaPeliculas = es\ucm\fdi\aw\pelicula::getPeliculas();
        $pintar = '';

        foreach ($listaPeliculas as $pelicula) {
            $pintar .= "
                <tr>
                    <td>{$pelicula->getTitulo()}</td>
                    <td>
                        <form action = 'modificarPelicula.php?id={$pelicula->getId()}' method = 'post'>
                            <button type = 'submit' class = 'RegisterUserButton'>Mod</button>
                        </form>
                    </td>
                    <td>
                        <form action = 'borrarPelicula.php' method = 'post'>
                            <input type = 'hidden' name = 'id' value = {$pelicula->getId()}>
                            <button type = 'submit' class = 'ExitUserButton'>Elim</button>
                        </form>
                    </td>
                </tr>";
        }

        $contenidoPrincipal = <<< EOS
        <p></p>
        <table class = "listarAdmin">
            <thead>
                <tr>
                    <th>Nombre</th>
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