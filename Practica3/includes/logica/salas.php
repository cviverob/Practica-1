<?php
    namespace es\ucm\fdi\aw;

    class salas {

        /* Atributos del programa */

        private $id;
        private $num_sala;
        private $num_filas;
        private $num_columnas;
        private $butacas; //aqui vamos a tener el numero de asientos totales y si cada uno esta libre u ocupado

        /* Constructor */

        private function __construct($num_sala, $num_filas, $num_columnas, $butacas = null, $id = null) {
            $this->num_sala = $num_sala;
            $this->num_filas = $num_filas;
            $this->num_columnas = $num_columnas;
            $this->butacas = $butacas;
            $this->id = $id;
        }

        /* Funciones públicas */

        public static function crear($num_sala, $num_filas, $num_columnas) {
            $sala = new Salas($num_sala, $num_filas, $num_columnas);
            return self::insertar($sala);
        }

        public static function buscar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM salas WHERE id = '%s'", $conn->real_escape_string($id));
            $rs = $conn->query($query);
            if ($rs) {
                $sala = $rs->fetch_assoc();
                if ($sala) {
                    $id = $sala['Id'];
                    $num_sala = $sala['Num_sala'];
                    $num_filas = $sala['Num_filas'];
                    $num_columnas = $sala['Num_columnas'];
                    $butacas = json_decode($sala['Butacas'], true);
                    $sala = new Salas($num_sala, $num_filas, $num_columnas, $butacas, $id);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        public function modificar($num_sala, $num_filas, $num_columnas) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $this->num_sala = $num_sala;
            $this->num_filas = $num_filas;
            $this->num_columnas = $num_columnas;
            $this->modificarButacas();
            $query = sprintf("UPDATE Salas SET Num_sala = '%d', Num_filas = '%d', 
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
            return false;
        }

        public static function borrar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("DELETE FROM Salas WHERE id = '%s'" , $id);
            return $conn->query($query);
        }

        public static function getSalas() {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = "SELECT * FROM salas";
            $rs = $conn->query($query);
            $listaSalas = array();
            if ($rs->num_rows > 0) {
                while($sala = $rs->fetch_assoc()) {
                    $id = $sala['Id'];
                    $num_sala = $sala['Num_sala'];
                    $num_filas = $sala['Num_filas'];
                    $num_columnas = $sala['Num_columnas'];
                    $butacas = json_decode($sala['Butacas']);
                    $listaSalas[] = new Salas($num_sala, $num_filas, $num_columnas, $butacas, $id);
                }
            }
            $rs->free();
            return $listaSalas;
        }

        public function actualizarButacaAdmin($id) {
            if (array_key_exists($id, $this->butacas)) {
                $this->butacas[$id]["estado"] = $this->butacas[$id]["estado"] == "nulo" ? "disponible" : "nulo";
                $conn = aplicacion::getInstance()->getConexionBd();
                $query = sprintf("UPDATE Salas SET Butacas = '%s' WHERE Id = %s",
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

        public function getId () {
            return $this->id;
        }

        public function getNumSala () {
            return $this->num_sala;
        }

        public function getNumFilas () {
            return $this->num_filas;
        }

        public function getNumColumnas () {
            return $this->num_columnas;
        }

        public function getButacas () {
            return $this->butacas;
        }

        public function setId($id) {
            $this->id = $id;
        }

        private static function insertar($sala) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $id = 1;
            //con esto creamos la estructura de la sala y luego lo insertamos
            for ($i = 1; $i <= $sala->num_filas; $i++) {
                for ($j = 1; $j <= $sala->num_columnas; $j++) {
                    $butacas[$id] = array(
                        "fila" => $i,
                        "columna" => $j,
                        "estado" => "disponible"
                    );  
                    $id++;
                }
            }
            $sala->butacas = $butacas;
            $query=sprintf("INSERT INTO Salas(Num_sala, Num_filas, Num_columnas, Butacas) VALUES ('%s','%s','%s','%s')",
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
            return false;
        }

        private function modificarButacas() {
            $butacasIndexadas = [];
        
            // Indexar las butacas existentes por fila y columna
            foreach ($this->butacas as $butaca) {
                $fila = $butaca["fila"];
                $columna = $butaca["columna"];
                $butacasIndexadas["$fila,$columna"] = $butaca;
            }
        
            $nuevasButacas = [];
            $id = 1;
        
            // Recorremos todas las celdas de la sala
            for ($fila = 1; $fila <= $this->num_filas; $fila++) {
                for ($columna = 1; $columna <= $this->num_columnas; $columna++) {
                    $indice = "$fila,$columna";
        
                    // Verificamos si hay una butaca existente en la celda actual
                    if (isset($butacasIndexadas[$indice])) {
                        // Si la butaca existe, copiamos la información de la butaca existente
                        $butaca = $butacasIndexadas[$indice];
                        $nuevasButacas[$id] = array(
                            "fila" => $butaca["fila"],
                            "columna" => $butaca["columna"],
                            "estado" => $butaca["estado"]
                        );
                    } 
                    else {
                        // Si no hay butaca existente, agregamos una nueva butaca con estado '0'
                        $nuevasButacas[$id] = array(
                            "fila" => $fila,
                            "columna" => $columna,
                            "estado" => "disponible"
                        );
                    }
                    $id++;
                }
            }
        
            // Actualizar $this->butacas con el nuevo conjunto de butacas
            $this->butacas = $nuevasButacas;
        }
        
        
        // pendiente
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
