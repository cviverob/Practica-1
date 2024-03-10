<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_PLCL);
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);

    $tituloPagina = 'Proceso de añadir película';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        $titulo = htmlspecialchars(strip_tags($_POST["nombre"]));
        $sinopsis = htmlspecialchars(strip_tags($_POST["sinopsis"]));
        /* 
            Líneas 16-18 generadas con chatgpt, usadas para guardar en img/posters/ la imagen seleccionada 
            Para los trailers se ha usado la misma técnica    
        */
        $rutaPoster = $_FILES["poster"]["name"];
        $ruta_destino_poster = RUTA_RAIZ . RUTA_PSTR .'/' . $rutaPoster;
        move_uploaded_file($_FILES["poster"]["tmp_name"], $ruta_destino_poster);
        $rutaTrailer = $_FILES["trailer"]["name"];
        $ruta_destino_trailer = RUTA_RAIZ . RUTA_TRL .'/' . $rutaTrailer;
        move_uploaded_file($_FILES["trailer"]["tmp_name"], $ruta_destino_trailer);
        $pegi = htmlspecialchars(strip_tags($_POST["edad"]));
        $genero = htmlspecialchars(strip_tags($_POST["genero"]));
        $duracion = htmlspecialchars(strip_tags($_POST["duracion"]));

        if (!is_numeric($pegi)) {
            $pelicula = false;
            $error = "El pegi debe ser un número";
        }
        else if (!is_numeric($duracion)) {
            $pelicula = false;
            $error = "La duración debe ser un número";
        }
        else {
            $pelicula = Pelicula::crea($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion);
        }

        if ($pelicula) {
            $ruta_admn = RUTA_APP . RUTA_ADMN;
            $contenidoPrincipal = <<< EOS
                <h1>Película añadida correctamente</h1>
                <a href = "$ruta_admn"><button type = 'button'>Volver al menú de administración</button></a>
            EOS;
        }
        else {
            $contenidoPrincipal = <<< EOS
                <h1>Error al añadir la película</h1>
                <p>$error</p>
            EOS;
        }
        require_once(RUTA_RAIZ . RUTA_PLNT);
    }