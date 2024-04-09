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
         * Id de la butaca
         */
        private $id;

        /**
         * Estado de la butaca
         */
        private $estado;

        /**
         * Fila de la butaca;
         */
        private $fila;

        /**
         * Columna de la butaca;
         */
        private $columna;

        public function __construct($sala, $fila, $columna) {
            $this->sala = $sala;
            $this->fila = $fila;
            $this->columna = $columna;
            $this->id = ($this->fila - 1) * $this->sala->getNumColumnas() + $this->columna;
            $this->estado = $this->sala->devolverAsiento($this->id);
            $url = RUTA_APP . RUTA_MOD_SALA . '?id=' . $this->sala->getId();
            parent::__construct('formBut' . $this->id, ['enctype' => 'multipart/form-data',
                'urlRedireccion' => $url]);
        }

        //funcion que genera los campos necesarios para el mini formulario de las salas
        public function generaCamposFormulario(&$datos) {
            return "<button type = 'submit' name = 'butaca' class = 'botonee' value = 
                {$this->estado}>{$this->fila}-{$this->columna}</button>";
        }

        public function procesaFormulario(&$datos) {
            if (!$this->sala->actualizarButacaAdmin($this->id)) {
                exit();
            }
        }
    }
    