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

$compras = es\ucm\fdi\aw\compra::buscar($_SESSION['id']);
foreach ($compras as $c) {
    //$id_sesi = $c->getIdSesion();
    //$sesi = $id_sesi->buscar($id_sesi);
    //$id_sala = $sesi->getIdSala();
    //$num_sala = id_sala
    $sesi = $c->getIdSesion();  
    $fecha = $c->getFecha();
    $hora = $c->getHora();
    $numEntradas = $c->getNumEntradas();
    $butacas = $c->getButacas();
    $tituloPeli = $c->getTituloPeli();
    $peli = es\ucm\fdi\aw\pelicula::buscarPorNombre($tituloPeli);

    // Para pintar la peli modo texto si no hay peli
    if ($peli) {
        $infoPeli = "<div class='align-left'><img src='". RUTA_APP . RUTA_PSTR . '/' . $peli->getRutaPoster() ."' width='150' height='200' class='fotitoHistorial'></div>";
    } else {
        $infoPeli = "<div class='align-left'>$tituloPeli</div>";
    }

    $contenidoPrincipal .= <<<EOS
    <hr class = 'barrita'>
<div class="historial-compras">
    <div class='align-left'>
        $infoPeli
    </div>
    <div class='align-right'>
        <p>Sesion: $sesi</p>
        <p>Fecha: $fecha</p>
        <p>Hora: $hora</p>
        <p>Numero de entradas compradas ($numEntradas):</p>
        
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
