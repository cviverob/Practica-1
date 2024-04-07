<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase abstracta encargada de gestionar los formularios
     * Cualquier subclase de esta bastará con sobreescribir los
     * métodos de generaCamposFormulario() y procesaFormulario(),
     * además de incorporar en su constructor los parámetros
     * necesarios para hacer una llamada al del padre
     */
    abstract class Formulario {

        /**
         * @var string Identificador del formulario
         */
        protected $idForm;

        /**
         * @var string Método HTTP utilizado para enviar el formulario
         */
        protected $method;

        /**
         * @var string Dirección encargada de gestionar los datos del formulario
         */
        protected $action;

        /**
         * @var string Cadena asociada al campo class del formulario
         */
        protected $class;

        /**
         * @var string Valor del parámetro enctype del formulario
         */
        protected $enctype;

        /**
         * @var string Url a la que redirigir en caso de un procesamiento 
         * exitoso del formulario 
         */
        protected $urlRedireccion;

        /**
         * @param string[] Array con los mensajes de error de validación 
         * y/o procesamiento del formulario.
         */
        protected $errores;

        /**
         * Constructor de la clase
         * @param string $idForm id del formulario
         * @param string[] $opciones Array con posibles valores para el resto
         * de atributos. En caso de faltar valores se aplican unos por defecto
         */
        public function __construct($idForm, $opciones) {
            $opcionesPorDefecto = array('action' => null, 'method' => 'POST', 
                'class' => 'Formulario', 'enctype' => null, 'urlRedireccion' => null);
            $opciones = array_merge($opcionesPorDefecto, $opciones); // Agrega las opciones por defecto a las pasadas por parámetro
            $this->idForm = $idForm;
            $this->action = $opciones['action'];
            $this->method = $opciones['method'];
            $this->class = $opciones['class'];
            $this->enctype  = $opciones['enctype'];
            $this->urlRedireccion = $opciones['urlRedireccion'];
            if (!$this->action) { // Si no se establece una url, se usa la misma en la que ya se encuentra el usuario
                $this->action = htmlspecialchars($_SERVER['REQUEST_URI']);
            }
        }

        /**
         * Método que debe ser implementada para generar un formulario
         * @param string $datos Contiene los valores por defecto de los
         * campos del formulario. De no existir, estos estarán vacíos
         */
        abstract function generaCamposFormulario(&$datos);

        /**
         * Método que debe ser implementada para procesar un formulario
         * @param string $datos Contiene los datos enviados a través
         * del formulario para ser procesados
         */
        abstract function procesaFormulario(&$datos);

        /**
         * Método que muestra los errores globales que no están asociados
         * a un único campo en específico
         */
        protected function mostrarErroresGlobales() {
            $clavesErroresGlobales = array_filter(array_keys($this->errores), function ($elem) {
                return is_numeric($elem);
            }); // Filtra las claves para no incluir las que sean de un campo específico

            if (count($clavesErroresGlobales) == 0) {
                return '';
            }

            $html = "<ul class=\"$this->classAtt\">";
            foreach ($clavesErroresGlobales as $clave) {
                $html .= "{$this->errores[$clave]}";
            }
            $html .= '</ul>';
            return $html;
        }

        /**
         * Método que devuelve el error asociado en caso de existir
         * @param string $idError Identificador del error
         * @param string $htmlElement etiqueta HTML que se le aplicará
         * al mensaje de error, span por defecto
         */
        protected function mostrarError($idError, $htmlElement = 'span') {
            if (!isset($this->errores[$idError])) { // Si no existe el error devolvemos una cadena vacía
                return '';
            }
            return "<$htmlElement>{$this->errores[$idError]}</$htmlElement>";
        }

        /**
         * Método que comprueba si un formulario ha sido enviado o no, 
         * haciendo uso del atributo formId
         * @param string[] datos Datos del formulario
         */
        protected function formularioEnviado(&$datos) {
            return isset($datos['idForm']) && $datos['idForm'] == $this->idForm;
        }

        /**
         * Método encargado de comprobar si se ha realizado o no el formulario.
         * Si no se ha hecho, se muestra el formulario
         * Si se ha hecho, se procesa, y:
         *  Si hay errores, se vuelve a mostrar
         *  Si no los hay, se da por finalizado el proceso y se redirecciona al usuario en caso
         *  de haber una url de redirección establecida
         */
        public function gestiona() {
            $datos = &$_POST;
            if (strcasecmp('GET', $this->method) == 0) {
                $datos = &$_GET;
            } 
            $this->errores = [];

            if (!$this->formularioEnviado($datos)) {    // Si no se ha enviado se muestra
                return $this->generaFormulario();
            }

            $this->procesaFormulario($datos);
            $esValido = count($this->errores) === 0;

            if (!$esValido) {     // Si hay errores se vuelve a mostrar
                return $this->generaFormulario($datos);
            }

            if ($this->urlRedireccion !== null) {   // Si hay una url de redirección, le redireccionamos
                header("Location: {$this->urlRedireccion}");
                exit();
            }
        }

        /**
         * Muestra el formulario con sus errores y los campos del formulario
         * generados por la instancia de la clase
         * @param string[] datos Contiene los valores por defecto de los
         * campos del formulario. De no existir, estos estarán vacíos
         */
        protected function generaFormulario(&$datos = array()) {
            $classAtt = $this->class != null ? "class=\"{$this->class}\"" : '';
            $enctypeAtt = $this->enctype != null ? "enctype=\"{$this->enctype}\"" : '';

            $htmlForm = <<<EOS
            <form method = "{$this->method}" action = "{$this->action}" id = "{$this->idForm}" {$classAtt} {$enctypeAtt}>
                <input type = "hidden" name = "idForm" value = "{$this->idForm}" />
            EOS;
            $htmlForm .= $this->generaCamposFormulario($datos); // Generamos el contenido del formulario
            $htmlForm .= <<<EOS
                </form>
            EOS;
            return $htmlForm;
        }

    }