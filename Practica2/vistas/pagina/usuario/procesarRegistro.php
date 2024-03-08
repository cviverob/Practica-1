
<?php
require_once('C:\xampp\htdocs\Practica-SW\Practica2\includes/config.php');
require_once('C:\xampp\htdocs\Practica-SW\Practica2\src/usuarios/usuarios.php');

$tituloPagina = 'Proceso de Registro';

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
        <a href = 'vistas/pagina/menuPrincipal.php'><button type = 'button'>Menú principal</button></a>
    EOS;
}
else {
    $contenidoPrincipal = <<< EOS
        <h1>Error al registrarse</h1>
        <a href = 'registro.php'><button type = 'button'>Reintentar</button></a>
    EOS;
}

require('C:\xampp\htdocs\Practica-SW\Practica2\vistas/comun/plantilla.php');