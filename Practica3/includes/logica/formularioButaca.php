<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de una butaca
     */
    class FormularioButaca extends Formulario {

        /**
         * Sala original a al que pertenece la butaca
         */
        private $sala;

        /**
         * Posición de la butaca
         */
        private $posicion;

        public function __construct($idSala, $fila, $columna) {
            parent::__construct('formBut', ['enctype' => 'multipart/form-data']);
            $this->sala = salas::buscar($idSala);
            if (!$this->sala) {
                echo("Sala no encontrada");
                exit();
            }
            $this->posicion = salas::devolverAsiento($this->sala, $fila, $columna);
        }

        //funcion que genera los campos necesarios para el mini formulario de las salas
        public function generaCamposFormulario(&$datos) {
            $html2= "<button type = 'submit' name = 'butaca'>{$this->posicion}</button>";
            
            /**
             * HAY QUE VER DE QUÉ COLOR PINTAR EL BOTÓN EN FUNCIÓN DE SI ES UNA BUTACA
             * HABILITADA O NO
             */
            /*
            if (array_key_exists($this->posicion, $this->sala->getButacas())) {
            }
            else {

            }
            */
            return $html2;
        }

        public function procesaFormulario(&$datos) {
            //$this->sala->actualizarButaca($this->posicion);
        }
    }
    