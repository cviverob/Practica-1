<?php
    require_once('../../../includes/config.php');
    require_once(RUTA_RAIZ . RUTA_USU);

    $tituloPagina = 'Añadir película';

    // Temporal, para tener permisos
    /*$_SESSION["usuario"] = Usuario::crea("fede", "a", "pito", 4, Usuario::ROL_ADMIN);

    $usuario = $_SESSION["usuario"];
    if (!!$usuario->esAdmin()) {
        $ruta_menu_prncpl = RUTA_APP . RUTA_MENU_PRNCPL;
        $contenidoPrincipal = <<< EOS
            <h1>No tienes permisos para usar esta página</h1>
            <a href = "$ruta_menu_prncpl"><button type = 'button'>Volver al menú principal</button></a>
        EOS;
    }
    else {*/
        // Si estamos modificando una sesión, deben salir los valores de dicha peli
        //$ruta_admn = RUTA_APP . RUTA_ADMN;
        $contenidoPrincipal = <<< EOS
            <form action = "procesarAniadirPelicula.php?tipo=A" method = "POST">
                <p></p>
                *Nombre:
                <input type='text' name='nombre' value="" required />
                <p></p>
                *Sinópsis:
                <input type = "text" name = "sinopsis" value = "" required />
                <p></p>
                Póster:
                <input type='file' name='poster' value="" />
                <p></p>
                Tráiler:
                <input type='file' name='trailer' value="" />
                <p></p>
                *Edad:
                <input type='text' name='edad' value="" required />
                <p></p>
                *Género:
                <input type='text' name='genero' value="" required />
                <p></p>
                *Duración:
                <input type='text' name='duracion' value="" required /> minutos
                <p></p>
                *Campo obligatorio
                <p></p>
                <button type = "submit">Confirmar</button>
            </form>
            <p></p>
            
        EOS;
    //}
    //<a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
    require(RUTA_RAIZ . RUTA_PLNT);
  