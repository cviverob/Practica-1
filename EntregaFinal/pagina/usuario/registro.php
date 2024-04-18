<?php
	require_once('../../includes/config.php');
	
	$tituloPagina = "Registro";
	
	$formulario = new es\ucm\fdi\aw\formularioRegistro();
	$htmlFormularioRegistro = $formulario->gestiona();

	$contenidoPrincipal = <<<EOS
		<h1>Registro</h1>
		$htmlFormularioRegistro
	EOS;

	require_once(RUTA_RAIZ . RUTA_PLNT);