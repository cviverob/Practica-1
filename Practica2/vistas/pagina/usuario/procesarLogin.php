<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Proceso de login';

    $correo = htmlspecialchars(strip_tags($_POST["correo"]));
    $contraseña = htmlspecialchars(strip_tags($_POST["contraseña"]));
    $usuario = Usuario::login($correo, $contraseña);
    $_SESSION["usuario"] = $usuario;
    $_SESSION["correo"] = $correo;

    $ruta_indx = RUTA_APP . RUTA_INDX;
    $ruta_lgin = RUTA_APP . RUTA_LGIN;

    if ($_SESSION["usuario"]) {
        $contenidoPrincipal = <<< EOS
            <h1>Bienvenido {$_SESSION["usuario"]->getNombre()}</h1>
            <a href = "$ruta_indx"><button type = "button">Menú principal</button></a>
        EOS;
    }
    else {
        $contenidoPrincipal = <<< EOS
            <h1>Error:</h1>
            <p>Usuario o contraseñas incorrectos</p>
            <a href = "$ruta_lgin"><button type = "button">Reintentar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);