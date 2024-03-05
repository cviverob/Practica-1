<!DOCTYPE html>
<html>
    <html lang "es">
    <header>
        <meta charset="utf8mb4">
		<link rel="stylesheet" type="text/css" href="../comun/estilo.css" />
        <title>Cartelera</title>
    </header>
    <body>
        <?php require("../comun/cabecera.php")
        

        $fecha = new DateTime();

        echo $fecha_actual->format('m-d'); ?>

        <img src = "../../img/Poster_UP.png" alt = "Poster UP">
        <textarea>Descripción de la peli</textarea>
        <p>Duración        Género      Edad min</p>
        
        <?php echo $fecha_actual->format('H:i'); ?>

        <form action="mostrarSalas.php" method="post">
        <input type="submit" value="Ir a comprar asientos">
        </form>

        <?php require("../comun/pie.php") ?>
    </body>
</html>