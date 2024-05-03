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
         * Hora de inicio la película
         */
        private $horaIni;

        /**
         * Hora de fin la película
         */
        private $horaFin;

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
        private function __construct($idPelicula, $idSala, $fecha, $horaIni, $horaFin, $butacas, $visible, $id = null) {
            $this->idPelicula = $idPelicula;
            $this->idSala = $idSala;
            $this->fecha = $fecha;
            $this->horaIni = $horaIni;
            $this->horaFin = $horaFin;
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
        public static function crear($idPelicula, $idSala, $fecha, $horaIni, $horaFin, $visible = false) {
            $sala = salas::buscar($idSala);
            if ($sala) {
                $sesion = new sesion($idPelicula, $idSala, $fecha, $horaIni, $horaFin, $sala->getButacas(), $visible);
                if (sesion::salaDisponible($sesion)) {
                    return sesion::insertaSesion($sesion);
                }
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
                    $horaIni = $sesion['Hora_ini'];
                    $horaFin = $sesion['Hora_fin'];
                    $butacas = json_decode($sesion['Butacas'], true);
                    $visible = $sesion['Visible'];
                    $sesion = new sesion($idPelicula, $idSala, $fecha, $horaIni, $horaFin, $butacas, $visible, $id);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        /**
         * Método que busca una sesión según su sala y fecha
         * @param int $idSala Identificador de la sesión a buscar
         * @param date $fecha Fecha de la sesión a buscar
         */
        public static function buscarPorSalaYFecha($idSala, $fecha) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM cartelera WHERE Id_sala = '%s' AND Fecha = '%s' ", 
                $conn->real_escape_string($idSala),
                $conn->real_escape_string($fecha)
            );
            $rs = $conn->query($query);
            $listaSesiones = array();
            if ($rs->num_rows > 0) {
                // Mostrar cada película y su imagen
                while($sesion = $rs->fetch_assoc()) {
                    $idPelicula = $sesion['Id_peli'];
                    $idSala = $sesion['Id_sala'];
                    $fecha = $sesion['Fecha'];
                    $horaIni = $sesion['Hora_ini'];
                    $horaFin = $sesion['Hora_fin'];
                    $butacas = json_decode($sesion['Butacas']);
                    $visible = $sesion['Visible'];
                    $id = $sesion['Id'];
                    $listaSesiones[] = new sesion($idPelicula, $idSala, $fecha, $horaIni, $horaFin, $butacas, $visible, $id);
                }
            }
            return $listaSesiones;
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
         * Método que devuelve una lista con todas las sesiones
         */
        public static function getSesiones() {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = "SELECT * FROM cartelera";
            $rs = $conn->query($query);
            $listaSesiones = array();
            if ($rs->num_rows > 0) {
                // Mostrar cada película y su imagen
                while($sesion = $rs->fetch_assoc()) {
                    $idPelicula = $sesion['Id_peli'];
                    $idSala = $sesion['Id_sala'];
                    $fecha = $sesion['Fecha'];
                    $horaIni = $sesion['Hora_ini'];
                    $horaFin = $sesion['Hora_fin'];
                    $butacas = json_decode($sesion['Butacas'], true);
                    $visible = $sesion['Visible'];
                    $id = $sesion['Id'];
                    $listaSesiones[] = new sesion($idPelicula, $idSala, $fecha, $horaIni, $horaFin, $butacas, $visible, $id);
                }
            }
            $rs->free();
            return $listaSesiones;
        }

        /**
         * Método que devuelve el identificador de la sesión
         */
        public function getId () {
            return $this->id;
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
        private static function insertaSesion($sesion) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("INSERT INTO cartelera(Id_peli, Id_sala, Fecha, Hora_ini, Hora_fin, Butacas, Visible) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', %d)",
                $conn->real_escape_string($sesion->idPelicula),
                $conn->real_escape_string($sesion->idSala),
                $conn->real_escape_string($sesion->fecha),
                $conn->real_escape_string($sesion->horaIni),
                $conn->real_escape_string($sesion->horaFin),
                $conn->real_escape_string(json_encode($sesion->butacas)),
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

        /**
         * Método que verifica si la sesión 1 solapa con la sesión 2
         * @param Date $ini1 Hora de inicio de la película a introducir 
         * @param Date $fin1 Hora de fin de la película a introducir
         * @param Date $ini2 Hora de inicio de la película ya existente
         * @param Date $fin2 Hora de fin de la película ya existente
         */
        private static function estanSesionesSolapadas($ini1, $fin1, $ini2, $fin2) {
            //echo $ini1->format("H:i:s") . " " . $fin1->format("H:i:s") . " " . $ini2->format("H:i:s") . " " . $fin2->format("H:i:s");exit();
            return $ini1 <= $ini2 && $fin1 >= $fin2 ||
                $ini1 >= $ini2 && $ini1 <= $fin2 ||
                $fin1 >= $ini2 && $fin1 <= $fin2;
        }

        private static function salaDisponible($sesion) {
            $listaSesiones = sesion::buscarPorSalaYFecha($sesion->idSala, $sesion->fecha);
            foreach ($listaSesiones as $ses) {
                $formato = "H:i:s";
                $ini1 = \DateTime::createFromFormat($formato, $sesion->horaIni);
                $fin1 = \DateTime::createFromFormat($formato, $sesion->horaFin);
                //echo $ses->horaIni . " " . $ses->horaFin;exit();
                $ini2 = \DateTime::createFromFormat($formato, $ses->horaIni);
                $fin2 = \DateTime::createFromFormat($formato, $ses->horaFin);
                if (sesion::estanSesionesSolapadas($ini1, $fin1, $ini2, $fin2)) {
                    return false;
                }
            }
            return true;
        }

    }
