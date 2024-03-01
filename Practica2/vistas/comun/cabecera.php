<?php session_start() ?>
<header>
    <img src = "../../img/ElmoCines.png" alt = "Título de la página">
    <img src = "../../img/Logo.png" alt = "Logo de la página">
        
    <?php
        if (!isset($_SESSION["login"]) || !$_SESSION["login"]) {
            echo "Usuario desconocido. <a href=\"\">Registrarse</a>";
        }
        else {
            echo "Bienvenido {$_SESSION["usuario"]} <a href=\"\">(salir)</a>";
        }
    ?>
</header>