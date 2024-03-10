<?php
/* */
/* Parámetros de configuración de la aplicación */
/* */

// Parámetros de configuración generales
 /***** IMPORTANTE: debe actualizarse al abrirlo por primera vez *****/
define('RUTA_RAIZ', dirname(__DIR__));
define('RUTA_APP', '/Practica-SW/Practica2');
define('RUTA_INDX', '/index.php');

// img
define('RUTA_IMGS', '/img');
// img/Posters
define('RUTA_PSTR', RUTA_IMGS . '/posters');
// img/Trailers
define('RUTA_TRL', RUTA_IMGS . '/trailers');

//includes
define('RUTA_INCL', '/includes');
define('RUTA_CNFG', RUTA_INCL . '/config.php');
define('RUTA_FORM_LGIN', RUTA_INCL . '/formularioLogin.php');
define('RUTA_FORM_REG', RUTA_INCL . '/formularioRegistro.php');
define('RUTA_FORM_PLCL', RUTA_INCL . '/formularioPelicula.php');
define('RUTA_COMP_PERM', RUTA_INCL . '/comprobarPermisos.php');

// src
define('RUTA_SRC', '/src');
define('RUTA_CRTLR', RUTA_SRC . '/cartelera/cartelera.php');
define('RUTA_PLCL', RUTA_SRC . '/peliculas/peliculas.php');
define('RUTA_SALA', RUTA_SRC . '/salas/salas.php');
define('RUTA_USU', RUTA_SRC . '/usuarios/usuarios.php');
define('RUTA_BD', RUTA_SRC . '/BD.php');

// vistas
define('RUTA_VSTA', '/vistas');
// vistas/comun
define('RUTA_VSTA_CMN', RUTA_VSTA . '/comun');
define('RUTA_PLNT', RUTA_VSTA_CMN . '/plantilla.php');
define('RUTA_CBZ', RUTA_VSTA_CMN . '/cabecera.php');
define('RUTA_PIE', RUTA_VSTA_CMN . '/pie.php');
define('RUTA_CSS', RUTA_VSTA_CMN . '/estilo.css');
// vistas/pagina
define('RUTA_PGN', RUTA_VSTA . '/pagina');
define('RUTA_CONS_PELI', RUTA_PGN . '/consultaPelicula.php');
define('RUTA_SELC_BUT', RUTA_PGN . '/seleccionDeButacas.php');
define('RUTA_PROC_COMP', RUTA_PGN . '/procesarCompra.php');
// vistas/pagina/administracion
define('RUTA_PGN_ADMN', RUTA_PGN . '/administracion');
define('RUTA_ADMN', RUTA_PGN_ADMN . '/administracion.php');
// vistas/pagina/administracion/pelicula
define('RUTA_PGN_ADMN_PEL', RUTA_PGN_ADMN . '/pelicula');
define('RUTA_AND_PEL', RUTA_PGN_ADMN_PEL . '/aniadirPelicula.php');
define('RUTA_BSC_PEL', RUTA_PGN_ADMN_PEL . '/buscarPelicula.php');
define('RUTA_PROC_AND_PEL', RUTA_PGN_ADMN_PEL . '/procesarAniadirPelicula.php');
define('RUTA_PROC_BSC_PEL', RUTA_PGN_ADMN_PEL . '/procesarBusquedaPeliculas.php');
// vistas/pagina/administracion/sala
define('RUTA_PGN_ADMN_SALA', RUTA_PGN_ADMN . '/sala');
define('RUTA_AND_SALA', RUTA_PGN_ADMN_SALA . '/aniadirSala.php');
define('RUTA_BSC_SALA', RUTA_PGN_ADMN_SALA . '/buscarSala.php');
define('RUTA_MOD_SALA', RUTA_PGN_ADMN_SALA . '/modificarSala.php');
define('RUTA_PROC_BSC_SALA', RUTA_PGN_ADMN_SALA . '/procesarBusquedaSala.php');
// vistas/pagina/administracion/sesion
define('RUTA_PGN_ADMN_SES', RUTA_PGN_ADMN . '/sesion');
define('RUTA_AND_SES', RUTA_PGN_ADMN_SES . '/aniadirSesion.php');
define('RUTA_BSC_SES', RUTA_PGN_ADMN_SES . '/buscarSesion.php');
define('RUTA_PROC_BSC_SES', RUTA_PGN_ADMN_SES . '/procesarBusquedaSesiones.php');
// vistas/pagina/usuario
define('RUTA_PGN_USU', RUTA_PGN . '/usuario');
define('RUTA_LGIN', RUTA_PGN_USU . '/login.php');
define('RUTA_LGOUT', RUTA_PGN_USU . '/logout.php');
define('RUTA_PROC_LOG', RUTA_PGN_USU . '/procesarLogin.php');
define('RUTA_PROC_REG', RUTA_PGN_USU . '/procesarRegistro.php');
define('RUTA_REG', RUTA_PGN_USU . '/registro.php');

// Parámetros de configuración de la BD ??
define('BD_HOST', 'localhost');
define('BD_NAME', 'cines');
define('BD_USER', 'cines');
define('BD_PASS', 'cines');

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
require_once(RUTA_RAIZ . RUTA_BD);
require_once(RUTA_RAIZ . RUTA_USU);