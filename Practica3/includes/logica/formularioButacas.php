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
            $this->sala = Salas::buscar($idSala);
            if (!$this->sala) {
                echo("Sala no encontrada");
                exit();
            }
            parent::__construct('formButs', ['urlRedireccion' => RUTA_APP . RUTA_MOD_SALA . 
                "?id=" . $this->sala->getId(), 'enctype' => 'multipart/form-data']
            );
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
            $html .= <<<EOS
                    </div>
                    <div>
                        <button type = "submit" name = "but">Regenerar sala</button>
                    </div>
            EOS;
            $html .= "<div class='contenedor-butacas'>";
            for ($fila = 1; $fila <= $this->sala->getNumFilas(); $fila++) {
                $html .= "<div class='fila-butacas'>";
                for ($columna = 1; $columna <=  $this->sala->getNumColumnas(); $columna++) {
                    $formButaca = new FormularioButaca($this->sala, $fila, $columna);
                    $html .= $formButaca->gestiona();
                }
                $html .= "</div>";
            }
            $rutaAdmin = RUTA_APP . RUTA_ADMN;
            $html .= <<<EOS
                    </div>
                    <a href = $rutaAdmin>Terminar</a>
            EOS;

            return $html;
        }

        public function procesaFormulario(&$datos) {
            $retorno = procesaFormularioSala($datos);
            $this->errores = $retorno["errores"];
    
            //Miramos si ha saltado algun error anteriormente
            if (count($this->errores) === 0) {
                if ($this->sala->modificar($retorno["num_sala"], $retorno["num_filas"], $retorno["num_columnas"])) {
                    $this->urlRedireccion .= "?id=" . $this->sala->getId();
                }
                else {
                    $this->errores[] = "Error al modificar la sala";
                }
            }
        }
    }
    