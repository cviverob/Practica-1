<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Tabla de salas';

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
        /*
            Aquí se mostrará una tabla con las coincidencias enontradas y sus respectivos datos,
            guardando en la sesión la sala seleccionada para redirigirnos a aniadirPelicula.php
            con los datos de la misma preescritos. Además, dejará borrar una fila.
        */
        $ruta_admn = RUTA_ADMN;
        $ruta_and_sal = RUTA_APP . RUTA_AND_SALA;
        $contenidoPrincipal = <<< EOS
            <h3>Tabla con las coincidencias:<h3>
            <a href = "$ruta_and_sal"><button type = 'button'>Coincidencia 1</button></a>
            <p></p>
            <a href = "$ruta_and_sal"><button type = 'button'>Coincidencia 2</button></a>
            <p></p>
            <a href = "$ruta_and_sal"><button type = 'button'>Coincidencia 3</button></a>
            <p></p>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);