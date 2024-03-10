<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);
    require_once(RUTA_RAIZ . RUTA_FORM_REG);

    $tituloPagina = 'Proceso de login';

    $nombre = htmlspecialchars(strip_tags($_POST["nombre"]));
    $edad = htmlspecialchars(strip_tags($_POST["edad"]));
    $correo = htmlspecialchars(strip_tags($_POST["correo"]));
    $contraseña = htmlspecialchars(strip_tags($_POST["contraseña"]));
    if (!is_numeric($edad)) {
        $error = "La edad debe ser un número";
    }
    else {
        $usuario = Usuario::crea($nombre, $correo, $contraseña, $edad);
    }   

    if ($usuario) {
        $_SESSION['usuario_nombre'] = $usuario->getNombre();
        $_SESSION['usuario_admin'] = $usuario->esAdmin();
        $_SESSION['usuario_id'] = $usuario->getId();
        $ruta_indx = RUTA_APP . RUTA_INDX;
        $contenidoPrincipal = <<< EOS
            <h1>Bienvenido {$_SESSION["usuario_nombre"]}</h1>
            <a href = "$ruta_indx"><button type = 'button'>Menú principal</button></a>
        EOS;
    }
    else {
        $contenidoPrincipal = <<< EOS
            <h1>Error al registrarse</h1>
            <p>$error</p>
        EOS;
        $contenidoPrincipal .= creaFormularioRegistro($nombre, $edad, $correo, $contraseña);
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);
