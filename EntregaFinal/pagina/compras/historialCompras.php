<?php
    require_once('../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);

    $tituloPagina = 'Historial Compras';

    $usuario = es\ucm\fdi\aw\usuario::getUsuario($_SESSION['id']);
    $nombre =  $usuario->getNombre();
    $correo = $usuario->getCorreo();
    $edad = $usuario->getEdad();

    $contenidoPrincipal = <<< EOS
    <div class = "historial">
        <h1 class ='titulito'>HISTORIAL DE COMPRAS</h1> 
        <h2>Datos del usuario:</h2>
        <p>Usuario: $nombre</p>
        <p>Correo: $correo</p>
        <p>Edad: $edad años</p>
    EOS;

    $compras = es\ucm\fdi\aw\compra::buscarComprasDeUsuario($_SESSION['id']);
    foreach ($compras as $c) {
        $sesion = es\ucm\fdi\aw\sesion::buscar($c->getIdSesion());
        $sala = es\ucm\fdi\aw\salas::buscar($sesion->getIdSala());
        $pelicula = es\ucm\fdi\aw\pelicula::buscar($c->getIdPeli());
        $num_sala = $sala->getNumSala();
        $fecha = \DateTime::createFromFormat('d/m/y', $c->getFecha()); // Seguir aquí
        $hora = \DateTime::createFromFormat('H:i:s', $c->getFecha());
        $numEntradas = count($c->getButacas());
        $butacas = $c->getButacas();
        $tituloPeli = $pelicula->getTitulo();
        // Para pintar la peli modo texto si no hay peli
        $infoPeli = "<div class='align-left'><img src='". RUTA_APP . RUTA_PSTR . '/' . 
            $pelicula->getRutaPoster() ."' width='150' height='200' class='fotitoHistorial'></div>";
        $contenidoPrincipal .= <<<EOS
        <hr class = 'barrita'>
        <div class="historial-compras">
            <div class='align-left'>
                $infoPeli
            </div>
            <div class='align-right'>
                <p>Numero de sala: $num_sala</p>
                <p>Fecha de la compra: $fecha</p>
                <p>Hora de la compra: $hora</p>
                <p>Entradas compradas ($numEntradas):</p>
                
        EOS;
    
        foreach ($butacas as $b) {
            $contenidoPrincipal .= "$b ";
        }
    
        $contenidoPrincipal .= <<<EOS
                </div>
            </div>
            EOS;
    }

        

    $contenidoPrincipal .= <<< EOS
        </div>
    EOS;

    require_once(RUTA_RAIZ . RUTA_PLNT);
?>
