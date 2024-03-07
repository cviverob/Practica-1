<?php 
    require_once(RUTA_USU);    
?>
<header>
    <img src = RUTA_IMGS . '/ElmoCines.png' alt = "Título de la página">
    <img src = RUTA_IMGS . '/Logo.png' alt = "Logo de la página">
        
    <?php
        if (!isset($_SESSION["usuario"]) || !$_SESSION["usuario"]) {
            echo "Usuario desconocido. <a href=\"../pagina/registro.php\"><button type = \"button\">Registrarse</button></a>";
        }
        else {
            $usuario = $_SESSION["usuario"];
            echo "Bienvenido " . $usuario->getNombre() . " <a href=\"\"><button type = 'button'>Salir</button></a>";
            // Pendiente de mirar
            if ($usuario->esAdmin()) {
                echo "<a href = \"administracion.php\"><button type = \"button\">Admin</button></a>";
            }
        }
    ?>
</header>