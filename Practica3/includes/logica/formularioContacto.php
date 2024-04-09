<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de contacto con el personal
     */
    class formularioContacto extends Formulario {

        public function __construct() {
            parent::__construct('formContacto', ['enctype' => 'multipart/form-data']);
        }

        public function generaCamposFormulario(&$datos) {
            $nombre = $datos["nombre"] ?? "";
            $correo = $datos["correo"] ?? "";
            $consulta = $datos["consulta"] ?? "";
            $html = <<<EOS
                <fieldset>
                    <legend>Información sobre la consulta</legend>
                    <div>
            EOS;
            $html .= $this->mostrarErroresGlobales();   // Mostramos los errores globales
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "nombre">Nombre: </label>
                        <input id = "nombre" type = "text" name = "nombre" value = $nombre>
            EOS;
            $html .= $this->mostrarError('nombre');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "correo">Correo electrónico: </label>
                        <input id = "correo" type = "text" name = "correo" value = $correo>
            EOS;
            $html .= $this->mostrarError('correo');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for="tipo_consulta">Motivo de consulta:</label>
                        <input id = "tipo_consulta" type = "radio" name = "tipo_consulta">Evaluación
                        <input id = "tipo_consulta1" type = "radio" name = "tipo_consulta">Sugerencias
                        <input id = "tipo_consulta2" type = "radio" name = "tipo_consulta">Críticas
                    </div>
                    <div>
                        <p>Escriba aquí su consulta:</p>
                        <textarea name = "consulta" rows = "4" cols = "50" value = $consulta></textarea>
            EOS;
            $html .= $this->mostrarError('consulta');
            $html .= <<<EOS
                    </div>
                    <div>
                    <input name = "check" type="checkbox"> Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio
                    </div>
                    <button type = "submit" name = "enviar">Enviar formulario</button>
                    <button type = "reset" name = "borrar">Borrar formulario</button>
                </fieldset>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            $nombre = trim($datos['nombre'] ?? '');
            $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$nombre || empty($nombre)) {
                $this->errores['nombre'] = 'El nombre no puede estar vacío';
            }

            $correo = trim($datos['correo'] ?? '');
            $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$correo || empty($correo)) {
                $this->errores['correo'] = 'El correo no puede estar vacío';
            }

            $consulta = filter_var($datos['consulta'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$nombre || empty($consulta)) {
                $this->errores['consulta'] = 'La consulta no puede estar vacía';
            }

            if (count($this->errores) === 0) {
                mail("cvivero@ucm.es", "Sugerencia", $consulta);
            }
        }
    }
    