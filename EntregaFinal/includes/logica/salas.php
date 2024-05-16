<?php
    namespace es\ucm\fdi\aw;

    class salas {

        /**
         * Id de la sala
         */
        private $id;

        /**
         * Número de la sala
         */
        private $num_sala;
        
        /**
         * Número de filas de la sala
         */
        private $num_filas;

        /**
         * Número de columnas de la sala
         */
        private $num_columnas;

        /**
         * Butacas de la sala, con información sobre su posición y estado
         */
        private $butacas;

        /**
         * Constructor de la sala
         * @param int $num_sala
         * @param int $num_filas
         * @param int $num_columnas
         * @param array $butacas Butacas de la sala, con valor por defecto NULL
         * @param int $id Identificador de la sala, con valor por defecto NULL
         */
        private function __construct($num_sala, $num_filas, $num_columnas, $butacas = null, $id = null) {
            $this->num_sala = $num_sala;
            $this->num_filas = $num_filas;
            $this->num_columnas = $num_columnas;
            $this->butacas = $butacas;
            $this->id = $id;
        }

        /**
         * Método que instancia una película
         * @param int $num_sala
         * @param int $num_filas
         * @param int $num_columnas
         */
        public static function crear($num_sala, $num_filas, $num_columnas) {
            if (!self::buscarPorNumero($num_sala)) {
                $sala = new salas($num_sala, $num_filas, $num_columnas);
                return self::insertar($sala);
            }
            return false;
        }

        /**
         * Método que busca una sala según su id y que no este archivado
         * @param int $id Identificador de la sala a buscar
         */
        public static function buscarNoArchivado($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM salas WHERE Id = '%d' AND archivado = %d", $conn->real_escape_string($id), false);
            $rs = $conn->query($query);
            if ($rs) {
                $sala = $rs->fetch_assoc();
                if ($sala) {
                    $id = $sala['Id'];
                    $num_sala = $sala['Num_sala'];
                    $num_filas = $sala['Num_filas'];
                    $num_columnas = $sala['Num_columnas'];
                    $butacas = json_decode($sala['Butacas'], true);
                    $sala = new salas($num_sala, $num_filas, $num_columnas, $butacas, $id);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        /**
         * Método que busca una sala según su id
         * @param int $id Identificador de la sala a buscar
         */
        public static function buscar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM salas WHERE Id = '%d'", $conn->real_escape_string($id));
            $rs = $conn->query($query);
            if ($rs) {
                $sala = $rs->fetch_assoc();
                if ($sala) {
                    $id = $sala['Id'];
                    $num_sala = $sala['Num_sala'];
                    $num_filas = $sala['Num_filas'];
                    $num_columnas = $sala['Num_columnas'];
                    $butacas = json_decode($sala['Butacas'], true);
                    $sala = new salas($num_sala, $num_filas, $num_columnas, $butacas, $id);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        /**
         * Método que busca una sala según su número
         * @param int $numero Número de la sala a buscar
         */
        public static function buscarPorNumero($numero) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM salas WHERE Num_sala = '%d'", $conn->real_escape_string($numero));
            $rs = $conn->query($query);
            if ($rs) {
                $sala = $rs->fetch_assoc();
                if ($sala) {
                    $id = $sala['Id'];
                    $num_sala = $sala['Num_sala'];
                    $num_filas = $sala['Num_filas'];
                    $num_columnas = $sala['Num_columnas'];
                    $butacas = json_decode($sala['Butacas'], true);
                    $sala = new salas($num_sala, $num_filas, $num_columnas, $butacas, $id);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        /**
         * Método que modifica la sala adaptando el tamaño anterior al nuevo
         * @param int $num_sala
         * @param int $num_filas
         * @param int $num_columnas
         */
        public function modificar($num_sala, $num_filas, $num_columnas) {
            if ($this->num_sala != $num_sala && !self::buscarPorNumero($sala->num_sala)) {
                $conn = aplicacion::getInstance()->getConexionBd();
                $this->num_sala = $num_sala;
                $this->num_filas = $num_filas;
                $this->num_columnas = $num_columnas;
                $this->modificarButacas();
                $query = sprintf("UPDATE salas SET Num_sala = '%d', Num_filas = '%d', 
                    Num_columnas = '%d', Butacas = '%s' WHERE Id = %s",
                    $conn->real_escape_string($this->num_sala),
                    $conn->real_escape_string($this->num_filas),
                    $conn->real_escape_string($this->num_columnas),
                    $conn->real_escape_string(json_encode($this->butacas)),
                    $conn->real_escape_string($this->id)
                );
                if ($conn->query($query)) {
                    return $this;
                } 
                else {
                    error_log("Error BD ({$conn->errno}): {$conn->error}");
                }
            }
            return false;
        }

        /**
         * Método que borra una sala por su id
         * @param int $id Identificador de la película a borrar
         */
        public static function borrar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("UPDATE salas SET archivado = %d WHERE id = '%s'" , true, $id);
            return $conn->query($query);
        }

        /**
         * Método accesible por el administrador que actualiza el estado de una butaca
         * desde la pestaña de modificar una sala
         * @param int $id Identificador de la butaca a modificar
         */
        public function actualizarButacaAdmin($id) {
            if (array_key_exists($id, $this->butacas)) {
                $this->butacas[$id]["estado"] = $this->butacas[$id]["estado"] == "nulo" ? "disponible" : "nulo";
                $conn = aplicacion::getInstance()->getConexionBd();
                $query = sprintf("UPDATE salas SET Butacas = '%s' WHERE Id = %s",
                    $conn->real_escape_string(json_encode($this->butacas)),
                    $conn->real_escape_string($this->id)
                );
                if ($conn->query($query)) {
                    return true;
                } 
                else {
                    error_log("Error BD ({$conn->errno}): {$conn->error}");
                }
            }
            else {
                echo "Error al actualizar la butaca con id " . $id;
            }
            return false;
        }

        /**
         * Método accesible por el usuario para seleccionar una butaca a la
         * hora de comprar entradas
         * @param int $id Identificador de la butaca a seleccionar
         * @param sesion $sesion Sesion cuya butaca va a ser modificada
         */
        public function actualizaButacaUsuario($id, $sesion, $ocupar = false) {
            if (array_key_exists($id, $this->butacas)) {
                $butacas = $sesion->getButacas();
                if (!$ocupar) {
                    $butacas[$id]["estado"] = $this->butacas[$id]["estado"] == "seleccionada" ? "disponible" : "seleccionada";
                }
                else {
                    $butacas[$id]["estado"] = $this->butacas[$id]["estado"] == "seleccionada" ? "ocupada" : "disponible";
                }
                $conn = aplicacion::getInstance()->getConexionBd();
                $query = sprintf("UPDATE cartelera SET Butacas = '%s' WHERE Id = %s",
                    $conn->real_escape_string(json_encode($butacas)),
                    $conn->real_escape_string($sesion->getId())
                );
                if ($conn->query($query)) {
                    return true;
                } 
                else {
                    error_log("Error BD ({$conn->errno}): {$conn->error}");
                }
            }
            else {
                echo "Error al actualizar la butaca con id " . $id;
            }
            return false;
        }

        /**
         * Método que devuelve el identificador de la sala
         */
        public function getId () {
            return $this->id;
        }

        /**
         * Método que devuelve el número de la sala
         */
        public function getNumSala () {
            return $this->num_sala;
        }

        /**
         * Método que devuelve el número de filas de la sala
         */
        public function getNumFilas () {
            return $this->num_filas;
        }

        /**
         * Método que devuelve el número de columnas de la sala
         */
        public function getNumColumnas () {
            return $this->num_columnas;
        }

        /**
         * Método que devuelve las butacas de la sala
         */
        public function getButacas () {
            return $this->butacas;
        }

        /**
         * Método que establece el identificador de la sala
         * @param int $id Identificador a establecer
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * Método que inserta la sala pasada por parámetro
         * @param Sala $sala Sala a insertar
         */
        private static function insertar($sala) {
            $conn = aplicacion::getInstance()->getConexionBd();
            for ($i = 1; $i <= $sala->num_filas; $i++) {
                for ($j = 1; $j <= $sala->num_columnas; $j++) {
                    $id = "$i-$j";
                    $butacas[$id] = array(
                        "estado" => "disponible"
                    );  
                }
            }
            $sala->butacas = $butacas;
            $query=sprintf("INSERT INTO salas(Num_sala, Num_filas, Num_columnas, Butacas) VALUES ('%s','%s','%s','%s')",
                $conn->real_escape_string($sala->num_sala),
                $conn->real_escape_string($sala->num_filas),
                $conn->real_escape_string($sala->num_columnas),
                $conn->real_escape_string(json_encode($sala->butacas))
            );
            if ($conn->query($query)) {
                $id = $conn->insert_id;
                $sala->setId($id);
                return $sala;
            } 
            else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
        }
        return false;
        }

        /**
         * Método que modifica las butacas de la sala, corrigiendo
         * las que han quedado fuera de rango o insertando nuevas
         * si la sala se ha impleado
         */
        private function modificarButacas() {
            $butacasIndexadas = [];
        
            /* Indexar las butacas existentes por fila y columna */
            foreach ($this->butacas as $butaca) {
                $fila = $butaca["fila"];
                $columna = $butaca["columna"];
                $butacasIndexadas["$fila-$columna"] = $butaca;
            }
            $nuevasButacas = [];
            /* Recorremos todas las celdas de la sala */
            for ($fila = 1; $fila <= $this->num_filas; $fila++) {
                for ($columna = 1; $columna <= $this->num_columnas; $columna++) {
                    $id = "$fila-$columna";
                    /* Verificamos si hay una butaca existente en la celda actual */
                    if (isset($butacasIndexadas[$id])) {
                        /* Si la butaca existe, copiamos la información de la butaca existente */
                        $butaca = $butacasIndexadas[$id];
                        $nuevasButacas[$id] = array(
                            "fila" => $butaca["fila"],
                            "columna" => $butaca["columna"],
                            "estado" => $butaca["estado"]
                        );
                    } 
                    else {
                        /* Si no hay butaca existente, agregamos una nueva butaca con estado '0' */
                        $nuevasButacas[$id] = array(
                            "fila" => $fila,
                            "columna" => $columna,
                            "estado" => "disponible"
                        );
                    }
                }
            }
            /* Actualizar $this->butacas con el nuevo conjunto de butacas */
            $this->butacas = $nuevasButacas;
        }
        
        public static function getSalas() {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM salas WHERE archivado = %d ORDER BY Num_sala", false);
            $rs = $conn->query($query);
            $listaSalas = array();
            if ($rs->num_rows > 0) {
                // Mostrar cada película y su imagen
                while($sala = $rs->fetch_assoc()) {
                    $id = $sala['Id'];
                    $num_sala = $sala['Num_sala'];
                    $num_filas = $sala['Num_filas'];
                    $num_columnas = $sala['Num_columnas'];
                    $butacas = json_decode($sala['Butacas'], true);
                    $listaSalas[] = new salas($num_sala, $num_filas, $num_columnas, $butacas, $id);
                }
            }
            $rs->free();
            return $listaSalas;
        }
        
        /**
         * Método que devuelve el estado del asiento
         * @param int $id Identificador del asiento cuyo estado se va a devolver
         */
        public function devolverAsiento($id) {
            if (array_key_exists($id, $this->butacas)) {
                return $this->butacas[$id]["estado"];
            }
            else {
                echo "Error al devolver el asiento con id " . $id;
                exit();
            }
        }
        
    }
