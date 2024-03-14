<?php
    require_once('config.php');

    function crearFormularioPelicula($nombre = '', $sinopsis = '', $pegi = '', $poster = '', $trailer = '', $genero = '', $duracion = '') {
        $ruta_proc_and_pel =  RUTA_APP . RUTA_PROC_AND_PEL;
        if (isset($_GET['nombre']) && isset($_GET['accion'])) {
            $ruta_proc_and_pel .= '?nombre=' . $_GET['nombre'] . '&accion=' . $_GET['accion'];
        }
        $ruta_admn = RUTA_APP . RUTA_ADMN;
        return <<<EOS
            <form action = "$ruta_proc_and_pel" method = "POST" enctype = "multipart/form-data">
                <fieldset>
                    <legend>Subir película</legend>
                    <div>
                        *Nombre:
                        <input type = 'text' name = 'nombre' value = "$nombre" required />
                    </div>
                    <div>
                        *Sinópsis:
                        <input type = 'text' name = 'sinopsis' value = "$sinopsis" required />
                    </div>
                    <div>
                        *Edad:
                        <input type = 'text' name = 'pegi' value = "$pegi" required />
                    </div>
                    <div>
                        *Póster:
                        <input type = 'file' name = 'poster' required />
                    </div>
                    <div>
                        *Trailer:
                        <input type = 'file' name = 'trailer' required />
                    </div>
                    <div>
                        *Género:
                        <input type ='text' name='genero' value = "$genero" required />
                    </div>
                    <div>
                        *Duración:
                        <input type = 'text' name = 'duracion' value = "$duracion" required /> minutos
                    </div>
                </fieldset>
                *Campo obligatorio
                <button type = "submit">Confirmar</button>
            </form>
            <a href = "$ruta_admn"><button type = 'button'>Cancelar</button></a>
        EOS;
    }