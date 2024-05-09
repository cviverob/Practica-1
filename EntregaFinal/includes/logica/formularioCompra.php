<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de compra
     */
    class formularioCompra extends formulario {

        /**
         * Id de la sesión de la compra
         */
        private $idSesion;

        public function __construct($idSesion) {
            $this->idSesion = $idSesion;
            parent::__construct('formCompra', ['enctype' => 'multipart/form-data']);
        }

        public function generaCamposFormulario(&$datos) {
            $html = <<<EOS
                <button type = "submit" name = "enviar" class = "botonFormulario">Comprar</button>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            $compra = compra::procesarCompra($_SESSION['id'], $this->idSesion);
            if ($compra) {
                $this->urlRedireccion = RUTA_APP . RUTA_PROC_COMP . "?idCompra=" . $compra->getIdCompra();
            }
        }
    }
    