<?php 
    session_start();
    require_once("../../src/usuarios/usuarios.php");    
?>
<header>
    <img src = "../../img/ElmoCines.png" alt = "Título de la página">
    <img src = "../../img/Logo.png" alt = "Logo de la página">
        
    <?php
        if (!isset($_SESSION["usuario"]) || !$_SESSION["usuario"]) {
            echo "Usuario desconocido. <a href=\"../pagina/registro.php\"><button type = \"button\">Registrarse</button></a>";
        }
        else {
            $usuario = $_SESSION["usuario"];
            echo "Bienvenido " . $usuario->getNombre() . "<a href=\"\">(salir)</a>";
            // Pendiente de mirar
            if ($usuario->esAdmin()) {
                echo "<a href = \"administracion.php\"><button type = \"button\">Admin</button></a>";
            }
        }
    ?>
</header>