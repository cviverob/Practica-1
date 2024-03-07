<?php
require_once('C:\xampp\htdocs\Practica-SW\Practica2\includes/config.php');

$tituloPagina = 'Login';

// Ver por qué no funciona
// $correo = isset($_SESSION["correo"]) ?? "";

// Usar div en vez de <p></p>
// Hacer función para generar formulario, que reciba un parámetro y se pueda llamar en procesarLogin

$contenidoPrincipal = <<< EOS
    <form action = "procesarLogin.php" method = "POST">
        <p></p>
        <a href = ""><button type = "button">Conectarse</button></a>
        <a href = "registro.php"><button type = "button">Registrarse</button></a>
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

require('../../comun/plantilla.php');