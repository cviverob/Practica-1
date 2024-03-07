<?php
   

$tituloPagina = 'Registro';

// Ver por qué no funciona
// $nombre = isset($_SESSION['nombre']) ?? '';
// $edad = isset($_SESSION['edad']) ?? '';
// $correo = isset($_SESSION['correo']) ?? '';

$contenidoPrincipal = <<< EOS
    <form action = "procesarRegistro.php" method = "post">
    <p></p>
    <a href = "login.php"><button type = "button">Conectarse</button></a>
    <a href = ""><button type = "button">Registrarse</button></a>
    <p></p>
    *Nombre:
    <input type="text" name="nombre" value="" required />
    <p></p>
    *Edad:
    <input type="text" name="edad" value="" required />
    <p></p>
    *Correo:
    <input type="text" name="correo" value="" required />
    <p></p>
    *Contraseña:
    <input type = "password" name = "contraseña" value = "" required />
    <p></p>
    *Campo obligatorio
    <p></p>
    <button type = "submit">Registrarse</button>
    </form>
EOS;

require('../../comun/plantilla.php');