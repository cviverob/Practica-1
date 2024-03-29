<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada de almacenar los atributos de una película,
     * a la vez que sus operaciones correspondientes
     */
    class Pelicula {

        /**
         * Título de la película
         */
        private $titulo;

        /**
         * Sinópsis de la película
         */
        private $sinopsis;

        /**
         * Ruta del póster de la película
         */
        private $rutaPoster;

        /**
         * Ruta del tráiler de la película
         */
        private $rutaTrailer;

        /**
         * Edad mínima para la visualización de la película
         */
        private $pegi;

        /**
         * Género de la película
         */
        private $genero;

        /**
         * Duración de la película
         */
        private $duracion;

        /**
         * Identificador de la película
         */
        private $id;

        /**
         * Constructor de la película
         * @param string $titulo
         * @param string $sinopsis
         * @param string $rutaPoster
         * @param string $rutaTrailer
         * @param string $pegi
         * @param string $genero
         * @param string $duracion
         */
        private function __construct($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion, $id = null) {
            $this->titulo = $titulo;
            $this->sinopsis = $sinopsis;
            $this->rutaPoster = $rutaPoster;
            $this->rutaTrailer = $rutaTrailer;
            $this->pegi = $pegi;
            $this->genero = $genero;
            $this->duracion = $duracion;
            $this->id = $id;
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
        public static function crear($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion) {
            $pelicula = new Pelicula($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion);
            return self::insertaPelicula($pelicula);
        }

        /**
         * Busca una película y la devuelve si la encuentra, false en caso contrario
         * @param string $id Identificador de la película
         */
        public static function buscar($id) {
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM peliculas WHERE id = '%s'", $conn->real_escape_string($id));
            $rs = $conn->query($query);
            if ($rs) {
                $pelicula = $rs->fetch_assoc();
                if ($pelicula) {
                    $titulo = $pelicula['Titulo'];
                    $sinopsis = $pelicula['Sinopsis'];
                    $rutaPoster = $pelicula['Poster'];
                    $rutaTrailer = $pelicula['Trailer'];
                    $pegi = $pelicula['Pegi'];
                    $genero = $pelicula['Genero'];
                    $duracion = $pelicula['Duracion'];
                    $pelicula = new Pelicula($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion);
                    $rs->free();
                    return $pelicula;
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return null;
        }

        /**
         * Método que elimina una película de la bd
         * @param string $id Identificador de la película
         */
        public static function borrar($id) {
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query = sprintf("DELETE FROM Peliculas WHERE id = '%s'" , $id);
            return $conn->query($query);
        }

        /**
         * Método que actualiza la información en la bd de una película
         * @param string $id Identificador de la película a modificar
         * @param string $titulo
         * @param string $sinopsis
         * @param string $rutaPoster
         * @param string $rutaTrailer
         * @param string $pegi
         * @param string $genero
         * @param string $duracion
         */
        public static function actualizaPelicula($id, $titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion) {
            $pelicula = new Pelicula($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion);
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query = sprintf("UPDATE peliculas SET Titulo = '%s', Genero = '%s', Pegi = '%s', 
                Duracion = '%s', Sinopsis = '%s', Poster = '%s', Trailer = '%s' WHERE id = '%s'",
                $conn->real_escape_string($pelicula->titulo),
                $conn->real_escape_string($pelicula->genero),
                $conn->real_escape_string($pelicula->pegi),
                $conn->real_escape_string($pelicula->duracion),
                $conn->real_escape_string($pelicula->sinopsis),
                $conn->real_escape_string($pelicula->rutaPoster),
                $conn->real_escape_string($pelicula->rutaTrailer),
                $conn->real_escape_string($id)
            );
            if ($conn->query($query)) {
                return $pelicula;
            } 
            else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        /**
         * Método que devuelve una lista de todas las películas
         */
        public static function getPeliculas() {
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query = "SELECT * FROM peliculas";
            $rs = $conn->query($query);
            $listaPeliculas = array();
            if ($rs->num_rows > 0) {
                // Mostrar cada película y su imagen
                while($pelicula = $rs->fetch_assoc()) {
                    $titulo = $pelicula['Titulo'];
                    $sinopsis = $pelicula['Sinopsis'];
                    $rutaPoster = $pelicula['Poster'];
                    $rutaTrailer = $pelicula['Trailer'];
                    $pegi = $pelicula['Pegi'];
                    $genero = $pelicula['Genero'];
                    $duracion = $pelicula['Duracion'];
                    $id = $pelicula['Id'];
                    $listaPeliculas[] = new Pelicula($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion, $id);
                }
            }
            $rs->free();
            return $listaPeliculas;
        }

        /**
         * Método que inserta la película en la bd
         * @param Pelicula $pelicula Película a insertar
         */
        private static function insertaPelicula($pelicula) {
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query=sprintf("INSERT INTO peliculas(Titulo, Genero, Pegi, Duracion, Sinopsis, 
                Poster, Trailer) VALUES ('%s','%s','%s','%s', '%s', '%s', '%s')",
                $conn->real_escape_string($pelicula->titulo),
                $conn->real_escape_string($pelicula->genero),
                $conn->real_escape_string($pelicula->pegi),
                $conn->real_escape_string($pelicula->duracion),
                $conn->real_escape_string($pelicula->sinopsis),
                $conn->real_escape_string($pelicula->rutaPoster),
                $conn->real_escape_string($pelicula->rutaTrailer)
            );
            if ($conn->query($query)) {
                $id = $conn->insert_id;
                $pelicula->setId($id);
                return $pelicula;
            } 
            else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            return false;
        }

        /**
         * Método que devuelve el título de la película
         */
        public function getTitulo() {
            return $this->titulo;
        }

        /**
         * Método que devuelve la sinópsis de la película
         */
        public function getSinopsis() {
            return $this->sinopsis;
        }

        /**
         * Método que devuelve la ruta del póster de la película
         */
        public function getRutaPoster() {
            return $this->rutaPoster;
        }

        /**
         * Método que devuelve la ruta del tráiler de la película
         */
        public function getRutaTrailer() {
            return $this->rutaTrailer;
        }

        /**
         * Método que devuelve la edad mínima de visualización de la película
         */
        public function getPegi() {
            return $this->pegi;
        }

        /**
         * Método que devuelve el género de la película
         */
        public function getGenero() {
            return $this->genero;
        }

        /**
         * Método que devuelve la duración de la película
         */
        public function getDuracion() {
            return $this->duracion;
        }

        /**
         * Método que devuelve el id de la película
         */
        public function getId() {
            return $this->id;
        }

        /**
         * Método que establece el id de la película
         * @param string $id Nuevo identificador de la película
         */
        public function setId($id) {
            $this->id = $id;
        }

    }