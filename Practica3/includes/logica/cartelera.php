<?php
    namespace es\ucm\fdi\aw;

    class Cartelera {
        
        /* Constantes */


        /* Atributos del programa */

        private $pelicula;
        private $fecha;
        private $hora;
        private $sala;
        private $visible;

        /* Constructor */

        private function __construct($pelicula, $fecha, $hora, $sala, $visible) {
            $this->pelicula = $pelicula;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->sala = $sala;
            $this->visible = $visible;
        }

        /* Funciones públicas */

        public static function crea($pelicula, $fecha, $hora, $sala, $visible) {
            $cartelera = new Cartelera($pelicula, $fecha, $hora, $sala, $visible);
            $cartelera->guardarCartelera();
            return $cartelera;
        }

        /* Funciones privadas */


        /* Funciones de la BD */

        private function guardarCartelera($cartelera) {
            
        }

    }
