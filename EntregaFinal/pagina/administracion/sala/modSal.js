//Ejecuta el script despues de que se haya ejecutado todo el php anterior
document.addEventListener('DOMContentLoaded', function() {
    // Obtener todas las butacas
    var butacas = document.querySelectorAll('.botonButaca');
    //Para pasarle parametros
    var parametros = new URLSearchParams(window.location.search);
    // Agregar un evento clic a cada butaca
    butacas.forEach(function(butaca) {
        butaca.addEventListener('click', function() {
            // Cambiar el estado de la butaca al hacer clic
            if (!butaca.classList.contains('selected')) {//??
                // Obtener la fila y el número de la butaca
                var datos = butaca.id;
                $.post('actualizar_butaca.php', {
                    butaca: datos,
                    id: parametros.get('id')
                },function(data) {
                    var respuesta = JSON.parse(data);
                    if (respuesta.estado != false) butaca.value = respuesta.estado;
                    else console.log("Error no se ha podido cambiar la butaca");
                    console.log(data);
                });
            } 
            
        });
    });
});
