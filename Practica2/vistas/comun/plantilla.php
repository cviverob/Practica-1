<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf8mb4">
    <meta http-equip="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href=<?= RUTA_CSS ?> />
    <title><?= $tituloPagina ?></title>
</head>
<body>
    <div id="contenedor">
        <?php require_once(RUTA_CBZ); ?>
        <main>
            <article>
                <?= $contenidoPrincipal ?>
            </article>
        </main>
        <?php  require_once(RUTA_PIE); ?>
    </div>
</body>
</html>