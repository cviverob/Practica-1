/* Código hecho con el chatgpt */
//Ejecuta el script despues de que se haya ejecutado todo el php anterior
document.addEventListener('DOMContentLoaded', function() {
    // Obtener todas las butacas
    var butacas = document.querySelectorAll('.botonButaca');
    //Para pasarle parametros
    var parametros = new URLSearchParams(window.location.search);
    // Agregar un evento clic a cada butaca
    for (let butaca of butacas) {
        butaca.addEventListener('click', function() {
            // Cambiar el estado de la butaca al hacer clic
            if (!butaca.classList.contains('selected')) {
                // Obtener la fila y el número de la butaca
                var datos = butaca.id.split('-');
                var idButaca = datos[0] + "-" + datos[1];
                $.post('../../../includes/logica/actualizarButaca.php', {
                    idButaca: idButaca,
                    id: parametros.get('id')
                },function(data) {
                    var respuesta = JSON.parse(data);
                    if (respuesta.estado) butaca.value = respuesta.estado;
                    else console.log("Error no se ha podido cambiar la butaca");
                });
            } 
        });
    }
});
