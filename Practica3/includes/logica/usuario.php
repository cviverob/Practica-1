<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase Usuario que contiene la información básica del mismo
     */
    class usuario {

        /**
         * Constantes que definen los roles de los usuarios
         */
        private const ROL_USUARIO = 0;
        private const ROL_ADMIN = 1;

        /**
         * Alias del usuario
         */
        private $correo;

        /**
         * Nombre real del usuario
         */
        private $nombre;

        /**
         * Contraseña del usuario
         */
        private $contraseña;

        /**
         * Edad del usuario
         */
        private $edad;

        /**
         * Id del usuario
         */
        private $id;

        /**
         * Rol del usuario, admin o normal
         */
        private $rol;

        private function __construct($correo, $nombre, $contraseña, $edad, $id = null, $rol = self::ROL_USUARIO) {
            $this->correo = $correo;
            $this->nombre = $nombre;
            $this->contraseña = $contraseña;
            $this->edad = $edad;
            $this->rol = $rol;
            $this->id = $id;
        }

        /**
         * Busca el usuario $nombreUsuario en la bd y, si lo encuentra, comprueba
         * si la contraseña es correcta y de serlo lo devuelve
         */
        public static function login($correo, $contraseña) {
            $usuario = self::buscaUsuario($correo);
            if ($usuario && $usuario->compruebaContraseña($contraseña)) {
                return $usuario;
            } 
            return false;
        }

        /**
         * Función que comprueba si un usuario ya existe en la bd o no,
         * y de no hacerlo, lo crea y lo inserta
         */
        public static function registrar($correo, $nombre, $contraseña, $edad) {
            if (!self::buscaUsuario($correo)) {
                $contraseña = self::hashContraseña($contraseña);
                $usuario = new Usuario($correo, $nombre, $contraseña, $edad);
                return self::insertaUsuario($usuario);
            }
            else {
                return false;
            }
        }
        
        /**
         * Devuelve una instancia del usuario que ha encontrado en la bd
         * con el parámetro $nombreUsuario, o false si no lo encuentra
         */
        private static function buscaUsuario($correo) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM usuario WHERE email='%s'", $conn->real_escape_string($correo));
            $rs = $conn->query($query);     // Realizamos la búsqueda
            if ($rs) {
                if ($rs->num_rows == 1) {
                    $usuario = $rs->fetch_assoc();     // Guardamos la fila encontrada
                    $correo = $usuario['email'];
                    $nombre = $usuario['nombre'];
                    $contraseña = $usuario['contraseña'];
                    $edad = $usuario['edad'];
                    $id = $usuario['id'];
                    $rol = $usuario['rol'];
                    $usuario = new Usuario($correo, $nombre, $contraseña, $edad, $id, $rol);
                    $rs->free();
                    return $usuario;
                }
            }
            else {      // Error al hacer la consulta
                echo "Error SQL ({$conn->errno}):  {$conn->error}";
            }
            return false;
        }

        /**
         * Función que inserta un usuario en la bd
         */
        private static function insertaUsuario($usuario) {
<<<<<<< HEAD
            $conn = aplicacion::getInstance()->getConexionBd();
            $query=sprintf("INSERT INTO usuario(nombre, email, contraseña, edad, rol) VALUES ('%s', '%s', '%s', '%s', '%s')"
=======
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query=sprintf("INSERT INTO usuario(nombre, email, contraseña, edad, rol) VALUES ('%s', '%s', '%s', '%d', '%s')"
>>>>>>> 4224159e4408296b540749ef924fedbecd6dd9dd
                , $conn->real_escape_string($usuario->nombre)
                , $conn->real_escape_string($usuario->correo)
                , $conn->real_escape_string($usuario->contraseña)
                , $conn->real_escape_string($usuario->edad)
                , $conn->real_escape_string($usuario->rol)
            );
            if ($conn->query($query)) {
                $id = $conn->insert_id;
                $usuario->setId($id);
                return $usuario;
            }
            else {      // Error al hacer la inserción
                echo "Error SQL ({$conn->errno}):  {$conn->error}";
            }
            return false;
        }

        /**
         * Comprueba si la contraseña pasada por parámetro coincide con la del usuario
         */
        private function compruebaContraseña($contraseña) {
            return password_verify($contraseña, $this->contraseña);
        }

        /**
         * Hashea la contraseña pasada por parámetro
         */
        private static function hashContraseña($contraseña) {
            return password_hash($contraseña, PASSWORD_DEFAULT);
        }

        // Getters y setters

        public function getNombreUsuario() {
            return $this->nombreUsuario;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function esAdmin() {
            return $this->rol == self::ROL_ADMIN;
        }

        public function setId($id) {
            $this->id = $id;
        }

    }