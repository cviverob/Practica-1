<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada de las compras
     */
    class compra {
      
        /**
         * Identificador de la compra
         */
        private $id;

        /**
         * Identificador del usuario
         */
        private $idUsuario;

        /**
         * Identificador de la sesión
         */
        private $idSesion;

        /**
         * Identificador de la película
         */
        private $idPeli;

        /**
         * Butacas seleccionadas en la compra
         */
        private $butacas;
        
        /**
         * Booleano que indica si la compra está en estado pendiente o finalizada
         */
        private $compraPendiente;

        
        /**
         * Constructor de la compra
         * @param int $idUsuario
         * @param int $idSesion
         * @param int $idPeli
         * @param string[] $butacas
         * @param bool $compraPendiente
         * @param int $id Identificador de la película con valor por defecto NULL
         */
        private function __construct($idUsuario, $idSesion, $idPeli, $compraPendiente, $butacas = [], $id = null) {
            $this->id = $id;
            $this->idUsuario = $idUsuario;
            $this->idSesion = $idSesion;
            $this->idPeli = $idPeli;
            $this->compraPendiente = $compraPendiente;
            $this->butacas = $butacas;
        }

        /**
         * Crea una compra y la inserta en la base de datos
         * @param int $idUsuario
         * @param int $idSesion
         * @param int $idPeli
         * @param bool $compraPendiente
         */
        public static function crear($idUsuario, $idSesion, $idPeli, $compraPendiente) {
            // Buscamos si existe compra pendiente para ese usuario, si existe la devolvemos
            $compra = self::buscarCompraDeUsuario($idUsuario, $idSesion);
            if (!$compra) {
                $compra = new compra($idUsuario, $idSesion, $idPeli, $compraPendiente);
                $compra = self::insertaCompra($compra);
            }
            return $compra;
        }

        /**
         * Busca una compra pendiente y la devuelve si la encuentra, false en caso contrario
         * @param string $idUsuario Identificador del usuario
         * @param string $idSesion Identificador de la sesión
         */
        public static function buscarCompraDeUsuario($idUsuario, $idSesion) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM compras WHERE Id_usuario = '%d' AND 
                Id_sesion = '%d' AND Pendiente = '%d'", 
                $conn->real_escape_string($idUsuario), 
                $conn->real_escape_string($idSesion), 
                '1'
            );
            $rs = $conn->query($query);
            if ($rs) {
                $compra = $rs->fetch_assoc();
                if ($compra) {
                    $id = $compra['Id_compra'];
                    $idUsuario = $compra['Id_usuario'];
                    $idSesion = $compra['Id_sesion'];
                    $idPeli = $compra['Id_peli'];
                    $compraPendiente = $compra['Pendiente'];
                    $butacas = json_decode($compra['Butacas']);
                    $compra = new compra($idUsuario, $idSesion, $idPeli, $compraPendiente, $butacas, $id);
                    $rs->free();
                    return $compra;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        /**
         * Método que busca una compra por su id
         * @param int $id Identificador de la compra
         */
        public static function buscar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM compras WHERE Id_compra = '%d'", 
                $conn->real_escape_string($id)
            );
            $rs = $conn->query($query);
            if ($rs) {
                $compra = $rs->fetch_assoc();
                if ($compra) {
                    $id = $compra['Id_compra'];
                    $idUsuario = $compra['Id_usuario'];
                    $idSesion = $compra['Id_sesion'];
                    $idPeli = $compra['Id_peli'];
                    $compraPendiente = $compra['Pendiente'];
                    $butacas = json_decode($compra['Butacas']);
                    $compra = new compra($idUsuario, $idSesion, $idPeli, $compraPendiente, $butacas, $id);
                    $rs->free();
                    return $compra;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        /**
         * Método que desocupa una butaca en la BD
         * @param int $idButaca Identificador de la butaca
         * @param int $idSesion Identificador de la sesión
         */
        public function desocuparButaca($idButaca, $idSesion) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("DELETE FROM entrada WHERE Id_sesion = '%d' AND Id_butaca = '%s'", 
                $idSesion, $idButaca);
            $conn->query($query);
            $key = array_search($idButaca, $this->butacas);
            unset($this->butacas[$key]);
            $query = sprintf("UPDATE compras SET Butacas = '%s' WHERE Id_compra = '%d'",
                $conn->real_escape_string(json_encode($this->butacas)),
                $conn->real_escape_string($this->id)
            );
            $conn->query($query);
        }

        /**
         * Método que elimina una película de la bd
         * @param string $id Identificador de la película
         */
        private static function borrar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("DELETE FROM compras WHERE Id_usuario = '%s' AND Pendiente = '%s'" , $id, '1');
            return $conn->query($query);
        }

        /**
         * Método que elimina las butacas caducadas, es decir, aquellas que fueron
         * seleccionadas hace más de n minutos
         */
        public static function eliminarButacasCaducadas() {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM compras WHERE TIMESTAMPDIFF(MINUTE, 
                Hora, NOW()) >= 1 AND Pendiente = '1'"
            );
            $rs = $conn->query($query);
            if ($rs->num_rows > 0) {
                while($compra = $rs->fetch_assoc()) {
                    $id = $compra['Id_compra'];
                    $idSesion = $compra['Id_sesion'];
                    $butacas = json_decode($compra['Butacas']);
                    $sesion = sesion::buscar($idSesion);
                    // Recorremos las butacas y las vamos eliminando
                    foreach ($butacas as $butaca) {
                        $sesion->actualizaButacaSeleccionar($butaca);
                        $query = sprintf("DELETE FROM entrada WHERE Id_sesion = '%d' AND 
                            Id_butaca = '%s'" , 
                            $idSesion, 
                            $butaca
                        );
                        $conn->query($query);
                    }
                    $conn->query(sprintf("DELETE FROM compras WHERE Id_compra = '%s'", $id));
                }
            }
            $rs->free();
            return true;
        }

        /**
         * Método que inserta una compra nueva
         * @param compra $compra
         */
        private static function insertaCompra($compra) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $compra->butacas = array();
            $query=sprintf("INSERT INTO compras(Id_usuario, Id_sesion , Id_peli, Butacas, Pendiente) 
                VALUES ('%d','%d','%d','%s','%d')",
                $conn->real_escape_string($compra->idUsuario),
                $conn->real_escape_string($compra->idSesion),
                $conn->real_escape_string($compra->idPeli),
                $conn->real_escape_string(json_encode($compra->butacas)),
                1
            );
            if ($conn->query($query)) {
                $id = $conn->insert_id;
                $compra->setId($id);
                return $compra;
            } 
            else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        /**
         * Método que devuelve el identificador de la compra
         */
        public function getId() {
            return $this->id;
        }

        /**
         * Método que devuelve el identificador del usuario
         */
        public function getIdUsuario() {
            return $this->idUsuario;
        }

        /**
         * Método que devuelve el identificador de la sesión
         */
        public function getIdSesion() {
            return $this->idSesion;
        }

        /**
         * Método que devuelve el identificador de la  película
         */
        public function getIdPeli() {
            return $this->idPeli;
        }

        /**
         * Método que devuelve las butacas de la compra
         */
        public function getButacas() {
            return $this->butacas;
        }

        /**
         * Método que devuelve si la compra está pendiente o no
         */
        public function isCompraPendiente() {
            return $this->compraPendiente;
        }

        /**
         * Método que establece el id de la compra
         * @param string $id Nuevo identificador de la compra
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * Método que inserta una butaca en la compra
         * @param string $idButaca Identificador de la butaca
         */
        public function insertarButaca($idButaca) {
            $conn = aplicacion::getInstance()->getConexionBd();
            // Intentamos insertar en la base de datos, si falla es que alguien ha sido mas rápido
            try {
                $query = sprintf("INSERT INTO entrada (Id_sesion, Id_butaca) VALUES ('%s','%s')",
                    $conn->real_escape_string($this->getIdSesion()),
                    $conn->real_escape_string($idButaca)
                );
                if ($conn->query($query)) {
                    $this->butacas[] = $idButaca;
                }
            } 
            catch (\mysqli_sql_exception $e) {
                $query = sprintf("DELETE FROM entrada WHERE Id_sesion = %d AND Id_butaca = '%s'", 
                    $this->idSesion, 
                    $idButaca
                );
                $key = array_search($idButaca, $this->butacas);
                unset($this->butacas[$key]);
                $query = sprintf("UPDATE compras SET Butacas = '%s' WHERE Id_compra = '%d'",
                    $conn->real_escape_string(json_encode($this->butacas)),
                    $conn->real_escape_string($this->id)
                );
                $conn->query($query);
                return false;
            }
            // Insertamos la butaca seleccionada en la compra
            $query=sprintf("UPDATE compras SET Butacas = '%s' WHERE Id_compra = %d",
                $conn->real_escape_string(json_encode($this->butacas)),
                $conn->real_escape_string($this->id)
            );
            if ($conn->query($query)) {
                return true;
            }   
            else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        /**
         * Método que compruba si una butaca está seleccionada por ti o no
         * @param string $idButaca Identificador de la butaca
         */
        public function estaOcupadaPorMi($idButaca) {
            return in_array($idButaca, $this->butacas);
        }

        /**
         * Método que procesa una compra
         * @param int $idUsuario
         * @param int $idSesion
         */
        public static function procesarCompra($idUsuario, $idSesion) {
            $compra = self::buscarCompraDeUsuario($idUsuario, $idSesion);
            if ($compra) {
                $conn = aplicacion::getInstance()->getConexionBd();
                $query = sprintf("UPDATE compras SET Pendiente = '%d' WHERE Id_usuario = '%d' 
                    AND Id_sesion = '%d'",
                    $conn->real_escape_string(0),
                    $conn->real_escape_string($idUsuario),
                    $conn->real_escape_string($idSesion)
                );
                $compra->compraPendiente = 0;
                if ($conn->query($query)) {
                    $sesion = sesion::buscar($idSesion);
                    foreach ($compra->butacas as $butaca) {
                        $sesion->actualizaButacaOcupar($butaca);
                    }
                    return $compra;
                }   
                else {
                    error_log("Error BD ({$conn->errno}): {$conn->error}");
                }
            }
            return false;
        }

    }

    