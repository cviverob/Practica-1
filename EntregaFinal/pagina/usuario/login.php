<?php
	require_once('../../includes/config.php');

	$tituloPagina = 'Login';
	$formulario = new es\ucm\fdi\aw\formularioLogin();
	$htmlFormularioLogin = $formulario->gestiona();

	$contenidoPrincipal = <<<EOS
		<h1>Login</h1>
		$htmlFormularioLogin
	EOS;
	$scripts = array(RUTA_APP . RUTA_JS_FORM);

	require_once(RUTA_RAIZ . RUTA_PLNT);