<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase Aplicación que implementa el patrón Singleton para garantizar una única instancia
     * de la misma. Se encarga de la inicialización y acceso a la bd.
     */
    class aplicacion {

        /**
         * Instancia de la propia clase
         */
        private static $app = null;

        /**
         * Conexión a la bd
         */
        private $conn = null;

        /**
         * Datos de la conexión
         */
        private  $bdDatosConexion = null;
        
        /**
         * Indica si ha sido inicializada o no
         */
        private $inicializada = false;

        /**
         * Constructor de la clase
         */
        private function __construct() {
            
        }

        /**
         * Método para obtener la instancia de la clase
         * Si la instancia no existe, se crea, y finalmente se devuelve
         */
        public static function getInstance() {
            if (self::$app == null) {
                self::$app = new aplicacion();
            }
            return self::$app;
        }

        /**
         * Método para inicializar la instancia de la aplicación
         */
        public function init($bdDatosConexion) {
            if (!$this->inicializada) {
                $this->bdDatosConexion = $bdDatosConexion;
                $this->inicializada = true;
            }
        }

        /**
         * Método que devuelve una conexion a la bd, y de no existir, la crea
         */
        public function getConexionBd() {
            if (!$this->conn) {
                $this->compruebaInstanciaInicializada();
                $host = $this->bdDatosConexion['host'];
                $user = $this->bdDatosConexion['user'];
                $pass = $this->bdDatosConexion['pass'];
                $bd = $this->bdDatosConexion['bd'];
                $conn = new \mysqli($host, $user, $pass, $bd);
                if ($conn->connect_errno) {
                    echo "Error de conexión a la BD ({$conn->connect_errno}):  {$conn->connect_error}";
                    exit();
                }
                if (!$conn->set_charset("utf8mb4")) {
                    echo "Error al configurar la BD ({$conn->errno}):  {$conn->error}";
                    exit();
                }
                $this->conn = $conn;
            }
            return $this->conn;
        }

        /**
         * Realiza el cierre de la aplicación, comprobando si esta estaba
         * abierta y cerrando la conexión
         */
        public function cierraConexion() {
            $this->compruebaInstanciaInicializada();
            if ($this->conn !== null && ! $this->conn->connect_errno) {
                $this->conn->close();
            }
        }

        /**
         * Comprueba si la instancia ha sido inicializada previamente
         */
        private function compruebaInstanciaInicializada() {
            if (! $this->inicializada ) {
                echo "Aplicacion no inicializa";
                exit();
            }
        }

    }