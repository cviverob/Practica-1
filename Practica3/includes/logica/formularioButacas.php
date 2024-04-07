<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de las salas
     */
    class FormularioButacas extends Formulario {

        /**
         * Sala original para modificar, o null si estamos en el caso de dar de alta
         */
        private $sala;

        public function __construct($idSala) {
            parent::__construct('formBut', ['urlRedireccion' => RUTA_APP . RUTA_ADMN, 
                'enctype' => 'multipart/form-data']
            );
            $this->sala = Salas::buscar($idSala);
            if (!$this->sala) {
                echo("Sala no encontrada");
                exit();
            }
        }

        //funcion que genera los campos necesarios para el mini formulario de las salas
        public function generaCamposFormulario(&$datos) {

            //codigo copiado del formulario de salas para que todo se vea mejor
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
            $html .= "</div>" . "\n";
            $html1 = "";
            for ($fila = 1; $fila <= $this->sala->getNumFilas(); $fila++) {
                for ($columna = 1; $columna <=  $this->sala->getNumColumnas(); $columna++) {
                    $formButaca = new FormularioButaca($this->sala->getId(), $fila, $columna);
                    $html1 .= $formButaca->gestiona();
                }
            }
            
            $html .= $html1 . <<<EOS
                <div>
                    <button type = "submit" name = "but">Crear sala</button>
                </div>
            EOS;

            return $html;
        }

        public function procesaFormulario(&$datos) {
            
        }
    }
    