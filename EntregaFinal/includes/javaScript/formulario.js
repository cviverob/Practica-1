
/**
 * Función que comprueba si el campo es válido o no
 * @returns String con un tick en caso de validación exitosa, o una advertencia
 * en caso contrario
 */
function comprobarCampo(campo) {
	const contenido = $(campo);
	if (!contenido.length) {
		return false;
	}
	contenido[0].setCustomValidity("");
	const esCampoValido = contenido[0].checkValidity();
	advertencia = "";
	if (!esCampoValido) {
		advertencia = "El campo no es válido";
	}
	else {
		return "\u2714";
	}
	return "\u2716 " + advertencia;
}

/**
 * Función que comprueba si una seguda contraseña es válida o no
 * @param {boolean} advertir 
 * @returns String con un tick en caso de validación exitosa, o una advertencia
 * en caso contrario
 */
function comprobarContraseña2(advertir) {
	advertencia = comprobarCampo("#contraseña2");
	if (advertencia == "\u2714") {
		const campo1 = $("#contraseña");
		const campo2 = $("#contraseña2");
		if (campo1.val() != campo2.val()) {
			advertencia = "Las contraseñas deben coincidir";
			if (advertir) {
				campo2[0].setCustomValidity(advertencia);
			}
			advertencia = "\u2716 " + advertencia;
		}
	}
	return advertencia;
}

$(document).ready(function() {

	/****** CORREO ******/

	/* Definimos las acciones a tomar al pulsar una tecla */
	$("#correo").on("change keyup", function() {
		accion = comprobarCampo("#correo");
		if (accion == "\u2714") {
			$("#error-correo").hide();
			$("#validezCorreo").text(accion);
		}
	});

	/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
	$("#correo").on("blur", function() {
		accion = comprobarCampo("#correo");
		$("#error-correo").hide();
		$("#validezCorreo").text(accion);
	});

	/****** CONTRASEÑA ******/

	/* Definimos las acciones a tomar al pulsar una tecla */
	$("#contraseña").on("change keyup", function() {
		accion = comprobarCampo("#contraseña");
		if (accion == "\u2714") {
			$("#error-contraseña").hide();
			$("#validezContraseña").text(accion);
		}
	});

	/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
	$("#contraseña").on("blur", function() {
		accion = comprobarCampo("#contraseña");
		$("#error-contraseña").hide();
		$("#validezContraseña").text(accion);
	});

	/****** CONTRASEÑA 2 ******/

	/* Definimos las acciones a tomar al pulsar una tecla */
	$("#contraseña2").on("change keyup", function() {
		accion = comprobarContraseña2(false);
		if (accion == "\u2714") {
			$("#error-contraseña2").hide();
			$("#validezContraseña2").text(accion);
		}
	});

	/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
	$("#contraseña2").on("blur", function() {
		accion = comprobarContraseña2(true);
		$("#error-contraseña2").hide();
		$("#validezContraseña2").text(accion);
	});

	/****** NOMBRE ******/

	/* Definimos las acciones a tomar al pulsar una tecla */
	$("#nombre").on("change keyup", function() {
		accion = comprobarCampo("#nombre");
		if (accion == "\u2714") {
			$("#error-nombre").hide();
			$("#validezNombre").text(accion);
		}
	});

	/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
	$("#nombre").on("blur", function() {
		accion = comprobarCampo("#nombre");
		$("#error-nombre").hide();
		$("#validezNombre").text(accion);
	});

	/****** EDAD ******/

	/* Definimos las acciones a tomar al pulsar una tecla */
	$("#edad").on("change keyup", function() {
		accion = comprobarCampo("#edad");
		if (accion == "\u2714") {
			$("#error-edad").hide();
			$("#validezEdad").text(accion);
		}
	});

	/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
	$("#edad").on("blur", function() {
		accion = comprobarCampo("#edad");
		$("#error-edad").hide();
		$("#validezEdad").text(accion);
	});

});

/* Comprobamos inicialmente si todo está ok, en cuyo caso mostramos el tick */
document.addEventListener("DOMContentLoaded", function() {
	accion = comprobarCampo("#correo");
	if (accion == "\u2714") {
		$("#validezCorreo").text(accion);
	}

	accion = comprobarCampo("#contraseña");
	if (accion == "\u2714") {
		$("#validezContraseña").text(accion);
	}
	
	accion = comprobarContraseña2(false);
	if (accion == "\u2714") {
		$("#validezContraseña2").text(accion);
	}

	accion = comprobarCampo("#nombre");
	if (accion == "\u2714") {
		$("#validezNombre").text(accion);
	}

	accion = comprobarCampo("#edad");
	if (accion == "\u2714") {
		$("#validezEdad").text(accion);
	}

});