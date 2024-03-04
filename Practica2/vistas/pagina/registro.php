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
            <form action = "procesarRegistro.php" method = "post">
                <p></p>
                <a href = "login.php"><button type = "button">Conectarse</button></a>
                <a href = ""><button type = "button">Registrarse</button></a>
                <p></p>
                *Nombre:
                <input type="text" name="nombre" value="<?php echo isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : '' ?>" />
                <p></p>
                *Edad:
                <input type="text" name="edad" value="<?php echo isset($_SESSION["edad"]) ? $_SESSION["edad"] : '' ?>" />
                <p></p>
                *Correo:
                <input type="text" name="correo" value="<?php echo isset($_SESSION["correo"]) ? $_SESSION["correo"] : '' ?>" />
                <p></p>
                *Contraseña:
                <input type = "password" name = "contraseña" value = "" />
                <p></p>
                *Campo obligatorio
                <p></p>
                <button type = "submit">Registrarse</button>
            </form>
        </main>
        <?php require("../comun/pie.php") ?>
    </body>
</html>