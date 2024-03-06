<?php
require_once('../../includes/config.php');
require_once("../../src/usuarios/usuarios.php"); 

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Modificar sala';

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
    // Matriz de butacas para marcarlas o desmarcarlas
    $contenidoPrincipal = <<< EOS
        <h2>Matriz de butacas</h2>
        <a href = 'administracion.php'><button type = 'button'>Confirmar</button></a>
        <a href = 'administracion.php'><button type = 'button'>Cancelar</button></a>
    EOS;
}

require('../comun/plantilla.php');