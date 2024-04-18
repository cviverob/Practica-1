<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase que contiene toda la información sobre la sesión de una película
     */
    class sesion {
        
        /**
         * Identificador de la sesión
         */
        private $id;

        /**
         * Identificador de la película
         */
        private $idPelicula;

        /**
         * Identificador de la sala
         */
        private $idSala;

        /**
         * Fecha de la película
         */
        private $fecha;

        /**
         * Hora de la película
         */
        private $hora;

        /**
         * Estado actual de las butacas de la sala
         */
        private $butacas;

        /**
         * Booleano que indica si la sesión es visible para el usuario o no
         */
        private $visible;

        /**
         * Constructor de la sesion
         * @param string $idPelicula
         * @param string idSala
         * @param date $fecha
         * @param time $hora
         * @param array $butacas
         * @param bool $visible
         * @param string $id Identificador de la seión, valor por defecto null
         */
        private function __construct($idPelicula, $idSala, $fecha, $hora, $butacas, $visible, $id = null) {
            $this->idPelicula = $idPelicula;
            $this->idSala = $idSala;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->butacas = $butacas;
            $this->visible = $visible;
            $this->id = $id;
        }
        
        /**
         * Método que crea una sesión, insertándola y devolviéndola
         * @param string $idPelicula
         * @param string idSala
         * @param date $fecha
         * @param time $hora
         * @param bool $visible valor por defecto false
         */
        public static function crear($idPelicula, $idSala, $fecha, $hora, $visible = false) {
            $sala = salas::buscar($idSala);
            if ($sala) {
                $sesion = new sesion($idPelicula, $idSala, $fecha, $hora, $sala->getButacas(), $visible);
                return sesion::insertaUsuario($sesion);
            }
            return false;
        }

        /**
         * Método que busca una sesión según su id
         * @param int $id Identificador de la sesión a buscar
         */
        public static function buscar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM cartelera WHERE id = '%s'", $conn->real_escape_string($id));
            $rs = $conn->query($query);
            if ($rs) {
                $sesion = $rs->fetch_assoc();
                if ($sala) {
                    $id = $sesion['Id'];
                    $idPelicula = $sesion['Id_peli'];
                    $idSala = $sesion['Id_sala'];
                    $fecha = $sesion['Fecha'];
                    $hora = $sesion['Hora'];
                    $butacas = json_decode($sesion['Butacas'], true);
                    $visible = $sesion['Visible'];
                    $sesion = new sesion($idPelicula, $idSala, $fecha, $hora, $butacas, $visible, $id);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }
        
        /**
         * Método que borra una sesión por su id
         * @param int $id Identificador de la sesión a borrar
         */
        public static function borrar($id) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("DELETE FROM cartelera WHERE id = '%s'" , $id);
            return $conn->query($query);
        }

        /**
         * Método accesible por el usuario para seleccionar una butaca a la
         * hora de comprar entradas
         * @param int $id Identificador de la butaca a seleccionar
         */
        public function actualizaButacaSeleccionar($id) {
            if (array_key_exists($id, $this->butacas)) {
                $this->butacas[$id]["estado"] = $this->butacas[$id]["estado"] == "seleccionada" ? "disponible" : "seleccionada";
                $conn = aplicacion::getInstance()->getConexionBd();
                $query = sprintf("UPDATE cartelera SET Butacas = '%s' WHERE Id = %s",
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
         * Método que cambia el estado de una butaca de "seleccionada" a "ocupada"
         * @param int $id Identificador de la butaca a ocupar
         */
        public function actualizaButacaOcupar($id) {
            if (array_key_exists($id, $this->butacas)) {
                if ($this->butacas[$id]["estado"] == "seleccionada") {
                    $this->butacas[$id]["estado"] = "ocupada";
                    $this->butacas[$id]["estado"] = $this->butacas[$id]["estado"] == "seleccionada" ? "disponible" : "seleccionada";
                    $conn = aplicacion::getInstance()->getConexionBd();
                    $query = sprintf("UPDATE cartelera SET Butacas = '%s' WHERE Id = %s",
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
            }
            else {
                echo "Error al actualizar la butaca con id " . $id;
            }
            return false;
        }
        
        /**
         * Método que establece el identificador de la sesión
         * @param int $id Identificador a establecer
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * Método que inserta una sesión en la bd
         * @param sesion $sesion Sesion a insertar
         */
        private static function insertaUsuario($sesion) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query=sprintf("INSERT INTO cartelera(Id_peli, Id_sala, Fecha, Hora, Butacas, Visible) VALUES ('%s', '%s', '%s', '%s', '%s', %s)",
                $conn->real_escape_string($sesion->idPelicula),
                $conn->real_escape_string($sesion->idSala),
                $conn->real_escape_string($sesion->fecha),
                $conn->real_escape_string($sesion->hora),
                $conn->real_escape_string($sesion->butacas),
                $conn->real_escape_string($sesion->visible)
            );
            if ($conn->query($query)) {
                $id = $conn->insert_id;
                $sesion->setId($id);
                return $sesion;
            }
            else {
                echo "Error SQL ({$conn->errno}):  {$conn->error}";
            }
            return false;
        }

    }
