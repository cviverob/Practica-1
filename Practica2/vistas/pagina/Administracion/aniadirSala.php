<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);
        
    $tituloPagina = 'Añadir sala';

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
        // Si estamos modificando una sala, deben salir los valores de dicha peli
        $ruta_admn = RUTA_ADMN;
        $ruta_mod_sala = RUTA_APP . RUTA_MOD_SALA;
        $contenidoPrincipal = <<< EOS
            <form action = "$ruta_mod_sala" method = "POST">
                <p></p>
                *Sala:
                <input type='text' name='sala' value="" required />
                <p></p>
                *Número de filas:
                <input type = "text" name = "filas" value = "" required />
                <p></p>
                *Número de columnas:
                <input type='text' name='columnas' value="" required />
                <p></p>
                <button type = "submit">Generar</button>
            </form>
            <p></p>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);