<?php
    namespace es\ucm\fdi\aw;

    class Sala {
        
        /* Constantes */


        /* Atributos del programa */

        private $id;
        private $num_sala;
        private $num_filas;
        private $num_columnas;
        private $butacas; //aqui vamos a tener el numero de asientos totales y si cada uno esta libre u ocupado

        /* Constructor */

        private function __construct($id, $num_filas, $num_columnas, $butacas) {
            $this->id = $id;
            $this->num_filas = $num_filas;
            $this->num_columnas = $num_columnas;
            $this->butacas = $butacas;
        }

        /* Funciones públicas */

        public static function crea($id, $num_filas, $num_columnas, $butacas) {
            $sala = new Sala($id, $num_filas, $num_columnas, $butacas);
            $sala->guardarSala();
            return $sala;
        }

        //funcion para buscar sala por su numero de sala
        public static function buscarSalaNum($num) {
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM Salas WHERE Num_sala = '%d'",  $conn->real_escape_string($num));
            $rs = $conn->query($query);
            if ($rs) {
                $sala = $rs->fetch_assoc();
                if ($sala) {
                    $id = $Sala['Id'];
                    $num_sala = $Sala['Num_sala'];
                    $num_filas = $Sala['Num_filas'];
                    $num_columnas = $Sala['Num_columnas'];
                    $butacas = $Sala['Butacas'];
                    $sala = new Sala($id, $num_sala, $num_filas, $num_columnas, $butacas);
                    $rs->free();
                    return $sala;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        public static function getNumSala () {
            return $this->num_sala;
        }

        public static function getNumFilas () {
            return $this->num_filas;
        }

        public static function getNumColumnas () {
            return $this->num_columnas;
        }

        /* Funciones privadas */


        /* Funciones de la BD */

        private function guardarSala($sala) {
            
        }

        private function comprobarAsiento($sala) {
            
        }

        private function seleccionarAsiento() {

        }


        
    }
