<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset = "utf-8">
    <meta http-equip = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo RUTA_APP . RUTA_CSS ?>"/>
    <title><?= $tituloPagina ?></title>
</head>
<body>
    <div id="contenedor">
        <?php require(RUTA_RAIZ . RUTA_CBZ); ?>
        <main>
            <article>
                <?= $contenidoPrincipal ?>
            </article>
        </main>
        <?php  require(RUTA_RAIZ . RUTA_PIE); ?>
    </div>
</body>
</html>