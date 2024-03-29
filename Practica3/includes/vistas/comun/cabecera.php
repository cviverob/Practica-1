<header>
    <img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/ElmoCines.png" alt="Título de la página">
    <img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/Logo.png" alt = "Logo de la página">
        
    <?php
        if (!isset($_SESSION["login"]) || !$_SESSION["login"]) {
            echo "Usuario desconocido. <a href = " . RUTA_APP . RUTA_REG . "><button type = 'button'>Registrarse</button></a>";
        }
        else {
            echo "Bienvenido " . $_SESSION["nombre"] . " <a href= " . RUTA_APP . RUTA_LGOUT . "><button type = 'button'>Salir</button></a>";
            if ($_SESSION["esAdmin"]) {
                if (!isset($_SESSION['modo']) || $_SESSION['modo'] == 'usuario') {
                    echo "<a href = " . RUTA_APP . RUTA_ADMN . "><button type = 'button'>Admin</button></a>";
                }
                else if ($_SESSION['modo'] == 'admin') {
                    echo "<a href = " . RUTA_APP . RUTA_INDX . "><button type = 'button'>Menú principal</button></a>";
                }
            }
        }
    ?>
</header>