<?php
require_once('../../includes/config.php');
require_once("../../src/usuarios/usuarios.php"); 

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Buscar sesión';

// Temporal, para tener permisos
$_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);

$usuario = $_SESSION["usuario"];
if (!$usuario->esAdmin()) {
    $contenidoPrincipal = <<< EOS
        <h1>No tienes permisos para usar esta página</h1>
        <a href = 'menuPrincipal.php'><button type = 'button'>Volver al menú principal</button></a>
    EOS;
}
else {
    $contenidoPrincipal = <<< EOS
        <form action = "procesarBusquedaSesiones.php" method = "POST">
            <p></p>
            Nombre:
            <input type='text' name='nombre' value="" />
            <p></p>
            Sala:
            <input type = "text" name = "sala" value = "" />
            <p></p>
            Fecha:
            <input type='text' name='fecha' value="" />
            <p></p>
            Hora:
            <input type='text' name='hora' value="" />
            <p></p>
            Duración:
            <input type='text' name='duracion' value="" /> minutos
            <p></p>
            <button type = "submit">Buscar</button>
        </form>
    EOS;
}

require('../comun/plantilla.php');