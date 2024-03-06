<?php
require_once('../../includes/config.php');
require_once("../../src/usuarios/usuarios.php"); 

$rutaEstilos = '../comun/estilo.css';

$tituloPagina = 'Añadir sesión';

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
            <input type='text' name='nombre' value="" required />
            <p></p>
            *Sala:
            <input type = "text" name = "sala" value = "" required />
            <p></p>
            *Fecha:
            <input type='text' name='fecha' value="" required />
            <p></p>
            *Hora:
            <input type='text' name='hora' value="" required />
            <p></p>
            Oculto:
            <input type='button' name='ocultoSi' value="Sí" />
            <input type='button' name='ocultoNo' value="No" />
            <p></p>
            *Campo obligatorio
            <p></p>
            <button type = "submit">Confirmar</button>
        </form>
    EOS;
}

require('../comun/plantilla.php');