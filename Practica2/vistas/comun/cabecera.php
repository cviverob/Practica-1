<?php 
    require_once(RUTA_RAIZ . RUTA_USU);    
?>
<header>
    <img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/ElmoCines.png" alt="Título de la página">
    <img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/Logo.png" alt = "Logo de la página">
        
    <?php
        if (!isset($_SESSION["usuario"]) || !$_SESSION["usuario"]) {
            echo "Usuario desconocido. <a href = " . RUTA_APP . RUTA_REG . "><button type = 'button'>Registrarse</button></a>";
        }
        else {
            $usuario = $_SESSION["usuario"];
            echo "Bienvenido  <a href= " . RUTA_APP . RUTA_LGOUT . "><button type = 'button'>Salir</button></a>";
            echo "<a href= " . RUTA_APP . RUTA_ADMN . "><button type = 'button'>Admin</button></a>";
            // Pendiente de mirar
            /*if ($usuario->esAdmin()) {
                echo "<a href = 'vistas/Administracion/administracion.php'><button type = 'button'>Admin</button></a>";
            }*/
        }
    ?>
</header>