<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Proceso de login';

    $nombre = htmlspecialchars(strip_tags($_POST["nombre"]));
    $edad = htmlspecialchars(strip_tags($_POST["edad"]));
    $correo = htmlspecialchars(strip_tags($_POST["correo"]));
    $contraseña = htmlspecialchars(strip_tags($_POST["contraseña"]));
    $usuario = Usuario::crea($nombre, $correo, $contraseña, $edad);
    $_SESSION["usuario"] = $usuario;
    $_SESSION["nombre"] = $nombre;
    $_SESSION["edad"] = $edad;
    $_SESSION["correo"] = $correo;

    $ruta_indx = RUTA_APP . RUTA_INDX;
    $ruta_reg = RUTA_APP . RUTA_REG;

    if ($_SESSION["usuario"]) {
        $contenidoPrincipal = <<< EOS
            <h1>Bienvenido {$_SESSION["usuario"]->getNombre()}</h1>
            <a href = "$ruta_indx"><button type = 'button'>Menú principal</button></a>
        EOS;
    }
    else {
        $contenidoPrincipal = <<< EOS
            <h1>Error al registrarse</h1>
            <a href = "$ruta_reg"><button type = 'button'>Reintentar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);
