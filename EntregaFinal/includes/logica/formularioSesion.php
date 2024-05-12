<?php
    namespace es\ucm\fdi\aw;


    /**
     * Clase encargada del formulario de login
     */
    class formularioSesion extends formulario {
        public $sesion;

        public function __construct($id = null) {
            parent::__construct('formSes', ['urlRedireccion' => RUTA_APP . RUTA_ADMN]);
            $this->sesion = $id == null ? null : sesion::buscar($id);
        }

        public function generaCamposFormulario(&$datos) {
            /* Obtenemos los valores predeterminados */
            if ($this->sesion) {
                $pelicula = $this->sesion->getIdPelicula();
                $sala = $this->sesion->getIdSala();
                $fecha = $this->sesion->getFecha();
                $horaIni = $this->sesion->getHoraIni();
                $horaFin = $this->sesion->getHoraFin();
                $visibilidad = $this->sesion->getVisibilidad();
            }
            $pelicula = $datos['pelicula'] ?? $pelicula ?? '';
            $sala = $datos['sala'] ?? $sala ?? '';
            $fecha = $datos['fecha'] ?? $fecha ?? '';
            $horaIni = $datos['horaIni'] ?? $horaIni ?? '';
            $horaFin = $datos['horaFin'] ?? $horaFin ?? '';
            $visibilidad = isset($datos["visibilidad"]) ? $datos["visibilidad"] : $visibilidad ?? false;
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
                        <span id = "validezFecha"></span>
            EOS;
            $html.= $this->mostrarError('fecha');
            /* Hora inicial */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "horaIni">Hora de inicio:</label>
                        <input type="time" id="horaIni" name="horaIni" value = $horaIni>
                        <span id = "validezHora"></span>
            EOS;
            $html.= $this->mostrarError('horaIni');
            /* Hora final, campo cuyo propósito es ser usado en el javascript */
            $html .= <<<EOS
                    </div>
                    <input type = "time" hidden id = "horaFin" name = "horaFin" value = $horaFin>
            EOS;
            /* Botón de la visibilidad */
            $check = $visibilidad ? 'checked' : '';
            $html .= <<<EOS
                    <div>
                        <label for = "visibilidad">¿Quieres que sea visible?</label>
                        <input id = "visibilidad" type = "checkbox" name = "visibilidad" $check>
            EOS;
            /* Botón de confirmar y borrado */
            $html .= <<<EOS
                    </div>
                </fieldset>
                    <button type = "submit" name = "subir" class = "botonFormulario">Subir</button>
                    <button type = "reset" name = "borrar" class = "botonFormulario">Resetear</button>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            $idPelicula = $datos["pelicula"];
            $sala = $datos["sala"];
            /* Validación de la fecha */
            $fecha = $datos["fecha"];
            if (!$fecha) {
                $this->errores["fecha"] = "La fecha no puede estar vacía";
            }
            /* Validación de la hora */
            $hora = $datos["horaIni"] . ($this->sesion ? "" : ":00");
            $pelicula = pelicula::buscar($idPelicula);
            // Manipulación de la hora extraída del chatgpt
            $horaIni = \DateTime::createFromFormat('H:i:s', $hora);
            if (!$horaIni) {
                $this->errores["horaIni"] = "La hora no puede estar vacía";
            }
            else {
                $horaFin = \DateTime::createFromFormat('H:i:s', $hora);
                $horaFin->add(new \DateInterval("PT" . $pelicula->getDuracion() + 10 . "M"));
                if ($horaFin->format("H:m:s") < $horaIni->format("H:m:s")) {
                    $this->errores[] = "La hora de finalización sobrepasa las 24:00, " . $horaFin->format("H:i");
                }
            }
            $visibilidad = isset($datos["visibilidad"]) ? 1 : 0;
            /* Intento de subir la sesión */
            if (count($this->errores) == 0) {
                if ($this->sesion) {    // Modificar sesión
                    $this->sesion = sesion::modificar($this->sesion->getId(), $idPelicula, $sala, 
                        $fecha, $horaIni->format("H:i:s"), $horaFin->format("H:i:s"), $visibilidad);
                    if (!$this->sesion) {
                        $this->errores[] = "La sala está ocupada a esa hora";
                    }
                }
                else {  // Añadir sesión
                    $sesion = sesion::crear($idPelicula, $sala, $fecha, $horaIni->format("H:i:s"), $horaFin->format("H:i:s"), $visibilidad);
                    if (!$sesion) {
                        $this->errores[] = "La sala está ocupada a esa hora";
                    }
                }
            }
        }

    }