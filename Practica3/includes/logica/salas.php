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
                    $butacas = json_decode($sala['Butacas']);
                    $sala = new Salas($num_sala, $num_filas, $num_columnas, $butacas, $id);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        public static function modificar($id, $num_sala, $num_filas, $num_columnas, $butacas) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $sala = salas::buscar($id);
            if ($sala) {
                $sala->num_sala = $num_sala;
                $sala->num_filas = $num_filas;
                $sala->num_columnas = $num_columnas;
                $sala->butacas = $butacas;
                $sala->modificarButacas();
                $query = sprintf("UPDATE Salas SET Num_sala = '%d', Num_filas = '%d', 
                    Num_columnas = '%d', Butacas = '%s' WHERE Id = %s",
                    $conn->real_escape_string($sala->num_sala),
                    $conn->real_escape_string($sala->num_filas),
                    $conn->real_escape_string($sala->num_columnas),
                    $conn->real_escape_string(json_encode($sala->butacas)),
                    $conn->real_escape_string($sala->id)
                );
                if ($conn->query($query)) {
                    return $sala;
                } 
                else {
                    error_log("Error BD ({$conn->errno}): {$conn->error}");
                }
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

        public function actualizarButaca($posicion) {
            if (array_key_exists($posicion, $this->butacas)) {
                $this->butacas[$posicion] = !$this->butacas[$posicion];
            }
            else {
                $this->butacas[$posicion] = false;
            }
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
            //con esto creamos la estructura de la sala y luego lo insertamos
            for ($i = 1; $i <= $sala->num_filas; $i++) {
                for ($j = 1; $j <= $sala->num_columnas; $j++) {
                    $butacas[] = array(
                        "fila" => $i,
                        "columna" => $j,
                        "ocupada" => '0'
                    );  
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
                $fila = $butaca->fila;
                $columna = $butaca->columna;
                $butacasIndexadas["$fila,$columna"] = $butaca;
            }
        
            $nuevasButacas = [];
        
            // Recorremos todas las celdas de la sala
            for ($fila = 1; $fila <= $this->num_filas; $fila++) {
                for ($columna = 1; $columna <= $this->num_columnas; $columna++) {
                    $indice = "$fila,$columna";
        
                    // Verificamos si hay una butaca existente en la celda actual
                    if (isset($butacasIndexadas[$indice])) {
                        // Si la butaca existe, copiamos la información de la butaca existente
                        $butaca = $butacasIndexadas[$indice];
                        $nuevasButacas[] = [
                            "fila" => $butaca->fila,
                            "columna" => $butaca->columna,
                            "ocupada" => $butaca->ocupada
                        ];
                    } else {
                        // Si no hay butaca existente, agregamos una nueva butaca con estado '0'
                        $nuevasButacas[] = [
                            "fila" => $fila,
                            "columna" => $columna,
                            "ocupada" => '0'
                        ];
                    }
                }
            }
        
            // Actualizar $this->butacas con el nuevo conjunto de butacas
            $this->butacas = $nuevasButacas;
        }
        
        

        public static function devolverAsiento($sala, $filas, $columnas)  {
            $datos = $sala->butacas;

            // Iterar sobre cada elemento del array
            foreach ($datos as $dato) {
                // Verificar si la fila y la columna coinciden con las deseadas
                if ($dato->fila == $filas && $dato->columna == $columnas) {
                    // Verificar si la butaca está ocupada
                    if ($dato->ocupada == "1") return 1;
                    else return 0;
                }
            }
        }

        private function seleccionarAsiento() {

        }
        
    }
