//Ejecuta el script despues de que se haya ejecutado todo el php anterior
document.addEventListener('DOMContentLoaded', function() {
    // Obtener todas las butacas
    var butacas = document.querySelectorAll('.botonButaca');
    //Para pasarle parametros
    var parametros = new URLSearchParams(window.location.search);
    var id = parametros.get('id');
    // Agregar un evento clic a cada butaca
    butacas.forEach(function(butaca) {
        butaca.addEventListener('click', function() {
            var datos = butaca.id.split("-");
            var idButaca = datos[0] + "-" + datos[1];
            var estado = datos[2];
            // Cambiar el estado de la butaca al hacer clic
            if (estado == 'disponible' || estado == 'seleccionada') {
                // Obtener la fila y el número de la butaca
                $.post('../includes/logica/operacionesButacas.php', {
                    idButaca: idButaca,
                    id: id
                },function(data) {
                    var respuesta = JSON.parse(data);
                    if (respuesta.estado) butaca.value = respuesta.estado;
                    else console.log("Error no se ha podido cambiar la butaca");
                });
            }
        });
    });
});