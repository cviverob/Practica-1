<header>
    <a href = "<?php echo RUTA_APP . RUTA_INDX ?>"class="fotoElmoCines"><img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/ElmoCines.png" alt="Título de la página"></a>
    <a href = "<?php echo RUTA_APP . RUTA_INDX ?>"class="fotoElmo"><img src = "<?php echo RUTA_APP . RUTA_IMGS ?>/Logo.png" alt = "Logo de la página"></a>
        
    <?php
        if (!isset($_SESSION["login"]) || !$_SESSION["login"]) {
            echo 'Usuario desconocido <a href="' . RUTA_APP . RUTA_LGIN . '" class="LogUserButton">Logearse</a> <a href="' . RUTA_APP . RUTA_REG . '" class="RegisterUserButton">Registrarse</a>';
        }
        else {
            echo 'Bienvenido ' . $_SESSION["nombre"] . ' <a href="' . RUTA_APP . RUTA_LGOUT . '" class="ExitUserButton">Salir</a>';
            if ($_SESSION["esAdmin"]) {
                if (!isset($_SESSION['modo']) || $_SESSION['modo'] == 'usuario') {
                    echo '<a href="' . RUTA_APP . RUTA_ADMN . '" class="RegisterUserButton">Admin</a>';
                }
                else if ($_SESSION['modo'] == 'admin') {
                    echo '<a href="' . RUTA_APP . RUTA_INDX . '" class="RegisterUserButton">Menú principal</a>';

                }
            } else {
                echo '<a href="' . RUTA_APP . RUTA_HST . '" class="RegisterUserButton">Carrito</a>';
            }
        }
    ?>
</header>