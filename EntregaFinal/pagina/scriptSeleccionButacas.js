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
            var datos = butaca.id.split('-');
            var estado = datos[1];
            console.log(datos[1]);
            console.log(datos[0]);
            console.log(id);
            // Cambiar el estado de la butaca al hacer clic
           if (estado != 'nulo' && estado != 'ocupada') {
                // Obtener la fila y el número de la butaca
                $.post('operacionesButacas.php', {
                    idButaca: datos[0],
                    id: id
                },function(data) {
                    console.log(data);
                    var respuesta = JSON.parse(data);
                    if (respuesta.estado != false) butaca.value = respuesta.estado;
                    else console.log("Error no se ha podido cambiar la butaca");
                    
                });
           }
        });
    });
});