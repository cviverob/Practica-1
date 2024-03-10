<?php
    require_once(RUTA_RAIZ . RUTA_USU);    
?>
<header>
    <img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/ElmoCines.png" alt="Título de la página">
    <img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/Logo.png" alt = "Logo de la página">
        
    <?php
        if (!isset($_SESSION["usuario_id"]) || !$_SESSION["usuario_id"]) {
            echo "Usuario desconocido. <a href = " . RUTA_APP . RUTA_REG . "><button type = 'button'>Registrarse</button></a>";
        }
        else {
            echo "Bienvenido " . $_SESSION["usuario_nombre"] . " <a href= " . RUTA_APP . RUTA_LGOUT . "><button type = 'button'>Salir</button></a>";
            if ($_SESSION["usuario_admin"]) {
                echo "<a href = " . RUTA_APP . RUTA_ADMN . "><button type = 'button'>Admin</button></a>";
            }
        }
    ?>
</header>