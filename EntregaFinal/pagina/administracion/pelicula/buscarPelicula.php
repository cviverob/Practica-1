<?php

    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Buscar película';

        $listaPeliculas = es\ucm\fdi\aw\pelicula::getPeliculas();
        $pintar = '';

        $rutaBotonMod = RUTA_APP . RUTA_BTN . '/lapiz.png';
        $rutaBotonBorrar = RUTA_APP . RUTA_BTN . '/cruz.png';

        foreach ($listaPeliculas as $pelicula) {
            $ruta_poster = RUTA_APP . RUTA_PSTR . "/" . $pelicula->getRutaPoster();
            $pintar .= <<< EOS
                
                    <div class="peli1">
                        <div class="peli1_1">
                            <img src = $ruta_poster width = '150' height = '200' class = 'pelisCartelera'>
                        </div>
                        <div class="peli1_2">
                            <form action = 'modificarPelicula.php?id={$pelicula->getId()}' method = 'post'>
                                <button type = 'submit' class = 'RegisterUserButton'><img src = $rutaBotonMod width = '25' height = '25'></button>
                            </form>
                
                
                            <form action = 'borrarPelicula.php' method = 'post'>
                                <input type = 'hidden' name = 'id' value = {$pelicula->getId()}>
                                <button type = 'submit' class = 'ExitUserButton'><img src = $rutaBotonBorrar width = '25' height = '25'></button>
                            </form>
                        </div>
                    </div>
                    
                EOS;
        }

        $contenidoPrincipal = <<< EOS
        <p></p>
        <table class = "listarAdmin">
        $pintar
        </table>
    
        EOS;
        
        require_once(RUTA_RAIZ . RUTA_PLNT);
    }