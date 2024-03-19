<?php
	require_once('../../includes/config.php');

	$tituloPagina = 'Login';
	$formulario = new es\ucm\fdi\aw\FormularioLogin();
	$htmlFormularioLogin = $formulario->gestiona();

	$contenidoPrincipal = <<<EOS
		<h1>Login</h1>
		$htmlFormularioLogin
	EOS;

	require_once(RUTA_RAIZ . RUTA_PLNT);