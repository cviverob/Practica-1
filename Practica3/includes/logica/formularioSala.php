<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de las salas
     */
    class formularioSala extends formulario {

        /**
         * Sala original para modificar, o null si estamos en el caso de dar de alta
         */
        private $sala;

        public function __construct($idSala = null) {
            parent::__construct('formSala', ['urlRedireccion' => RUTA_APP . RUTA_MOD_SALA, 
                'enctype' => 'multipart/form-data']
            );
            $this->sala = $idSala != null ? salas::buscar($idSala) : null;
        }

        //funcion que genera los campos necesarios para el mini formulario de las salas
        public function generaCamposFormulario(&$datos) {
            if ($this->sala) {
                $num_sala = $this->sala->getNumSala();
                $num_filas = $this->sala->getNumFilas();
                $num_columnas = $this->sala->getNumColumnas();
            }
            $num_sala = $datos['num_sala'] ?? $num_sala ?? '';
            $num_filas = $datos['num_filas'] ?? $num_filas ?? '';
            $num_columnas = $datos['num_columnas'] ?? $num_columnas ?? '';

            $html = <<<EOS
                <fieldset>
                    <legend>Datos de la sala</legend>
                    <div>
            EOS;
            $html .= $this->mostrarErroresGlobales();   // Mostramos los errores globales
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "num_sala">Número de Sala: </label>
                        <input id = "num_sala" type = "text" name = "num_sala" value = "$num_sala" />
            EOS;
            $html .= $this->mostrarError('num_sala');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "num_filas">Número de Filas: </label>
                        <input id = "num_filas" type = "text" name = "num_filas" value = "$num_filas" />
            EOS;
            $html.= $this->mostrarError('num_filas');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "num_columnas">Número de Columnas: </label>
                        <input id = "num_columnas" type = "text" name = "num_columnas" value = "$num_columnas" />
            EOS;
            $html .= $this->mostrarError('num_columnas');
            $html .= <<<EOS
                    </div>
                </fieldset>
                <div>
                    <button type = "submit" name = "sala">Generar sala</button>
                </div>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            $num_sala = trim($datos['num_sala'] ?? '');
            $num_sala = filter_var($num_sala, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$num_sala || empty($num_sala)) {
                $this->errores['num_sala'] = 'La sala no puede estar vacía';
            }
            else if (!is_numeric($num_sala)) {
                $this->errores['num_sala'] = 'La sala debe ser un número';
            }

            $num_filas = trim($datos['num_filas'] ?? '');
            $num_filas = filter_var($num_filas, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$num_filas || empty($num_filas)) {
                $this->errores['num_filas'] = 'El número de filas no puede estar vacío';
            }
            else if (!is_numeric($num_filas)) {
                $this->errores['num_filas'] = 'El número de filas debe ser un número';
            }
            else if ($num_filas < 1 || $num_filas > MAX_FILAS) {
                $this->errores['num_filas'] = 'El número de filas debe ser un número entre 1 y ' . MAX_FILAS;
            }

            $num_columnas = trim($datos['num_columnas'] ?? '');
            $num_columnas = filter_var($num_columnas, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$num_columnas || empty($num_columnas)) {
                $this->errores['num_columnas'] = 'El número de columnas no puede estar vacío';
            }
            else if (!is_numeric($num_columnas)) {
                $this->errores['num_columnas'] = 'El número de columnas debe ser un número';
            }
            else if ($num_columnas < 1 || $num_columnas > MAX_COLS) {
                $this->errores['num_columnas'] = 'El número de columnas debe ser un número entre 1 y ' . MAX_COLS;
            }

            $butacas = trim($datos['butacas'] ?? '');
            $butacas = filter_var($butacas, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            //Miramos si ha saltado algun error anteriormente
            if (count($this->errores) === 0) {
                if ($this->sala) {    // Modificar
                    if ($this->sala->modificar($num_sala, $num_filas, $num_columnas, $butacas)) {
                        $this->urlRedireccion .= "?id=" . $this->sala->getId();
                    }
                    else {
                        $this->errores[] = "Error al modificar la sala";
                    }
                }   // Dar de alta
                else if ($this->sala = salas::crear($num_sala, $num_filas, $num_columnas)) {
                    $this->urlRedireccion .= "?id=" . $this->sala->getId();
                }
                else {
                    $this->errores[] = "Error al subir la sala";
                }

            }
        }
    }
    