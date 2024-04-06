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
            $html = "";
            for ($fila = 1; $fila <=  $this->sala->getNumFilas(); $fila++) {
                for ($columna = 1; $columna <=  $this->sala->getNumColumnas(); $columna++) {
                    $formButaca = new FormularioButaca($this->sala->getId(), $fila, $columna);
                    $html .= $formButaca->gestiona();
                }
            }
            return $html;
        }

        public function procesaFormulario(&$datos) {
            
        }
    }
    