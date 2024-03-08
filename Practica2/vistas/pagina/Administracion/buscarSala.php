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
        <form action = "procesarBusquedaSala.php" method = "POST">
        <p></p>
        Sala:
        <input type='text' name='sala' value="" required />
        <p></p>
        Número de filas:
        <input type = "text" name = "filas" value = "" required />
        <p></p>
        Número de columnas:
        <input type='text' name='columnas' value="" required />
        <p></p>
        <button type = "submit">Buscar</button>
    </form>
    <p></p>
    <a href = 'administracion.php'><button type = 'button'>Cancelar</button></a>
    EOS;
}

require('../comun/plantilla.php');