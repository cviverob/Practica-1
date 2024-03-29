<?php
    /* Parámetros de configuración de la aplicación */

    /**
     * Rutas
     * Las funciones php utilizan rutas absolutas, por lo que se use RUTA_RAIZ, mientras que
     * las html usan relativas a localhost, por lo que se utiliza RUTA_APP
     */
    define('RUTA_RAIZ', dirname(__DIR__));
    define('RUTA_APP', '/Practica-SW/Practica3');
    define('RUTA_INDX', '/index.php');
    // img
    define('RUTA_IMGS', '/img');
    // img/Posters
    define('RUTA_PSTR', RUTA_IMGS . '/posters');
    // img/Trailers
    define('RUTA_TRL', RUTA_IMGS . '/trailers');
    // includes
    define('RUTA_INCL', '/includes');
    define('RUTA_CNFG', RUTA_INCL . '/config.php');
    // includes/apoyo
    define('RUTA_APY', RUTA_INCL . '/apoyo');
    define('RUTA_UTILS', RUTA_APY . '/utils.php');
    // includes/logica
    define('RUTA_LGC', RUTA_INCL . '/logica');
    define('RUTA_CRTLR', RUTA_LGC . '/cartelera.php');
    define('RUTA_PLCL', RUTA_LGC . '/peliculas.php');
    define('RUTA_SALA', RUTA_LGC . '/salas.php');
    define('RUTA_USU', RUTA_LGC . '/usuarios.php');
    define('RUTA_BD', RUTA_LGC . '/BD.php');
    define('RUTA_FORM_LGIN', RUTA_LGC . '/formularioLogin.php');
    define('RUTA_FORM_REG', RUTA_LGC . '/formularioRegistro.php');
    define('RUTA_FORM_PLCL', RUTA_LGC . '/formularioPelicula.php');
    define('RUTA_COMP_PERM', RUTA_LGC . '/comprobarPermisos.php');
    // includes/vistas
    define('RUTA_VSTA', RUTA_INCL . '/vistas');
    // includes/vistas/comun
    define('RUTA_VSTA_CMN', RUTA_VSTA . '/comun');
    define('RUTA_CBZ', RUTA_VSTA_CMN . '/cabecera.php');
    define('RUTA_PIE', RUTA_VSTA_CMN . '/pie.php');
    // includes/vistas/css
    define('RUTA_VSTA_CSS', RUTA_VSTA . '/css');
    define('RUTA_CSS', RUTA_VSTA_CSS . '/estilo.css');
    // includes/vistas/plantillas
    define('RUTA_VSTA_PLNT', RUTA_VSTA . '/plantillas');
    define('RUTA_PLNT', RUTA_VSTA_PLNT . '/plantilla.php');
    // pagina
    define('RUTA_PGN', '/pagina');
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
    define('RUTA_REG', RUTA_PGN_USU . '/registro.php');

    /**
     * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
     */
    ini_set('default_charset', 'UTF-8');
    setLocale(LC_ALL, 'es_ES.UTF.8');
    date_default_timezone_set('Europe/Madrid');

    /**
     * Inicio del procesamiento
     */
    session_start([
        'cookie_path' => RUTA_APP, // Para evitar problemas si tenemos varias aplicaciones en htdocs
    ]);

    /**
     * Autoloader del proyecto
     */
    spl_autoload_register(function ($class) {
    
        // project-specific namespace prefix
        $prefix = 'es\\ucm\\fdi\\aw\\';
        
        // base directory for the namespace prefix
        $base_dir = RUTA_RAIZ . RUTA_LGC . '/';
        
        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }
        
        // get the relative class name
        $relative_class = substr($class, $len);
        
        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    });

    /**
     * Configuración de la BD
     */
    define('BD_HOST', 'localhost');
    define('BD_NAME', 'cines');
    define('BD_USER', 'cines');
    define('BD_PASS', 'cines');
    $app = es\ucm\fdi\aw\Aplicacion::getInstance();
    $app->init(['host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS]);
    register_shutdown_function([$app, 'cierraConexion']);
