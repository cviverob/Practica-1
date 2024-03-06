<?php
require_once('../../includes/config.php');
require_once("../../src/usuarios/usuarios.php"); 

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Añadir película';

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
    // Si estamos modificando una sesión, deben salir los valores de dicha peli
    $contenidoPrincipal = <<< EOS
        <form action = "administracion.php" method = "POST">
            <p></p>
            *Nombre:
            <input type='text' name='nombre' value="" />
            <p></p>
            *Sinópsis:
            <input type = "text" name = "sinopsis" value = "" />
            <p></p>
            *Póster:
            <input type='button' name='poster' value="" />
            <p></p>
            *Tráiler:
            <input type='button' name='trailer' value="" />
            <p></p>
            *Edad:
            <input type='text' name='edad' value="" />
            <p></p>
            *Género:
            <input type='text' name='genero' value="" />
            <p></p>
            *Duración:
            <input type='text' name='duracion' value="" /> minutos
            <p></p>
            *Campo obligatorio
            <p></p>
            <button type = "submit">Confirmar</button>
        </form>
    EOS;
}

require('../comun/plantilla.php');