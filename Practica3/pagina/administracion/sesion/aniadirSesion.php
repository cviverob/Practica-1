<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    $tituloPagina = 'Añadir sesión';
    
    if (comprobarPermisos($_SESSION["esAdmin"])) {
        // Si estamos modificando una sesión, deben salir los valores de dicha peli
        $ruta_admn = RUTA_APP . RUTA_ADMN;
        $contenidoPrincipal = <<< EOS
            <form action = "$ruta_admn" method = "POST">
                <p></p>
                *Nombre:
                <input type='text' name='nombre' value="" required />
                <p></p>
                *Sala:
                <input type = "text" name = "sala" value = "" required />
                <p></p>
                *Fecha:
                <input type='text' name='fecha' value="" required />
                <p></p>
                *Hora:
                <input type='text' name='hora' value="" required />
                <p></p>
                Oculto:
                <input type='button' name='ocultoSi' value="Sí" />
                <input type='button' name='ocultoNo' value="No" />
                <p></p>
                *Campo obligatorio
                <p></p>
                <button type = "submit">Confirmar</button>
            </form>
            <p></p>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);