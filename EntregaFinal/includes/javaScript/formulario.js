
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
	let advertencia = "";
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
	let advertencia = comprobarCampo("#contraseña2");
	if (advertencia == "\u2714") {
		let campo1 = $("#contraseña");
		let campo2 = $("#contraseña2");
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

/**
 * Función que comprueba si un archivo subido es válido o no
 * @param {string} campo 
 * @param {array} tipos 
 * @returns String con un tick en caso de validación exitosa, o una advertencia
 * en caso contrario
 */
function comprobarArchivo(campo, tipos) {
	let advertencia = comprobarCampo(campo);
	if (advertencia == "\u2714") {
		const contenido = $(campo);
		archivo = contenido[0].files[0];
		if (!tipos.includes(archivo.type)) {
			advertencia = "Los tipos permitidos son " + tipos.join(", ");
			contenido[0].setCustomValidity(advertencia);
			advertencia = "\u2716 " + advertencia;
		}
	}
	return advertencia;
}

/**
 * Función que determina qué mostrarle al usuario en función de la validación
 * del campo correspondiente
 * @param {string} campo 
 * @param {string} validezCampo 
 * @param {string} errorCampo 
 * @param {string} modo 
 */
function tomarAccion(campo, validezCampo, errorCampo, modo, accion = null) {
	if (accion == null) {
		accion = comprobarCampo(campo);
	}
	if (modo == "load" || modo == "keyup") {
		if (accion == "\u2714") {
			$(errorCampo).hide();
			$(validezCampo).text(accion);
		}
	}
	else if (modo == "blur" || modo == "change") {
		$(errorCampo).hide();
		$(validezCampo).text(accion);
	}
}

/**
 * Constructor de la estructura campo
 * @param {*} campo 
 * @param {*} validezCampo 
 * @param {*} errorCampo 
 */
function Campo(campo, validezCampo, errorCampo) {
    this.campo = campo;
    this.validezCampo = validezCampo;
    this.errorCampo = errorCampo;
}

/**
 * Array con todos los campos de los formularios
 */
var campos = [
    new Campo("#correo", "#validezCorreo", "#error-correo"),
    new Campo("#contraseña", "#validezContraseña", "#error-contraseña"),
    new Campo("#nombre", "#validezNombre", "#error-nombre"),
    new Campo("#edad", "#validezEdad", "#error-edad"),
    new Campo("#sinopsis", "#validezSinopsis", "#error-sinopsis"),
    new Campo("#pegi", "#validezPegi", "#error-pegi"),
    new Campo("#genero", "#validezGenero", "#error-genero"),
    new Campo("#duracion", "#validezDuracion", "#error-duracion"),
    new Campo("#num_sala", "#validezSala", "#error-num_sala"),
    new Campo("#num_filas", "#validezFilas", "#error-num_filas"),
    new Campo("#num_columnas", "#validezColumnas", "#error-num_columnas")
];

$(document).ready(function() {

	for (let c of campos) {
		/* Definimos las acciones a tomar al pulsar una tecla */
		$(c.campo).on("change keyup", function() {
			tomarAccion(c.campo, c.validezCampo, c.errorCampo, "keyup");
		});
		/* Definimos las acciones a tomar al salirse del campo que se estaba editando */
		$(c.campo).on("blur", function() {
			tomarAccion(c.campo, c.validezCampo, c.errorCampo, "blur");
		});
	}

	/* 
		Definición particular de contraseña2, ya que esta también valida que sea
		igual a la contraseña1 
	*/
	$("#contraseña2").on("change keyup", function() {
		accion = comprobarContraseña2(false);
		tomarAccion("#contraseña2", "#validezContraseña2", "#error-contraseña2", "keyup", accion);
	});
	$("#contraseña2").on("blur", function() {
		accion = comprobarContraseña2(true);
		tomarAccion("#contraseña2", "#validezContraseña2", "#error-contraseña2", "blur", accion);
	});
	/*
		Definición particular de tráiler y póster, ya que también verifican el
		tipo de archivo subido
	*/
	$("#poster").on("change", function() {
		accion = comprobarArchivo("#poster", ["image/jpeg", "image/jpg", "image/png"]);
		tomarAccion("#poster", "#validezPoster", "#error-poster", "change", accion);
	});
	$("#trailer").on("change", function() {
		accion = comprobarArchivo("#trailer", ["video/mp4"]);
		tomarAccion("#trailer", "#validezTrailer", "#error-trailer", "change", accion);
	});

});

/* Comprobamos inicialmente si todo está ok, en cuyo caso mostramos el tick */
document.addEventListener("DOMContentLoaded", function() {
	for (const c of campos) {
		tomarAccion(c.campo, c.validezCampo, c.errorCampo, "load");
	}
	/* 
		Definición particular de contraseña2, ya que esta también valida que sea
		igual a la contraseña1 
	*/
	accion = comprobarContraseña2(false);
	tomarAccion("#contraseña2", "#validezContraseña2", "#error-contraseña2", "load", accion);
});