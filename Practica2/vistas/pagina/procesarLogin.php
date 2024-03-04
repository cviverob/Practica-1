<!DOCTYPE html>
<html>
    <html lang "es">
    <header>
        <meta charset="utf8mb4">
		<link rel="stylesheet" type="text/css" href="../comun/estilo.css" />
        <title>Elmo cines</title>
    </header>
    <body>
        <?php 
            require("../comun/cabecera.php");
            require_once("../../src/usuarios/usuarios.php");

            $correo = htmlspecialchars(strip_tags($_POST["correo"]));
            $contraseña = htmlspecialchars(strip_tags($_POST["contraseña"]));
            $usuario = Usuario::login($correo, $contraseña);
            $_SESSION["usuario"] = $usuario;
            $_SESSION["correo"] = $correo;
        ?>
        <main>
            <?php
                if ($_SESSION["usuario"]) {
                    echo "<h1>Bienvenido {$_SESSION["usuario"]->getNombre()}</h1>";
                    echo "<a href = \"menuPrincipal.php\"><button type = \"button\">Menú principal</button></a>";
                }
                else {
                    echo "<h1>Error:</h1>";
                    echo "<p>Usuario o contraseñas incorrectos</p>";
                    echo "<a href = \"login.php\"><button type = \"button\">Reintentar</button></a>";
                }
            ?>
        </main>
        <?php require("../comun/pie.php") ?>
    </body>
</html>