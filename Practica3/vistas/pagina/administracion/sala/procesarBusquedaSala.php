<?php
    require_once('../../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);

    $tituloPagina = 'Tabla de salas';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
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