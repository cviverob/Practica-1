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
        isset($_SESSION['correo']) ? $_SESSION['correo'] : ''
        </main>
        <?php require("../comun/pie.php") ?>
    </body>
</html>