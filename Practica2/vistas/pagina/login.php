<?php
require_once('../../includes/config.php');

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Login';

// Ver por qué no funciona
// $correo = isset($_SESSION["correo"]) ?? "";

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

require('../comun/plantilla.php');