<?php
    require_once('../../../includes/config.php');

    $tituloPagina = 'Login';

    // Ver por qué no funciona
    // $correo = isset($_SESSION["correo"]) ?? "";

    // Usar div en vez de <p></p>
    // Hacer función para generar formulario, que reciba un parámetro y se pueda llamar en procesarLogin

    $ruta_proc_log = RUTA_APP . RUTA_PROC_LOG;
    $ruta_reg = RUTA_APP . RUTA_REG;

    $contenidoPrincipal = <<< EOS
        <form action = "$ruta_proc_log" method = "POST">
            <p></p>
            <a href = ""><button type = "button">Conectarse</button></a>
            <a href = "$ruta_reg"><button type = "button">Registrarse</button></a>
            <p></p>
            *Correo:
            <input type='text' name='correo' value="" required />
            <p></p>
            *Contraseña:
            <input type = "password" name = "contraseña" value = "" required />
            <p></p>
            *Campo obligatorio
            <p></p>
            <button type = "submit">Iniciar sesión</button>
        </form>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);