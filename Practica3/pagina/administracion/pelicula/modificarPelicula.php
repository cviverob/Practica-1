<?php

    require_once('../../../includes/config.php');
    
    if (isset($_POST['id'])) {
        $_POST['idForm'] = 'formPelicula';
        $formulario = new es\ucm\fdi\aw\FormularioPelicula();
        $htmlFormularioPelicula = $formulario->gestiona();
    }