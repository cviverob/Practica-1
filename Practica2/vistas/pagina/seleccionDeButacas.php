<?php
    require_once('../../includes/config.php');
    
    $tituloPagina = 'Seleccion de Butacas';

    $ruta_proc_comp = RUTA_APP . RUTA_PROC_COMP;

    $contenidoPrincipal = <<< EOS
        <h1>Selección de butacas<h1>
        
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
            
        
        <a href = "$ruta_proc_comp"><button type = "button">Comprar</button></a>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);