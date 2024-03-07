<?php 
    require_once('C:\xampp\htdocs\Practica-SW\Practica2\src/usuarios/usuarios.php');    
?>
<header>
    <img src="/Practica-SW/Practica2/img/ElmoCines.png" alt="Título de la página">
    <img src="/Practica-SW/Practica2/img/Logo.png" alt = "Logo de la página">
        
    <?php
        if (!isset($_SESSION["usuario"]) || !$_SESSION["usuario"]) {
            echo "Usuario desconocido. <a href='/Practica-SW/Practica2/vistas/pagina/usuario/registro.php'><button type = 'button'>Registrarse</button></a>";
        }
        else {
            //$usuario = $_SESSION["usuario"];
            //echo "Bienvenido " . $usuario->getNombre() . " <a href=''><button type = 'button'>Salir</button></a>";
            // Pendiente de mirar
            /*if ($usuario->esAdmin()) {
                echo "<a href = 'vistas/Administracion/administracion.php'><button type = 'button'>Admin</button></a>";
            }*/
        }
    ?>
</header>