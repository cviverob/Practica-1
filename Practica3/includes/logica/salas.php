<?php
    namespace es\ucm\fdi\aw;

    class Sala {
        
        /* Constantes */


        /* Atributos del programa */

        private $id;
        private $num_filas;
        private $num_columnas;
        private $estructura; //aqui vamos a tener el numero de asientos totales y si cada uno esta libre u ocupado

        /* Constructor */

        private function __construct($id, $num_filas, $num_columnas, $estructura) {
            $this->id = $id;
            $this->num_filas = $num_filas;
            $this->num_columnas = $num_columnas;
            $this->estructura = $estructura;
        }

        /* Funciones públicas */

        public static function crea($id, $num_filas, $num_columnas, $estructura) {
            $sala = new Sala($id, $num_filas, $num_columnas, $estructura);
            $sala->guardarSala();
            return $sala;
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
