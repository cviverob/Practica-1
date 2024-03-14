<?php
    require_once('../../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_PLCL);
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);
    require_once(RUTA_RAIZ . RUTA_FORM_PLCL);

    $tituloPagina = 'Tabla de películas';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        $nombre = $_GET['nombre'];
        $accion = $_GET['accion'];
        
        // Borrar película
        if ($accion == 'B') {
            if (Pelicula::borrarPelicula($nombre)) {
                $msg = "Película eliminada correctamente";
            }
            else {
                $msg = "Error al eliminar la película";
            }
            $ruta_admn = RUTA_APP . RUTA_ADMN;
            $contenidoPrincipal = <<<EOS
                <h1>$msg<h1>
                <a href = "$ruta_admn"><button type = 'button'>Volver al menú de administración</button></a>
            EOS;
        }
        // Modificar la película
        else if ($accion == 'M') {
            $titulo = $_GET['nombre'];
            // Recuperar los datos de la película de la base de datos
            $pelicula = Pelicula::buscaPelicula($titulo);
            
            // Verificar si se encontró la película
            if ($pelicula) {
                // Establecer los valores predeterminados de los campos del formulario
                $nombre = $pelicula->getTitulo();
                $sinopsis = $pelicula->getSinopsis();
                $pegi = $pelicula->getPegi();
                $poster = $pelicula->getRutaPoster();
                $trailer = $pelicula->getRutaTrailer();
                $genero = $pelicula->getGenero();
                $duracion = $pelicula->getDuracion();
                
                $contenidoPrincipal = crearFormularioPelicula($nombre, $sinopsis, $pegi, $poster, $trailer, $genero, $duracion);
            }
            else {
                $ruta_admn = RUTA_RAIZ . RUTA_ADMN;
                $contenidoPrincipal = <<<EOS
                    <h1>Error al seleccionar la película<h1>
                    <a href = "$ruta_admn"><button type = 'button'>Volver al menú de administración</button></a>
                EOS;
            }
        }
        // Cualquier otra opción no contemplada
        else {
            $ruta_admn = RUTA_RAIZ . RUTA_ADMN;
            $contenidoPrincipal = <<<EOS
                <h1>Opción no permitida<h1>
                <a href = "$ruta_admn"><button type = 'button'>Volver al menú de administración</button></a>
            EOS;
        }
    }
    require(RUTA_RAIZ . RUTA_PLNT);
