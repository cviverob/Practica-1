<?php
    //require_once('../../includes/config.php');
    
    $tituloPagina = 'Seleccion de Butacas';
    $i = 0;
    $j = 0;
    $contenidoPrincipal = <<< EOS
        <h1>Selección de butacas<h1>
        
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <p></p>
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <button type = "button">B</button> 
        <p></p>
            
        
        <a href = "procesarCompra.php"><button type = "button">Comprar</button></a>
    EOS;

    require('../comun/plantilla.php');