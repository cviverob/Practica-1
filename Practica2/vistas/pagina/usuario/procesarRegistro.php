
<?php
require_once('../../../src/usuarios/usuarios.php');

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

if ($_SESSION["usuario"]) {
    $contenidoPrincipal = <<< EOS
        <h1>Bienvenido {$_SESSION["usuario"]->getNombre()}</h1>
        <a href = '/Practica-SW/Practica2/vistas/pagina/menuPrincipal.php'><button type = 'button'>Menú principal</button></a>
    EOS;
}
else {
    $contenidoPrincipal = <<< EOS
        <h1>Error al registrarse</h1>
        <a href = 'registro.php'><button type = 'button'>Reintentar</button></a>
    EOS;
}

require('../../comun/plantilla.php');