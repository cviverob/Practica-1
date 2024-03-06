<?php
require_once('../../includes/config.php');
require_once("../../src/usuarios/usuarios.php"); 

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Administración';

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
        <h2>Gestión de películas<h2>
        <a href = 'aniadirPelicula.php'><button type = 'button'>Añadir</button></a>
        <a href = 'buscarPelicula.php'><button type = 'button'>Buscar</button></a>
        <h2>Gestión de cartelera<h2>
        <a href = 'aniadirSesion.php'><button type = 'button'>Añadir</button></a>
        <a href = 'buscarSesion.php'><button type = 'button'>Buscar</button></a>
        <h2>Gestión de salas<h2>
    EOS;
}

require('../comun/plantilla.php');