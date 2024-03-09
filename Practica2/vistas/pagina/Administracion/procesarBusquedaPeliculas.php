<?php
    require_once('../../../includes/config.php');
    require_once('../../../src/peliculas/peliculas.php');

    $tituloPagina = 'Tabla de películas';

    // Temporal, para tener permisos
    //$_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);
/*
    $usuario = $_SESSION["usuario"];
    if (!!$usuario->esAdmin()) {
        $ruta_menu_prncpl = RUTA_APP . RUTA_MENU_PRNCPL;
        $contenidoPrincipal = <<< EOS
            <h1>No tienes permisos para usar esta página</h1>
            <a href = "$ruta_menu_prncpl"><button type = 'button'>Volver al menú principal</button></a>
        EOS;
    }
    else {*/
        /*
            Aquí se mostrará una tabla con las coincidencias enontradas y sus respectivos datos,
            guardando en la sesión la película seleccionada para redirigirnos a aniadirPelicula.php
            con los datos de la misma preescritos. Además, dejará borrar una fila.
        */
        $nombre = $_GET['nombre'];
        $accion = $_GET['accion'];
        
        //si nuestra accion es para borrar la peli, llamamos a peliculas y lo borramos
        if ($accion == 'B') {
            Pelicula::borrarPelicula($nombre);
            require('administracion.php');
        }
        else {
            $nombre = $_GET['nombre'];
            // Recuperar los datos de la película de la base de datos
            $pelicula = Pelicula::buscarPelicula($nombre);
            
            // Verificar si se encontró la película
            if ($pelicula) {
                // Establecer los valores predeterminados de los campos del formulario
                $nombre = $pelicula->getNombre();
                $sinopsis = $pelicula->getSinopsis();
                $poster = $pelicula->getRutaPoster();
                $trailer = $pelicula->getRutaTrailer();
                $edad = $pelicula->getPegi();
                $genero = $pelicula->getGenero();
                $duracion = $pelicula->getDuracion();
                
                // Generar el formulario con los valores predeterminados
                $contenidoPrincipal = <<<EOS
                    <form action="procesarAniadirPelicula.php" method="POST">
                        <p></p>
                        *Nombre:
                        <input type="text" name="nombre" value="$nombre" required />
                        <p></p>
                        *Sinópsis:
                        <input type="text" name="sinopsis" value="$sinopsis" required />
                        <p></p>
                        *Campo obligatorio
                        <p></p>
                        Póster:
                        <input type='file' name='poster' value="$poster" />
                        <p></p>
                        Tráiler:
                        <input type='file' name='trailer' value="$trailer" />
                        <p></p>
                        *Edad:
                        <input type='text' name='edad' value="$edad" required />
                        <p></p>
                        *Género:
                        <input type='text' name='genero' value="$genero" required />
                        <p></p>
                        *Duración:
                        <input type='text' name='duracion' value="$duracion" required /> minutos
                        <p></p>
                        *Campo obligatorio
                        <p></p>
                        <button type = "submit">Confirmar</button>
                    </form>
                    <p></p>
                    
                    EOS;
        }
    //<a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
    require(RUTA_RAIZ . RUTA_PLNT);
