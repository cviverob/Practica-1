<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);
    require_once(RUTA_RAIZ . RUTA_FORM_LGIN);

    $tituloPagina = 'Proceso de login';

    $correo = htmlspecialchars(strip_tags($_POST["correo"]));
    $contraseña = htmlspecialchars(strip_tags($_POST["contraseña"]));
    $usuario = Usuario::login($correo, $contraseña);

    $ruta_indx = RUTA_APP . RUTA_INDX;
    $ruta_lgin = RUTA_APP . RUTA_LGIN;

    if ($usuario) {
        $_SESSION['usuario_nombre'] = $usuario->getNombre();
        $_SESSION['usuario_admin'] = $usuario->esAdmin();
        $_SESSION['usuario_id'] = $usuario->getId();
        $contenidoPrincipal = <<< EOS
            <h1>Bienvenido {$_SESSION["usuario_nombre"]}</h1>
            <a href = "$ruta_indx"><button type = "button">Menú principal</button></a>
        EOS;
    }
    else {
        $contenidoPrincipal = <<< EOS
            <h1>Error al logearse</h1>
        EOS;
        $contenidoPrincipal .= creaFormularioLogin($correo);
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);