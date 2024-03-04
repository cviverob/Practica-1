<?php
    session_start();
    unset($_SESSION["usuario"]);
    unset($_SESSION["correo"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["edad"]);
    session_destroy();
?>