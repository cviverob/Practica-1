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

        /**
         * Constructor del usuario
         * @param string $correo
         * @param string $nombre
         * @param string $contraseña
         * @param int $edad
         * @param int $id Id del usuario con valor por defecto NULL
         * @param int $rol Rol del usuario con valor por defecto ROL_USUARIO
         */
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
         * @param string $correo
         * @param string $contraseña
         */
        public static function login($correo, $contraseña) {
            $usuario = self::buscaUsuario($correo);
            if ($usuario && $usuario->compruebaContraseña($contraseña)) {
                return $usuario;
            } 
            return false;
        }

        /**
         * Método que comprueba si un usuario ya existe en la bd o no,
         * y de no hacerlo, lo crea y lo inserta
         * @param string $correo
         * @param string $nombre
         * @param string $contraseña
         * @param int $edad
         */
        public static function registrar($correo, $nombre, $contraseña, $edad) {
            if (!self::buscaUsuario($correo)) {
                $contraseña = self::hashContraseña($contraseña);
                $usuario = new usuario($correo, $nombre, $contraseña, $edad);
                return self::insertaUsuario($usuario);
            }
            else {
                return false;
            }
        }
        
        /**
         * Devuelve una instancia del usuario que ha encontrado en la bd
         * con el parámetro $correo, o false si no lo encuentra
         * @param string $correo
         */
        private static function buscaUsuario($correo) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM usuario WHERE email='%s'", $conn->real_escape_string($correo));
            $rs = $conn->query($query);
            if ($rs) {
                if ($rs->num_rows == 1) {
                    $usuario = $rs->fetch_assoc();
                    $correo = $usuario['email'];
                    $nombre = $usuario['nombre'];
                    $contraseña = $usuario['contraseña'];
                    $edad = $usuario['edad'];
                    $id = $usuario['id'];
                    $rol = $usuario['rol'];
                    $usuario = new usuario($correo, $nombre, $contraseña, $edad, $id, $rol);
                    $rs->free();
                    return $usuario;
                }
            }
            else {
                echo "Error SQL ({$conn->errno}):  {$conn->error}";
            }
            return false;
        }

        /**
         * Método que inserta un usuario en la bd
         * @param Usuario $usuario Usuarioa insertar
         */
        private static function insertaUsuario($usuario) {
            $conn = aplicacion::getInstance()->getConexionBd();
            $query=sprintf("INSERT INTO usuario(nombre, email, contraseña, edad, rol) VALUES ('%s', '%s', '%s', '%s', '%s')"
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
            else {
                echo "Error SQL ({$conn->errno}):  {$conn->error}";
            }
            return false;
        }

        /**
         * Comprueba si la contraseña pasada por parámetro coincide con la del usuario
         * @param string $contraseña
         */
        private function compruebaContraseña($contraseña) {
            return password_verify($contraseña, $this->contraseña);
        }

        /**
         * Hashea la contraseña pasada por parámetro
         * @param string $contraseña
         */
        private static function hashContraseña($contraseña) {
            return password_hash($contraseña, PASSWORD_DEFAULT);
        }

        /**
         * Método que devuelve el nombre del usuario
         */
        public function getNombre() {
            return $this->nombre;
        }

        public function getId() {
            return $this->id;
        }

        /**
         * Método que devuelve si el usuario es administrador o no
         */
        public function esAdmin() {
            return $this->rol == self::ROL_ADMIN;
        }


        /**
         * Método que establece un nuevo id del usuario
         * @param int $id Nuevo identificador del usuario
         */
        public function setId($id) {
            $this->id = $id;
        }

    }