<?php
    require_once('../../../includes/config.php');

    $tituloPagina = 'Registro';

    // Ver por qué no funciona
    // $nombre = isset($_SESSION['nombre']) ?? '';
    // $edad = isset($_SESSION['edad']) ?? '';
    // $correo = isset($_SESSION['correo']) ?? '';

    $ruta_proc_reg = RUTA_APP . RUTA_PROC_REG;
    $ruta_lgin = RUTA_APP . RUTA_LGIN;

    $contenidoPrincipal = <<< EOS
        <form action = "$ruta_proc_reg" method = "post">
        <p></p>
        <a href = "$ruta_lgin"><button type = "button">Conectarse</button></a>
        <a href = ""><button type = "button">Registrarse</button></a>
        <p></p>
        *Nombre:
        <input type="text" name="nombre" value="" required />
        <p></p>
        *Edad:
        <input type="text" name="edad" value="" required />
        <p></p>
        *Correo:
        <input type="text" name="correo" value="" required />
        <p></p>
        *Contraseña:
        <input type = "password" name = "contraseña" value = "" required />
        <p></p>
        *Campo obligatorio
        <p></p>
        <button type = "submit">Registrarse</button>
        </form>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);