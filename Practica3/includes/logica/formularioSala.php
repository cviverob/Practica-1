<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de las películas
     */
    class FormularioSala extends Formulario {

        /**
         * @param sala $sala original para modificar, o null
         * si estamos en el caso de dar de alta
         */
        private $sala;

        public function __construct($idSala = null) {
            parent::__construct('formSala', ['urlRedireccion' => RUTA_APP . RUTA_ADMN, 
                'enctype' => 'multipart/form-data']
            );
            $this->sala = $idSala != null ? Salas::buscar($idSala) : null;
        }

        //funcion que genera los campos necesarios para el mini formulario de las salas
        public function generaCamposFormulario(&$datos) {

            if ($this->sala) {
                $num_sala = $this->sala->getNumSala();
                $num_filas = $this->sala->getNumFilas();
                $num_columnas = $this->sala->getNumColumnas();
            }
            $num_sala = $datos['Num_sala'] ?? $num_sala ?? '';
            $num_filas = $datos['Num_filas'] ?? $num_filas ?? '';
            $num_columnas = $datos['Num_columnas'] ?? $num_columnas ?? '';


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
            

            /* Esto va a intentar mantenerse en la misma sala, y generar botones como si fueran butacas */
            $html .= <<<EOS
                    </div>
                </fieldset>
                <div>
                    <button type = "submit" name = "login">Generar sala</button>
                </div>
            EOS;

            for($i = 1; $i < $num_columnas; $i++){
                $contenidoPrincipal .= "<div>";
                for($j = 1; $j <= $num_filas; $j++){
                    $contenidoPrincipal .= "<button type = 'button'>$i-$j</button>";
                }
                $contenidoPrincipal .= "</div>";
            }

            return $html;
        }

        public function procesaFormulario(&$datos) {
            
            $num_sala = trim($datos['num_sala'] ?? '');
            $num_sala = filter_var($num_sala, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //Comprobamos que la edad minima esta entre 0 y 18, que sea un número y que no exista esa sala
            if (!$num_sala || empty($num_sala)) {
                $this->errores['num_sala'] = 'La sala no puede estar vacía';
            }
            else if (!is_numeric($num_sala)) {
                $this->errores['num_sala'] = 'La sala debe ser un número';
            }
            else if (Salas::buscarSalaNum($num_sala)) {
                $this->errores['num_sala'] = 'La sala ya existe';
            }

            $num_filas = trim($datos['num_filas'] ?? '');
            $num_filas = filter_var($num_filas, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //Comprobamos que la edad minima esta entre 0 y 18
            if (!$num_filas || empty($num_filas)) {
                $this->errores['num_filas'] = 'El número de filas no puede estar vacío';
            }
            else if (!is_numeric($num_filas)) {
                $this->errores['num_filas'] = 'El número de filas debe ser un número';
            }
            else if ($num_filas < 0 || $num_filas > 50) {
                $this->errores['num_filas'] = 'El número de filas debe ser un número entre 0 y 50';
            }

            $num_columnas = trim($datos['num_columnas'] ?? '');
            $num_columnas = filter_var($num_columnas, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //Comprobamos que la edad minima esta entre 0 y 18
            if (!$num_columnas || empty($num_columnas)) {
                $this->errores['num_columnas'] = 'El número de columnas no puede estar vacío';
            }
            else if (!is_numeric($num_columnas)) {
                $this->errores['num_columnas'] = 'El número de columnas debe ser un número';
            }
            else if ($num_columnas < 0 || $num_columnas > 50) {
                $this->errores['num_columnas'] = 'El número de columnas debe ser un número entre 0 y 40';
            }

            //Miramos si ha saltado algun error anteriormente
            if (count($this->errores) === 0) {
                // Copiamos los archivos del póster y del tráiler
                if ($this->sala) {    // Modificar
                    if (Salas::actualizaSala($num_sala, $num_filas, $num_columnas, $butacas, $this->idSala)) {
                        header('Location: '. RUTA_APP . RUTA_ADMN);
                    }
                    else {
                        $this->errores[] = "Error al modificar la sala";
                    }
                }   // Dar de alta
                else if (Salas::crear($num_sala, $num_filas, $num_columnas, $butacas)) {
                    header('Location: '. RUTA_APP . RUTA_ADMN);
                }
                else {  
                    $this->errores[] = "Error al subir la sala";
                }
            }
        }
    }
    