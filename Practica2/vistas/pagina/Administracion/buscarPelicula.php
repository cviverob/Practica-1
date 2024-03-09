<?php
    require_once('../../../includes/config.php');
    require_once('../../../src/peliculas/peliculas.php');
    
    $tituloPagina = 'Buscar película';
    /*
    // Temporal, para tener permisos
    //$_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);

    $usuario = $_SESSION["usuario"];
    if (!!$usuario->esAdmin()) {
        $ruta_menu_prncpl = RUTA_APP . RUTA_MENU_PRNCPL;
        $contenidoPrincipal = <<< EOS
            <h1>No tienes permisos para usar esta página</h1>
            <a href = "$ruta_menu_prncpl"><button type = 'button'>Volver al menú principal</button></a>
        EOS;
    }
    else {*/
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
    //}

    require_once(RUTA_RAIZ . RUTA_PLNT);