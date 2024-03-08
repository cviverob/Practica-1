<?php

class Usuario
{

    public const ROL_USUARIO = 0;

    public const ROL_ADMIN = 1;

      /* Atributos del programa */   

      private $id;

      private $nombreUsuario;

      private $email;
  
      private $contrasenia;
  
      private $edad;
  
      private $rol; // Admin o usuario normal

  

      /* Constructor */

    private function __construct($id, $nombre, $email, $contrasenia, $edad, $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasenia = $contrasenia;
        $this->edad = $edad;
        $this->rol = $rol;
    }

    
    /* Funciones públicas */
    public static function login($correo, $contrasenia) {
        $usuario = self::buscaUsuario($correo);
        if ($usuario && $usuario->comprobarContrasenia($contrasenia)) {
            return $usuario;
        }
        return false;
    }
  
    public static function crea($nombre, $email, $contrasenia, $edad) {
        $usuario = new Usuario(null, $nombre, $email, self::hashContrasenia($contrasenia), $edad, self::ROL_USUARIO);
        $usuario = self::insertaUsuario($usuario);
        return $usuario;
    }
    
    public function esAdmin() {
        return $this->rol == self::ROL_ADMIN;
    }

    public static function buscaUsuario($correo)
    {
        $conn = BD::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE email='%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario( $fila['id'], $fila['nombre'], $fila['email'],$fila['contraseña'], $fila['edad'], $fila['rol']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        $conn->cierraConexion();
        return $result;
    }
   
    private static function insertaUsuario($usuario)
    {
        $result = false;
        $conn = BD::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario(id, nombre, email, contraseña, edad, rol) VALUES ('%s','%s','%s','%s', '%s', '%s')"
            , $conn->real_escape_string(null)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->contrasenia)
            , $conn->real_escape_string($usuario->edad)
            , $conn->real_escape_string($usuario->rol)//seguramente haya que cambiarlo y simplemente poner 0
        );
        if ( $conn->query($query) ) {
            $usuario->id = sprintf("SELECT id FROM usuario WHERE nombre = %d", $usuario->nombre);
            $result = $usuario;
        return $result;
    }


    //Esta funcion de momento no sabemos si la vamos a usar
    public static function buscaPorId($idUsuario)
    {
        $conn = BD::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['id'], $fila['nombre'], $fila['email'],$fila['contraseña'] $fila['edad'], $fila['rol']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    private static function hashContrasenia($contrasenia) {
        return password_hash($contrasenia, PASSWORD_DEFAULT);
    }
   
    private static function insertaUsuario($usuario)
    {
        $result = false;
        $conn = BD::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario(id, nombre, email, contraseña, edad, rol) VALUES ('%s','%s','%s','%s', '%s', '%s')"
            , $conn->real_escape_string(null)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->contrasenia)
            , $conn->real_escape_string($usuario->edad)
            , $conn->real_escape_string($usuario->rol)//seguramente haya que cambiarlo y simplemente poner 0
        );
        if ( $conn->query($query) ) {
            $usuario->id = $conn->id;
            //$result = self::insertaRoles($usuario);
            $result = $this;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    private static function borra($usuario)
    {
        return self::borraPorId($usuario->id);
    }
    

    //De momento no la usamos, ya la usaremos mas adelante
    private static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        } 
        /* Los roles se borran en cascada por la FK
         * $result = self::borraRoles($usuario) !== false;
         */
        $conn = BD::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM usuario U WHERE U.id = %d"
            , $idUsuario
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombreUsuario;
    }

    private function comprobarContrasenia($contrasen) {
        return password_verify($contrasen, $this->contrasenia);
    }

    private static function hashContrasenia($contrasenia) {
        return password_hash($contrasenia, PASSWORD_DEFAULT);
    }
}