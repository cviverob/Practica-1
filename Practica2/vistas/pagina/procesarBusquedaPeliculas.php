<?php
require_once('../../includes/config.php');
require_once("../../src/usuarios/usuarios.php"); 

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Tabla de películas';

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
    /*
        Aquí se mostrará una tabla con las coincidencias enontradas y sus respectivos datos,
        guardando en la sesión la película seleccionada para redirigirnos a aniadirPelicula.php
        con los datos de la misma preescritos.
    */
    $contenidoPrincipal = <<< EOS
        <h3>Tabla con las coincidencias:<h3>
        <a href = aniadirPelicula.php><button type = 'button'>Coincidencia 1</button></a>
        <p></p>
        <a href = aniadirPelicula.php><button type = 'button'>Coincidencia 2</button></a>
        <p></p>
        <a href = aniadirPelicula.php><button type = 'button'>Coincidencia 3</button></a>
        <p></p>
    EOS;
}

require('../comun/plantilla.php');