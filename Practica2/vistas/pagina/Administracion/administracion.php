<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Administración';

    // Temporal, para tener permisos
    //$_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);

    /*$usuario = $_SESSION["usuario"];
    if (!!$usuario->esAdmin()) {
        $ruta_menu_prncpl = RUTA_APP . RUTA_MENU_PRNCPL;
        $contenidoPrincipal = <<< EOS
            <h1>No tienes permisos para usar esta página</h1>
            <a href = "$ruta_menu_prncpl"><button type = 'button'>Volver al menú principal</button></a>
        EOS;
    }
    else {*/
        $ruta_and_pel = RUTA_APP . RUTA_AND_PEL;
        $ruta_bsc_pel = RUTA_APP . RUTA_BSC_PEL;
        $ruta_and_ses = RUTA_APP . RUTA_AND_SES;
        $ruta_bsc_ses = RUTA_APP . RUTA_BSC_SES;
        $ruta_and_sal = RUTA_APP . RUTA_AND_SALA;
        $ruta_bsc_sal = RUTA_APP . RUTA_BSC_SALA;
        $contenidoPrincipal = <<< EOS
            <h2>Gestión de películas<h2>
            <a href = "$ruta_and_pel"><button type = 'button'>Añadir</button></a>
            <a href = "$ruta_bsc_pel"><button type = 'button'>Buscar</button></a>
            <h2>Gestión de cartelera<h2>
            <a href = "$ruta_and_ses"><button type = 'button'>Añadir</button></a>
            <a href = "$ruta_bsc_ses"><button type = 'button'>Buscar</button></a>
            <h2>Gestión de salas<h2>
            <a href = "$ruta_and_sal"><button type = 'button'>Añadir</button></a>
            <a href = "$ruta_bsc_sal"><button type = 'button'>Buscar</button></a>
        EOS;
    //}

    require_once(RUTA_RAIZ . RUTA_PLNT);