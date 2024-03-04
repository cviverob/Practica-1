<!DOCTYPE html>
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
            if (!isset($_SESSION["usuario"]) || !$_SESSION["usuario"]) {
                echo "<h1>Error:</h1>";
                echo "<p>Debes estar registrado para realizar la compra</p>";
                echo "<a href = \"registro.php\"><button type = \"button\">Registrarse</button></a>";
            }/*
            else if (Algún error al seleccionar las butacas) {

            }*/
            else {
                echo "<h1>Compra efectuada</h1>";
                echo "<p>Puedes consultar en tu perfil las entradas o descargarlas aquí</p>";
                echo "<button type = \"button\">Descargar entradas</button>";
            }
        ?>
        </main>
        <?php require("../comun/pie.php") ?>
    </body>
</html>