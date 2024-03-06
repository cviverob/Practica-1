<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf8mb4">
    <meta http-equip="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href=<?= $rutaEstilos ?> />
    <title><?= $tituloPagina ?></title>
</head>
<body>
    <div id="contenedor">
        <?php require('cabecera.php'); ?>
        <main>
            <article>
                <?= $contenidoPrincipal ?>
            </article>
        </main>
        <?php  require('pie.php'); ?>
    </div>
</body>
</html>