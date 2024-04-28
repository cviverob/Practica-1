$(document).ready(function() {

    /* Validación de que el correo no sea vacío */
    $("#correo").change(function(){
        const campo = $("#correo");
		campo[0].setCustomValidity("");
        const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && campo.val()) {
			$("#correo").html('&#x2714');
			campo[0].setCustomValidity("");
		} 
        else {
			$("#correo").html('&#x26a0');
			campo[0].setCustomValidity("El correo debe ser válido y acabar por @ucm.es");
		}
    })

})