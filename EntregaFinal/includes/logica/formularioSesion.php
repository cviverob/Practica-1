<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de login
     */
    class formularioSesion extends formulario {

        public function __construct() {
            parent::__construct('formSes', ['urlRedireccion' => RUTA_APP . RUTA_INDX]);
        }

        public function generaCamposFormulario(&$datos) {
            /* Obtenemos los valores predeterminados */
            $pelicula = $datos['pelicula'] ?? '';
            $sala = $datos['sala'] ?? '';
            $fecha = $datos['fecha'] ?? '';
            $hora = $datos['hora'] ?? '';
            $visibilidad = isset($datos["visibilidad"]) ? $datos["visibilidad"] :  false;
            /* Inicio del formulario */
            $html = <<<EOS
                <fieldset>
                    <legend>Sesion</legend>
                    <div>
            EOS;
            $html .= $this->mostrarErroresGlobales();
            /* Pelicula */
            $listaPeliculas = pelicula::getPeliculas();
            $opciones = "";
            foreach ($listaPeliculas as $peli) {
                $seleccionada = $pelicula == $peli->getId() ? " selected" : "";
                $opciones .= "<option value = " . $peli->getId() . $seleccionada . ">" . $peli->getTitulo() . "</option>";
            }
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "pelicula">Película:</label>
                        <select name = "pelicula" id = "pelicula">
                            $opciones
                        </select>
            EOS;
            $html.= $this->mostrarError('pelicula');
            /* Salas */
            $listaSalas = salas::getSalas();
            $opciones = "";
            foreach ($listaSalas as $sal) {
                $seleccionada = $sala == $sal->getId() ? " selected" : "";
                $opciones .= "<option value = " . $sal->getId() . $seleccionada . ">" . $sal->getNumSala() . "</option>";
            }
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "sala">Sala:</label>
                        <select name = "sala" id = "sala">
                            $opciones
                        </select>
            EOS;
            $html.= $this->mostrarError('sala');
            /* Fecha */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "fecha">Fecha:</label>
                        <input type = "date" id = "fecha" name = "fecha" value = $fecha>
            EOS;
            $html.= $this->mostrarError('fecha');
            /* Hora */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "hora">Hora de inicio:</label>
                        <input type = "time" id = "hora" name = "hora" value = $hora>
            EOS;
            $html.= $this->mostrarError('hora');
            /* Botón de la visibilidad */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "visibilidad">¿Quieres que sea visible?</label>
                        <input id = "visibilidad" type = "checkbox" name = "visibilidad" {($visibilidad ? 'checked' : '')}>
            EOS;
            /* Botón de confirmar y borrado */
            $html .= <<<EOS
                    </div>
                </fieldset>
                    <button type = "submit" name = "subir" class = "botonFormulario">Entrar</button>
                    <button type = "reset" name = "borrar" class = "botonFormulario">Resetear</button>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            
        }

    }