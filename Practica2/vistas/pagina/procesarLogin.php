<?php
require_once('../../includes/config.php');

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Proceso de login';

$correo = htmlspecialchars(strip_tags($_POST["correo"]));
$contraseña = htmlspecialchars(strip_tags($_POST["contraseña"]));
$usuario = Usuario::login($correo, $contraseña);
$_SESSION["usuario"] = $usuario;
$_SESSION["correo"] = $correo;

if ($_SESSION["usuario"]) {
    $contenidoPrincipal = <<< EOS
        <h1>Bienvenido {$_SESSION["usuario"]->getNombre()}</h1>
        <a href = \"menuPrincipal.php\"><button type = \"button\">Menú principal</button></a>
    EOS;
}
else {
    $contenidoPrincipal = <<< EOS
        <h1>Error:</h1>
        <p>Usuario o contraseñas incorrectos</p>
        <a href = \"login.php\"><button type = \"button\">Reintentar</button></a>
    EOS;
}

require('../comun/plantilla.php');