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

    public static function crea($nombre, $email, $contrasenia, $edad, $rol = self::ROL_USUARIO) {
        $usuario = new Usuario(null, $nombre, $email, self::hashContrasenia($contrasenia), $edad, $rol);
        $usuario->guardarUsuario();
        return $usuario;
    }
    
    public function esAdmin() {
        return $this->rol == self::ROL_ADMIN;
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = BD::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario U WHERE U.nombre='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario( $fila['id'], $fila['nombre'], $fila['email'],$fila['contraseña'] $fila['edad'], $fila['rol']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
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
   

    // private static function actualiza($usuario)
    // {
    //     $result = false;
    //     $conn = BD::getInstance()->getConexionBd();
    //     $query=sprintf("UPDATE usuario U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d"
    //         , $conn->real_escape_string($usuario->nombreUsuario)
    //         , $conn->real_escape_string($usuario->nombre)
    //         , $conn->real_escape_string($usuario->password)
    //         , $usuario->id
    //     );
    //     if ( $conn->query($query) ) {
    //         $result = self::borraRoles($usuario);
    //         if ($result) {
    //             $result = self::insertaRoles($usuario);
    //         }
    //     } else {
    //         error_log("Error BD ({$conn->errno}): {$conn->error}");
    //     }
        
    //     return $result;
    // }
   
    // private static function borraRoles($usuario)
    // {
    //     $conn = BD::getInstance()->getConexionBd();
    //     $query = sprintf("DELETE FROM RolesUsuario RU WHERE RU.usuario = %d"
    //         , $usuario->id
    //     );
    //     if ( ! $conn->query($query) ) {
    //         error_log("Error BD ({$conn->errno}): {$conn->error}");
    //         return false;
    //     }
    //     return $usuario;
    // }
    
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

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    // public function añadeRol($role)
    // {
    //     $this->roles[] = $role;
    // }

    // public function getRoles()
    // {
    //     return $this->roles;
    // }

    // public function tieneRol($role)
    // {
    //     if ($this->roles == null) {
    //         self::cargaRoles($this);
    //     }
    //     return array_search($role, $this->roles) !== false;
    // }

    private function comprobarContrasenia($contrasenia) {
        return password_verify($contrasenia, $this->contrasenia);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
    
    public function guardarUsuario()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::insertaUsuario($this);
    }
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
}




    // private static function cargaRoles($usuario)
    // {
    //     $roles=[];
            
    //     $conn = BD::getInstance()->getConexionBd();
    //     $query = sprintf("SELECT RU.rol FROM RolesUsuario RU WHERE RU.usuario=%d"
    //         , $usuario->id
    //     );
    //     $rs = $conn->query($query);
    //     if ($rs) {
    //         $roles = $rs->fetch_all(MYSQLI_ASSOC);
    //         $rs->free();

    //         $usuario->roles = [];
    //         foreach($roles as $rol) {
    //             $usuario->roles[] = $rol['rol'];
    //         }
    //         return $usuario;

    //     } else {
    //         error_log("Error BD ({$conn->errno}): {$conn->error}");
    //     }
    //     return false;
    // }










    // private static function insertaRoles($usuario)
    // {
    //     $conn = BD::getInstance()->getConexionBd();
    //     foreach($usuario->roles as $rol) {
    //         $query = sprintf("INSERT INTO RolesUsuario(usuario, rol) VALUES (%d, %d)"
    //             , $usuario->id
    //             , $rol
    //         );
    //         if ( ! $conn->query($query) ) {
    //             error_log("Error BD ({$conn->errno}): {$conn->error}");
    //             return false;
    //         }
    //     }
    //     return $usuario;
    // }
    