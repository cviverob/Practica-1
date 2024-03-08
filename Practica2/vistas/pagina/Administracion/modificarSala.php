<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Modificar sala';

    // Temporal, para tener permisos
    $_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);

    $usuario = $_SESSION["usuario"];
    if (!$usuario->esAdmin()) {
        $ruta_menu_prncpl = RUTA_APP . RUTA_MENU_PRNCPL;
        $contenidoPrincipal = <<< EOS
            <h1>No tienes permisos para usar esta página</h1>
            <a href = "$ruta_menu_prncpl"><button type = 'button'>Volver al menú principal</button></a>
        EOS;
    }
    else {
        // Matriz de butacas para marcarlas o desmarcarlas
        $ruta_admn = RUTA_APP . RUTA_ADMN;
        $contenidoPrincipal = <<< EOS
            <h2>Matriz de butacas</h2>
            <button type = "button">B1</button> 
            <button type = "button">B2</button> 
            <button type = "button">B3</button> 
            <button type = "button">B4</button> 
            <button type = "button">B5</button> 
            <button type = "button">B6</button> 
            <button type = "button">B7</button> 
            <button type = "button">B8</button> 
            <p></p>
            <button type = "button">A1</button> 
            <button type = "button">A2</button> 
            <button type = "button">A3</button> 
            <button type = "button">A4</button> 
            <button type = "button">A5</button> 
            <button type = "button">A6</button> 
            <button type = "button">A7</button> 
            <button type = "button">A8</button> 
            <p></p>
            <a href = "$ruta_admn"><button type = 'button'>Confirmar</button></a>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }

    require_once(RUTA_RAIZ . RUTA_PLNT);