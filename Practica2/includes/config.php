<?php
/* */
/* Parámetros de configuración de la aplicación */
/* */

// Parámetros de configuración generales
define('RUTA_APP', dirname(__DIR__));

// img
define('RUTA_IMGS', RUTA_APP . '/img');
// img/Posters
define('RUTA_PSTR', RUTA_IMGS . '/Posters');

// src
define('RUTA_SRC', RUTA_APP . '/src');
define('RUTA_CRTLR', RUTA_SRC . '/cartelera/cartelera.php');
define('RUTA_PLCL', RUTA_SRC . '/peliculas/peliculas.php');
define('RUTA_SALA', RUTA_SRC . '/salas/salas.php');
define('RUTA_USU', RUTA_SRC . '/usuarios/usuarios.php');

// vistas
define('RUTA_VSTA', RUTA_APP . '/vistas');
// vistas/comun
define('RUTA_VSTA_CMN', RUTA_VSTA . '/comun');
define ('RUTA_PLNT', RUTA_VSTA_CMN . '/plantilla.php');
define ('RUTA_CBZ', RUTA_VSTA_CMN . '/cabecera.php');
define ('RUTA_PIE', RUTA_VSTA_CMN . '/pie.php');
define('RUTA_CSS', RUTA_VSTA_CMN . '/estilo.css');

// Parámetros de configuración de la BD ??
define('BD_HOST', 'localhost');
define('BD_NAME', 'cines');
define('BD_USER', 'root');
define('BD_PASS', '');

/* */
/* Utilidades básicas de la aplicación */
/* */

//requireonce _DIR.'/src/Utils.php';

/* */
/* Inicialización de la aplicación */
/* */

/*if (!INSTALADA) {
    Utils::paginaError(502, 'Error', 'Oops', 'La aplicación no está configurada. Tienes que modificar el fichero config.php');
}*/

/* */
/* Configuración de Codificación y timezone /
/* */

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

/* */
/* Clases y Traits de la aplicación */
/* */
//require_once 'src/Arrays.php';
//require_once 'src/traits/MagicProperties.php';

/* */
/* Clases que simulan una BD almacenando los datos en memoria */
/*
require_once 'src/usuarios/memoria/Usuario.php';
require_once 'src/mensajes/memoria/Mensaje.php';
*/

/*Configuramos e inicializamos la sesión para todas las peticiones*/
session_start([
    'cookie_path' => RUTA_APP, // Para evitar problemas si tenemos varias aplicaciones en htdocs
]);

/* */
/* Inicialización de las clases que simulan una BD en memoria */
/*
Usuario::init();
Mensaje::init();
*/

/* */
/* Clases que usan una BD para almacenar el estado */
/* */
//require_once '../src/BD.php';
//require_once 'src/usuarios/Usuario.php';