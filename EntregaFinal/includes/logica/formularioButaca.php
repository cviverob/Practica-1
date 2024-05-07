<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de una butaca
     */
    class formularioButaca extends formulario {

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

        /**
         * Sesión en el caso de seleccionar y ocupar una butaca en la compra de entradas
         */
        private $sesion;

        public function __construct($sala, $fila, $columna, $sesion = null, $url = RUTA_MOD_SALA) {
            $this->sala = $sala;
            $this->fila = $fila;
            $this->columna = $columna;
            $this->sesion = $sesion;
            $this->id = ($this->fila - 1) * $this->sala->getNumColumnas() + $this->columna;
            $this->estado = $this->sala->devolverAsiento($this->id);
            $url = RUTA_APP . $url . '?id=' . $this->sala->getId();
            parent::__construct('formBut' . $this->id, ['enctype' => 'multipart/form-data',
                'urlRedireccion' => $url]);
        }

        public function generaCamposFormulario(&$datos) {
            return "<button type = 'submit' name = 'butaca' class = 'botonButaca' value = 
                {$this->estado}>{$this->fila}-{$this->columna}</button>";
        }

        public function procesaFormulario(&$datos) {
            if (!$this->sesion) {
                $ok = $this->sala->actualizarButacaAdmin($this->id);
            }
            else {
                $ok = $this->sala->actualizaButacaUsuario($this->id, $this->sesion);
            }
            if (!$ok) exit();
        }
    }
    