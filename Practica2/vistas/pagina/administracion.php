<?php
    require_once("../../src/usuarios/usuarios.php"); 
    $_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);
?>

<!DOCTYPE html>
<html>
    <html lang "es">
    <header>
        <meta charset="utf8mb4">
		<link rel="stylesheet" type="text/css" href="../comun/estilo.css" />
        <title>Elmo cines</title>
    </header>
    <body>
        <?php require("../comun/cabecera.php") ?>
        <main>
            <?php
                if (!$usuario->esAdmin()) {
                    echo "<h1>No tienes acceso a esta página</h1>";
                }
                else {
                    echo "<h2>Gestión de películas</h2>";
                    echo "<a href = \"administracion.php\"><button type = \"button\">Admin</button></a>";
                }
            ?>
            <h1>Administración</h1>
        </main>
        <?php require("../comun/pie.php") ?>
    </body>
</html>