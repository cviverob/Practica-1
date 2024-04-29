$(document).ready(function() {

	/****** CORREO ******/

    /**
	 * Función que comprueba si el correo es válido o no
	 * @param {boolean} advertir 
	 * @returns String con un tick en caso de validación exitosa, o una advertencia
	 * en caso contrario
	 */
	function comprobarCorreo(advertir) {
		const campo = $("#correo");
		campo[0].setCustomValidity("");
        const esCorreoValido = campo[0].checkValidity();
		advertencia = "";
		// Verifica si el usuario ha interactuado con el campo antes de mostrar advertencias
		if (!esCorreoValido) {
			advertencia = "El formato de correo no es válido";
		} 
		else if (!campo.val()) {
			advertencia = "El correo no puede estar vacío";
		}
		else {
			return "\u2714";
		}
		if (advertir) {
			campo[0].setCustomValidity(advertencia);
		}
		return "\u2716 " + advertencia;
	}

	/* Comprobamos inicialmente si todo está ok, en cuyo caso mostramos el tick */
	accion = comprobarCorreo(false);
	if (accion == "\u2714") {
		$("#validezCorreo").text(accion);
	}

	/* Definimos las acciones a tomar al pulsar una tecla */
	$("#correo").on("change keyup", function() {
		accion = comprobarCorreo(false);
		if (accion == "\u2714") {
			$("#error-correo").hide();
			$("#validezCorreo").text(accion);
		}
	});

	/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
	$("#correo").on("blur", function contraseñaBlurSubmit() {
		accion = comprobarCorreo(true);
		$("#error-correo").hide();
		$("#validezCorreo").text(accion);
	});

	/****** CONTRASEÑA ******/

	/**
	 * Función que comprueba si una contraseña es válida o no
	 * @param {boolean} advertir 
	 * @returns String con un tick en caso de validación exitosa, o una advertencia
	 * en caso contrario
	 */
	function comprobarContraseña(advertir) {
		const campo = $("#contraseña");
		campo[0].setCustomValidity("");
		const esContraseñaValida = campo[0].checkValidity();
		advertencia = "";
		// Verifica si el usuario ha interactuado con el campo antes de mostrar advertencias
		if (!esContraseñaValida) {
			advertencia = "El formato de contraseña no es válido";
		} 
		else if (!campo.val()) {
			advertencia = " La contraseña no puede estar vacía";
		}
		else if (campo.val().length < 5) {
			advertencia = "La contraseña tiene que tener al menos 5 carácteres";
		}
		else {
			return "\u2714";
		}
		if (advertir) {
			campo[0].setCustomValidity(advertencia);
		}
		return "\u2716 " + advertencia;
	}

	/* Comprobamos inicialmente si todo está ok, en cuyo caso mostramos el tick */
	accion = comprobarContraseña(false);
	if (accion == "\u2714") {
		$("#validezContraseña").text(accion);
	}

	/* Definimos las acciones a tomar al pulsar una tecla */
	$("#contraseña").on("change keyup", function() {
		accion = comprobarContraseña(false);
		if (accion == "\u2714") {
			$("#error-contraseña").hide();
			$("#validezContraseña").text(accion);
		}
	});

	/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
	$("#contraseña").on("blur", function contraseñaBlurSubmit() {
		accion = comprobarContraseña(true);
		$("#error-contraseña").hide();
		$("#validezContraseña").text(accion);
	});

});