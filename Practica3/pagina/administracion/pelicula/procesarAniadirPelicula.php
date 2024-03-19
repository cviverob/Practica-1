<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_COMP_PERM);
    require_once(RUTA_RAIZ . RUTA_FORM_PLCL);

    $tituloPagina = 'Proceso de añadir película';

    $contenidoPrincipal = comprobarPermisos($_SESSION["usuario_admin"]);
    if (!$contenidoPrincipal) {
        $nombre = htmlspecialchars(strip_tags($_POST["nombre"]));
        $sinopsis = htmlspecialchars(strip_tags($_POST["sinopsis"]));
        /* 
            Uso de $_FILES y de move_uploaded_file realizado con chatgpt, para poder
            mover un póster y un tráiler a su correspondiente directorio de nuestro
            proyecto  
        */
        $rutaPoster = $_FILES['poster']['name'];
        $ruta_destino_poster = RUTA_PSTR .'/' . $rutaPoster;
        move_uploaded_file($_FILES['poster']['tmp_name'], RUTA_RAIZ . $ruta_destino_poster);
        $rutaTrailer = $_FILES['trailer']['name'];
        $ruta_destino_trailer = RUTA_TRL .'/' . $rutaTrailer;
        move_uploaded_file($_FILES['trailer']['tmp_name'], RUTA_RAIZ . $ruta_destino_trailer);
        $pegi = htmlspecialchars(strip_tags($_POST['pegi']));
        $genero = htmlspecialchars(strip_tags($_POST['genero']));
        $duracion = htmlspecialchars(strip_tags($_POST['duracion']));

        if (!is_numeric($pegi)) {
            $pelicula = false;
            $error = "El pegi debe ser un número";
        }
        else if (!is_numeric($duracion)) {
            $pelicula = false;
            $error = "La duración debe ser un número";
        }
        else {
            /* 
                En el caso de modificar una película, crea recibirá el nombre de esta, de tal manera
                que si modificamos el nombre, la BD sepa cual era el nombre de la peli a modificar
            */
            if (isset($_GET['nombre']) && isset($_GET['accion']) && $_GET['accion'] == 'M') {
                $aux = $_GET['nombre'];
            }
            else {
                $aux = null;
            }
            $pelicula = es\ucm\fdi\aw\Pelicula::crea($nombre, $sinopsis, RUTA_APP . $ruta_destino_poster, RUTA_APP . $ruta_destino_trailer, $pegi, $genero, $duracion, $aux);
        }

        if ($pelicula) {
            $ruta_admn = RUTA_APP . RUTA_ADMN;
            $contenidoPrincipal = <<< EOS
                <h1>Película subida correctamente</h1>
                <a href = "$ruta_admn"><button type = 'button'>Volver al menú de administración</button></a>
            EOS;
        }
        else {
            $contenidoPrincipal = <<< EOS
                <h1>Error al añadir la película</h1>
                <p>$error</p>
            EOS;
            $contenidoPrincipal .= crearFormularioPelicula($nombre, $sinopsis, $pegi, $rutaPoster, $rutaTrailer, $genero, $duracion);
        }
        require_once(RUTA_RAIZ . RUTA_PLNT);
    }