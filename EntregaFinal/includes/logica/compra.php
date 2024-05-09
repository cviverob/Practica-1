<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada de almacenar los atributos de una película,
     * a la vez que sus operaciones correspondientes
     */
    class compra {
      
        private $idCompra;

        private $idUsuario;

        private $idSesion;

        private $tituloPeli;

        private $fecha;

        private $hora;

        private $numEntradas;

        private $butacas;
        
        private $compraPendiente;

        
        /**
         * Constructor de la película
         * @param string $titulo
         * @param string $sinopsis
         * @param string $rutaPoster
         * @param string $rutaTrailer
         * @param string $pegi
         * @param string $genero
         * @param string $duracion
         * @param int $id Identificador de la película con valor por defecto NULL
         */
        private function __construct($idUsuario, $idSesion, $tituloPeli, $fecha, $hora, $numEntradas, $compraPendiente, $butacas = null, $idCompra = null) {
            $this->idUsuario = $idUsuario;
            $this->idSesion = $idSesion;
            $this->tituloPeli = $tituloPeli;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->numEntradas = $numEntradas;
            $this->compraPendiente = $compraPendiente;
            $this->butacas = $butacas;
            $this->idCompra = $idCompra;
        }

        /**
         * Crea una película y la inserta en la base de datos
         * @param string $titulo
         * @param string $sinopsis
         * @param string $rutaPoster
         * @param string $rutaTrailer
         * @param string $pegi
         * @param string $genero
         * @param string $duracion
         */
        public static function crear($idUsuario, $idSesion, $tituloPeli, $fecha, $hora, $numEntradas, $compraPendiente) {
            //buscamos si existe compra pendiente para ese usuario, si existe la devolvemos
            $usuario = self::buscarUsuario($idUsuario, $idSesion);
            //si no existe, creamos una compra para ese usuario y la devolvemos
            if ($usuario == false) {
                $compra = new compra($idUsuario, $idSesion, $tituloPeli, $fecha, $hora, $numEntradas, $compraPendiente);
                return self::insertaCompra($compra);
            }
            return $usuario;
        }

        /**
         * Busca una compra pendiente y la devuelve si la encuentra, false en caso contrario
         * @param string $id Identificador del usuario
         */
        public static function buscarUsuario($idUsuario, $idSesion) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM compras WHERE Id_usuario = '%d' AND Id_sesion = '%d' AND Pendiente = '%d'", 
                $conn->real_escape_string($idUsuario), 
                $conn->real_escape_string($idSesion), 
                '1'
            );
            $rs = $conn->query($query);
            if ($rs) {
                $compra = $rs->fetch_assoc();
                if ($compra) {
                    $idCompra = $compra['Id_compra'];
                    $idUsuario = $compra['Id_usuario'];
                    $idSesion = $compra['Id_sesion'];
                    $tituloPeli = $compra['Titulo_peli'];
                    $fecha = $compra['Fecha'];
                    $hora = $compra['Hora'];
                    $numEntradas = $compra['Num_entradas_compradas'];
                    $butacas = json_decode($compra['Butacas']);
                    $compraPendiente = $compra['Pendiente'];
                    $comprada = new compra($idUsuario, $idSesion, $tituloPeli, $fecha, $hora, $numEntradas, $compraPendiente, $butacas, $idCompra);
                    $rs->free();
                    return $comprada;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        public static function buscarPorIdYUsuario($idCompra, $idUsuario) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM compras WHERE Id_usuario = '%d' AND Id_compra = '%d'", 
                $conn->real_escape_string($idUsuario),
                $conn->real_escape_string($idCompra)
            );
            $rs = $conn->query($query);
            if ($rs) {
                $compra = $rs->fetch_assoc();
                if ($compra) {
                    $idCompra = $compra['Id_compra'];
                    $idUsuario = $compra['Id_usuario'];
                    $idSesion = $compra['Id_sesion'];
                    $tituloPeli = $compra['Titulo_peli'];
                    $fecha = $compra['Fecha'];
                    $hora = $compra['Hora'];
                    $numEntradas = $compra['Num_entradas_compradas'];
                    $butacas = json_decode($compra['Butacas']);
                    $compraPendiente = $compra['Pendiente'];
                    $comprada = new compra($idUsuario, $idSesion, $tituloPeli, $fecha, $hora, $numEntradas, $compraPendiente, $butacas, $idCompra);
                    $rs->free();
                    return $comprada;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        public static function buscar($idUsuario) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM compras WHERE Id_usuario = '%d'", $conn->real_escape_string($idUsuario));

            $rs = $conn->query($query);
            $listaCompras = array();
            if ($rs->num_rows > 0) {
                // Mostrar cada película y su imagen
                while($compra = $rs->fetch_assoc()) {
                    $idCompra = $compra['Id_compra'];
                    $idUsuario = $compra['Id_usuario'];
                    $idSesion = $compra['Id_sesion'];
                    $tituloPeli = $compra['Titulo_peli'];
                    $fecha = $compra['Fecha'];
                    $hora = $compra['Hora'];
                    $numCompradas = $compra['Num_entradas_compradas'];
                    $butacas = json_decode($compra['Butacas'], true);
                    $listaCompras[] = new compra($idUsuario, $idSesion, $tituloPeli, $fecha, $hora, $numCompradas, '0', $butacas, $idCompra);
                }
            }
            $rs->free();
            return $listaCompras;
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

        //eliminamos todas las entradas no compradas
        public static function eliminarButacasCaducadas() {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM compras WHERE TIMESTAMPDIFF(MINUTE, CONCAT(Fecha, ' ', Hora), NOW()) >= 5 AND Pendiente = '1'");
            $rs = $conn->query($query);
            if ($rs->num_rows > 0) {
                while($compra = $rs->fetch_assoc()) {
                    $idCompra = $compra['Id_compra'];
                    $idSesion = $compra['Id_sesion'];
                    $butacas = json_decode($compra['Butacas']);
                    $sesion = sesion::buscar($idSesion);
                
                    //recorremos las butacas y las vamos actualizando
                    foreach ($butacas as $butaca) {
                        $sesion->actualizaButacaSeleccionar($butaca);
                        $query2 = sprintf("DELETE FROM entrada WHERE Id_sesion = '%d' AND Id_butaca = '%s'" , $idSesion, $butaca);
                        $conn->query($query2);
                    }
                    $conn->query(sprintf("DELETE FROM compras WHERE Id_compra='%s' ", $idCompra));
                }
            }
            $rs->free();
            return true;
        }

        /**
         * Método que inserta una compra nueva
         * @param compra
         */
        private static function insertaCompra($compra) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $compra->butacas = array();
            $query=sprintf("INSERT INTO compras(Id_usuario, Id_sesion , Titulo_peli, Fecha, Hora, Num_entradas_compradas, Butacas, Pendiente) 
                            VALUES ('%d','%d','%s','%s','%s','%d','%s','%d')",
                $conn->real_escape_string($compra->idUsuario),
                $conn->real_escape_string($compra->idSesion),
                $conn->real_escape_string($compra->tituloPeli),
                $conn->real_escape_string($compra->fecha),
                $conn->real_escape_string($compra->hora),
                $conn->real_escape_string($compra->numEntradas),
                $conn->real_escape_string(json_encode($compra->butacas)),
                '1'
            );
            if ($conn->query($query)) {
                $id = $conn->insert_id;
                $compra->setIdCompra($id);
                return $compra;
            } 
            else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

    
        public function getIdCompra() {
            return $this->idCompra;
        }

        public function getIdUsuario() {
            return $this->idUsuario;
        }

        public function getIdSesion() {
            return $this->idSesion;
        }

        public function getTituloPeli() {
            return $this->tituloPeli;
        }

        public function getFecha() {
            return $this->fecha;
        }

        public function getHora() {
            return $this->hora;
        }

        public function getNumEntradas() {
            return $this->numEntradas;
        }

        public function getButacas() {
            return $this->butacas;
        }

        public function getPendiente() {
            return $this->compraPendiente;
        }

        /**
         * Método que establece el id de la película
         * @param string $id Nuevo identificador de la película
         */
        public function setIdCompra($id) {
            $this->idCompra = $id;
        }

        public function insertarButaca($idButaca) {
            $conn = aplicacion::getInstance()->getConexionBd();
            //intentamos insertar en la base de datos, si falla es que alguien ha sido mas rapido
            try {
                //intentamos insertar en la base de datos, si falla es que alguien ha sido mas rapido
                $intentamos=sprintf("INSERT INTO entrada (Id_sesion, Id_butaca) VALUES ('%s','%s')",
                $conn->real_escape_string($this->getIdSesion()),
                $conn->real_escape_string($idButaca)
                );
                $conn->query($intentamos);
            } 
            //si ha fallado significa que ya esta seleccionada
            //comprobamos si es nuestra y devolvemos true o si es de otro y devolvemos false
            catch (\mysqli_sql_exception $e) {
                $sos = array();
                foreach ($this->getButacas() as $butaca) {
                    //si la butaca esta en mis butacasCompradas, tengo que quitarlo de la tabla entrada
                    if ($butaca == $idButaca) {
                        $i = true;
                        $conn->query(sprintf("DELETE FROM entrada WHERE Id_sesion = %d AND Id_butaca = '%s'" , $this->getIdSesion(), $idButaca));
                    }
                    else $sos[] = $butaca;
                }

                $conn->query(sprintf("UPDATE compras SET Butacas = '%s', Num_entradas_compradas = %d WHERE Id_compra = %d",
                $conn->real_escape_string(json_encode($sos)),
                $conn->real_escape_string($this->getNumEntradas() - 1),
                $conn->real_escape_string($this->getIdCompra())
                ));

                if ($i != true) return false;
                else return true;
            }

            //nos traemos las butacas y el numero de entradas
            $butacas = $this->getButacas();
            $numEntradas = $this->getNumEntradas();
            $butacas[] = $idButaca;
            //cuando ya es nuestra esa butaca, la insertamos en nuestra base de datos
            $query=sprintf("UPDATE compras SET Butacas = '%s', Num_entradas_compradas = %d WHERE Id_compra = %d",
            $conn->real_escape_string(json_encode($butacas)),
            $conn->real_escape_string($numEntradas + 1),
            $conn->real_escape_string($this->getIdCompra())
            );
            if ($conn->query($query)) {
                return true;
            }   
            else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
            
        }

        public static function procesarCompra($idUsuario, $idSesion) {
            //buscamos la compra del usuario en esa sesion
            $compra = self::buscarUsuario($idUsuario, $idSesion);
            //si hemos encontrado algo, entonces actualizamos si estado de pendiente a finalizado
            if ($compra) {
                $conn = aplicacion::getInstance()->getConexionBd();
                $query=sprintf("UPDATE compras SET Pendiente = '%d' WHERE Id_usuario = '%d' AND Id_sesion = '%d'",
                $conn->real_escape_string('0'),
                $conn->real_escape_string($idUsuario),
                $conn->real_escape_string($idSesion)
                );
                if ($conn->query($query)) {
                    //busco la sesion
                    $sesion = sesion::buscar($idSesion);
                    //vuelco las butacas compradas en un array
                    $butacas = $compra->getButacas();
                    //recorremos las butacas y las vamos actualizando
                    foreach ($butacas as $butaca) {
                        $sesion->actualizaButacaOcupar($butaca);
                    }
                    return $compra;
                }   
                else {
                    error_log("Error BD ({$conn->errno}): {$conn->error}");
                }
                return false;
            }
            return false;
        }

    }

    