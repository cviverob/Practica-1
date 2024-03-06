<?php

class Usuario {
    
    /* Constantes */

    public const ROL_USUARIO = 1;

    public const ROL_ADMIN = 2;

    /* Atributos del programa */

    private $nombre;

    private $email;

    private $contrasenia;

    private $edad;

    private $rol; // Admin o usuario normal

    /* Constructor */

    private function __construct($nombre, $email, $contrasenia, $edad, $rol) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasenia = $contrasenia;
        $this->edad = $edad;
        $this->rol = $rol;
    }

    /* Funciones públicas */

    public static function crea($nombre, $email, $contrasenia, $edad, $rol = self::ROL_USUARIO) {
        $usuario = new Usuario($nombre, $email, self::hashContrasenia($contrasenia), $edad, $rol);
        $usuario->guardarUsuario();
        return $usuario;
    }

    public static function login($correo, $contrasenia) {
        $usuario = self::buscaUsuario($correo);
        if ($usuario && $usuario->comprobarContrasenia($contrasenia)) {
            return $usuario;
        }
        return false;
    }

    public function esAdmin() {
        return $this->rol == self::ROL_ADMIN;
    }

    public function getNombre() {
        return $this->nombre;
    }

    /* Funciones privadas */

    private static function hashContrasenia($contrasenia) {
        return password_hash($contrasenia, PASSWORD_DEFAULT);
    }

    private function comprobarContrasenia($contrasenia) {
        return password_verify($contrasenia, $this->contrasenia);
    }

    /* Funciones de la BD */

    private static function buscaUsuario($correo) {
        
    }

    private function guardarUsuario() {

    }

}
