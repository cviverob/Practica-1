<?php
    require_once('../../includes/config.php');
    
    $rutaEstilos = '../comun/estilo.css';
    
    $tituloPagina = 'Seleccion de Butacas';
    
    // Ver por qué no funciona
    // $correo = isset($_SESSION["correo"]) ?? "";
    
    $contenidoPrincipal = <<< EOS
        <h1>Selección de butacas<h1>
        <a href = "procesarCompra.php"><button type = "button">Comprar</button></a>
    EOS;
    
    require('../comun/plantilla.php');