<!DOCTYPE html>
<html lang "es">
    <header>
        <meta charset="utf8mb4">
		<link rel="stylesheet" type="text/css" href="../comun/estilo.css" />
        <title>Elmo cines</title>
    </header>
    <body>
        <?php 
            require("../comun/cabecera.php");
            require_once("../../src/peliculas/peliculas.php");
        ?>
        <main>
            <?php
                $pelicula = Pelicula::crea("Alejandría", "mucho texto jajaja", "../../img/Logo.png", "", 18, "acción", 120);
                echo "<h1>" . $pelicula->getTitulo() . "</h1>";
                // Faltan las sesiones
                echo "<img src = \"" . $pelicula->getRutaPoster() . "\" alt = \"Póster de la película\">";
                echo "<p> Sinopsis: " . $pelicula->getSinopsis() . "</p>";
                echo "<p> Edad mínima: " . $pelicula->getPegi() . "</p>";
                echo "<p> Género: " . $pelicula->getGenero() . "</p>";
                echo "<p> Género: " . $pelicula->getDuracion() . " minutos </p>";
                /*
                if (!isset($_SESSION["pelicula"]) || !isset($_SESSION["pelicula"])) {
                    echo "<h1>Error:</h1>";
                    echo "<p>Película no encontrada</p>";
                }
                else {
                    $pelicula = $_SESSION["pelicula"];
                    echo "<h1>" . $pelicula->getTitulo() . "</h1>";
                    // Faltan las sesiones
                    echo "<img src = \"" . $pelicula->getRutaPoster() . "\" alt = \"Póster de la película\">";
                    echo "<p> Sinopsis: " . $pelicula->getSinopsis() . "</p>";
                    echo "<p> Edad mínima: " . $pelicula->getPegi() . "</p>";
                    echo "<p> Género: " . $pelicula->getGenero() . "</p>";
                    echo "<p> Género: " . $pelicula->getDuracion() . "minutos </p>";
                    // Falta el trailer"
                }*/
            ?>
        </main>
        <?php require("../comun/pie.php") ?>
    </body>
</html>