<?php
    require_once('../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_UTILS);
    
   
    //comprobar que estas logeado
    //if () {
        $tituloPagina = 'Historial Compras';

        $usuario = es\ucm\fdi\aw\usuario::getUsuario($_SESSION['id']);
        $nombre =  $usuario->getNombre();
        $correo = $usuario->getCorreo();
        $edad = $usuario->getEdad();
        
        $contenidoPrincipal = <<< EOS
        <div class = "historial">
        
        
        <h1>HISTORIAL DE COMPRAS</h1>  

        <h2>Datos del usuario:</h2>

        <p>Usuario: $nombre</p>
        <p>Correo: $correo</p>
        <p>Edad: $edad años</p>
        EOS;
        
        $compras = es\ucm\fdi\aw\compra::buscar($_SESSION['id']);
        foreach ($compras as $c) {
            $fecha = $c->getFecha();
            $hora = $c->getHora();
            $numEntradas = $c->getNumEntradas();
            $butacas = $c->getButacas();
            $tituloPeli = $c->getTituloPeli();
            $peli = es\ucm\fdi\aw\pelicula::buscarPorNombre($tituloPeli);
            //echo $peli->getTitulo() . RUTA_APP . RUTA_PSTR . '/' .$peli->getRutaPoster(); exit();
            
            //Para pintar la peli modo texto si no hay peli
            if ($peli) $infoPeli = "<p><img src = '". RUTA_APP . RUTA_PSTR . '/' . $peli->getRutaPoster() ."' width = '150' height = '200' class = 'pelisCartelera'>";
            else $infoPeli = "<p>$tituloPeli";

            $contenidoPrincipal .= <<< EOS
                $infoPeli , $fecha , $hora</p>
                <p>Numero de entradas compradas ($numEntradas):
            EOS;

            foreach ($butacas as $b) {
                $contenidoPrincipal .= $b . " " ;
            }
            $contenidoPrincipal.= "</p>";
        }

        $contenidoPrincipal .= <<< EOS
        
        </div>
        EOS;
        
        require_once(RUTA_RAIZ . RUTA_PLNT);
    //}