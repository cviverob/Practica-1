<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Buscar sesión';

    // Temporal, para tener permisos
    $_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);

    $usuario = $_SESSION["usuario"];
    if (!$usuario->esAdmin()) {
        $ruta_menu_prncpl = RUTA_APP . RUTA_MENU_PRNCPL;
        $contenidoPrincipal = <<< EOS
            <h1>No tienes permisos para usar esta página</h1>
            <a href = "$ruta_menu_prncpl"><button type = 'button'>Volver al menú principal</button></a>
        EOS;
    }
    else {
        $ruta_proc_bsc_ses = RUTA_APP . RUTA_PROC_BSC_SES;
        $ruta_admn = RUTA_APP . RUTA_ADMN;
        $contenidoPrincipal = <<< EOS
            <form action = "$ruta_proc_bsc_ses" method = "POST">
                <p></p>
                Nombre:
                <input type='text' name='nombre' value="" />
                <p></p>
                Sala:
                <input type = "text" name = "sala" value = "" />
                <p></p>
                Fecha:
                <input type='text' name='fecha' value="" />
                <p></p>
                Hora:
                <input type='text' name='hora' value="" />
                <p></p>
                Duración:
                <input type='text' name='duracion' value="" /> minutos
                <p></p>
                <button type = "submit">Buscar</button>
            </form>
            <p></p>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);