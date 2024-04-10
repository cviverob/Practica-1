<?php
    require_once('../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    
    $_SESSION['modo'] = "admin";

    if (comprobarPermisos($_SESSION["esAdmin"])) {
        $tituloPagina = 'Administración';

        $ruta_and_pel = RUTA_APP . RUTA_AND_PEL;
        $ruta_bsc_pel = RUTA_APP . RUTA_BSC_PEL;
        $ruta_and_ses = RUTA_APP . RUTA_AND_SES;
        $ruta_bsc_ses = RUTA_APP . RUTA_BSC_SES;
        $ruta_and_sal = RUTA_APP . RUTA_AÑD_SALA;
        $ruta_bsc_sal = RUTA_APP . RUTA_BSC_SALA;
        $contenidoPrincipal = <<< EOS

            <h2>Gestión de películas</h2>
            <a href="$ruta_and_pel" class="adminButton">Añadir</a>
            <a href="$ruta_bsc_pel" class="adminButton">Buscar</a>

            <h2>Gestión de cartelera</h2>
            <a href="$ruta_and_ses" class="adminButton">Añadir</a>
            <a href="$ruta_bsc_ses" class="adminButton">Buscar</a>

            <h2>Gestión de salas</h2>
            <a href="$ruta_and_sal" class="adminButton">Añadir</a>
            <a href="$ruta_bsc_sal" class="adminButton">Buscar</a>

            <p></p>
        EOS;
        
        require_once(RUTA_RAIZ . RUTA_PLNT);
    }