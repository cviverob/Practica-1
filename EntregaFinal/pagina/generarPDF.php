<?php
require_once('../includes/config.php');
$urlImagen = RUTA_APP . RUTA_GIFS . '/beso.gif';
$idCompra = $_GET['idCompra'];
$idUsuario = $_SESSION['id'];
$compra = es\ucm\fdi\aw\compra::buscarPorIdYUsuario($idCompra, $idUsuario);
$sesion = es\ucm\fdi\aw\sesion::buscar($compra->getIdSesion());
$pelicula = es\ucm\fdi\aw\pelicula::buscarPorNombre($compra->getTituloPeli());
$sala = es\ucm\fdi\aw\salas::buscar($sesion->getIdSala());
$rutaPoster = RUTA_APP . RUTA_PSTR . '/' . $pelicula->getRutaPoster();
$tituloPagina = 'ImprimirTicket';
$contenidoPrincipal = <<< EOS
<div class="Ticket">
    <div class="Ticket-columna">
        <img src="$rutaPoster" class="fotitoTicket">
    </div>
    <div class="Ticket-columna">
        <h2>{$compra->getTituloPeli()}</h2>
        <p>{$pelicula->getSinopsis()}</p>
    </div>
</div>
EOS;


$butacas = $compra->getButacas();
$contador = 1;
foreach ($butacas as $b) {
    $partes = explode("-", $b);
    $contenidoPrincipal .= <<< EOS
        <div class="infoTicket">
            <div class="entrada">
                <h1>ENTRADA $contador</h1>
            </div>
            <div class="linea-vertical"></div> <!-- Línea vertical -->
            <div class="descripcion">
                <p>Gracias por comprar una entrada. La sala de la película es la {$sala->getNumSala()}.
                No olvides que la película empezará a las {$sesion->getHoraIni()} y finalizará a las {$sesion->getHoraFin()}
                y que tendrás que asistir el día {$sesion->getFecha()} 10 minutos antes para poder sentarte en tu asiento.
                Por si no te acuerdas, tu asiento está en la fila $partes[0] y la columna $partes[1].
                </p>
                <p class="subliminal">Fecha de compra: {$compra->getFecha()} {$compra->getHora()}</p>
            </div>
        </div>
    EOS;
    $contador++;
}


$contenidoPrincipal .= <<< EOS

<div class = "adios">
<h1>Muchas gracias!!</h1>
<img src="$urlImagen" alt="Imagen de ejemplo" width="200" height="200" class="gif">
<br> <!-- Insertar un salto de línea antes del enlace -->
<a href="#" onclick="imprimirTicket()" class="seleccionarPelicula">Imprimir Ticket</a>
</div>
</div>
EOS;
require_once(RUTA_RAIZ . RUTA_PLNT);  
?>
<script>
    function imprimirTicket() {
        window.print();
    }
</script>
