<?php

class Pelicula {

    /* Atributos del programa */

    private $titulo;

    private $sinopsis;

    private $rutaPoster;

    private $rutaTrailer;

    private $pegi;

    private $genero;

    private $duracion;

    /* Constructor */

    private function __construct($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion) {
        $this->titulo = $titulo;
        $this->sinopsis = $sinopsis;
        $this->rutaPoster = $rutaPoster;
        $this->rutaTrailer = $rutaTrailer;
        $this->pegi = $pegi;
        $this->genero = $genero;
        $this->duracion = $duracion;
    }

    /* Funciones públicas */

    public static function crea($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion) {
        $pelicula = new Pelicula($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion);
        $pelicula->guardarPelicula();
        return $pelicula;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getSinopsis() {
        return $this->sinopsis;
    }

    public function getRutaPoster() {
        return $this->rutaPoster;
    }

    public function getRutaTrailer() {
        return $this->rutaTrailer;
    }

    public function getPegi() {
        return $this->pegi;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    /* Funciones de la BD */

    private static function buscaPelicula($titulo) {
        
    }

    private function guardarPelicula() {

    }

}
