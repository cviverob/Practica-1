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

    public static function crea($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion, $aux) {
        $pelicula = new Pelicula($titulo, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion);
        $pelicula->guardarPelicula($aux);
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

    public static function buscaPelicula($titulo) {
        
        $conn = BD::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM peliculas WHERE Nombre='%s'", $conn->real_escape_string($titulo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Pelicula($fila['Nombre'], $fila['Descripcion'], $fila['Imagen'], $fila['Trailer'], $fila['Edad'], $fila['Genero'], $fila['Duracion']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private function guardarPelicula($nombre) {
        if ($this->titulo != null && $nombre != null) {
            return self::actualizaPelicula($nombre, $this);
        }
        else {
            return self::insertaPelicula($this);
        }
    }

    private static function insertaPelicula($pelicula)
    {
        $result = false;
        $conn = BD::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO peliculas(Nombre, Genero, Edad, Duracion, Descripcion, Imagen, Trailer) VALUES ('%s','%s','%s','%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($pelicula->titulo)
            , $conn->real_escape_string($pelicula->genero)
            , $conn->real_escape_string($pelicula->pegi)
            , $conn->real_escape_string($pelicula->duracion)
            , $conn->real_escape_string($pelicula->sinopsis)
            , "img/posters/" . $conn->real_escape_string($pelicula->rutaPoster)
            , $conn->real_escape_string($pelicula->rutaTrailer)
        );
        if ( $conn->query($query) ) {
            $result = $pelicula;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function actualizaPelicula($titulo, $pelicula) {
        $result = false;
        $conn = BD::getInstance()->getConexionBd();
        $query = sprintf("UPDATE peliculas SET nombre = '%s', genero = '%s', edad = '%s', duracion = '%s', descripcion = '%s', imagen = '%s', trailer = '%s' WHERE nombre = '%s'"
            , $conn->real_escape_string($pelicula->titulo)
            , $conn->real_escape_string($pelicula->genero)
            , $conn->real_escape_string($pelicula->pegi)
            , $conn->real_escape_string($pelicula->duracion)
            , $conn->real_escape_string($pelicula->sinopsis)
            ,  "img/posters/" . $conn->real_escape_string($pelicula->rutaPoster)
            , $conn->real_escape_string($pelicula->rutaTrailer)
            , $conn->real_escape_string($titulo)
        );

        if ( $conn->query($query) ) {
            $result = $pelicula;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }
    
    public static function mostrarPeliculas(){
        $conn = BD::getInstance()->getConexionBd();
        $query = "SELECT imagen, nombre FROM peliculas";
        $result = $conn->query($query);
        $link = '';
        if ($result->num_rows > 0) {
            // Mostrar cada película y su imagen
            while($row = $result->fetch_assoc()) {
                $nombre = $row["nombre"];
                $prueba = "<a href = 'vistas/pagina/consultaPelicula.php?n=$nombre' ><img src = '". $row["imagen"] ."' width = '150' height = '200'></a>";
                $link .= $prueba . ' ';
            }
        }
        return $link;
    }

    public static function pintarTablas(){
        $conn = BD::getInstance()->getConexionBd();
        $query = "SELECT nombre FROM peliculas";
        $result = $conn->query($query);
        $link = ' ';
        if ($result->num_rows > 0) {
            // Mostrar titulos y botones
            while($row = $result->fetch_assoc()) {
                $nombre = $row["nombre"];
                $prueba = <<<EOS
                    <tr>
                    <td> $nombre</td>
                    <td><a href='procesarBusquedaPeliculas.php?nombre=$nombre&accion=M'><button>Mod</button></a></td>
                    <td><a href='procesarBusquedaPeliculas.php?nombre=$nombre&accion=B'><button>Bor</button></a></td>
                    </tr>
                EOS;
                $link .= $prueba ;
            }
        }
        return $link;

    }

    public static function borrarPelicula($titulo) {
        $conn = BD::getInstance()->getConexionBd();
        $query=sprintf("DELETE FROM Peliculas WHERE nombre = '%s'" , $titulo);
        $result = $conn->query($query);
        return true;
    }
}
