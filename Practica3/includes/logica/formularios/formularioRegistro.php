<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de registro
     */
    class FormularioRegistro extends Formulario {

        public function __construct() {
            parent::__construct('formReg', ['urlRedireccion' => '/Ejercicio-3']);
        }

        public function generaCamposFormulario(&$datos) {
            $nombre = $datos['nombre'] ?? '';
            $nombreUsuario = $datos['nombreUsuario'] ?? '';
            $contra1 = $datos['contra1'] ?? '';
            $contra2 = $datos['contra2'] ?? '';
            $html = <<<EOS
                <fieldset>
                    <legend>Usuario, nombre y contraseñas</legend>
                    <div>
                        <label for = "nombreUsuario">Nombre de usuario:</label>
                        <input id = "nombreUsuario" type = "text" name = "nombreUsuario" 
                            value = "$nombreUsuario" />
            EOS;
            $html .= $this->mostrarError('nombreUsuario');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "nombre">Nombre:</label>
                        <input id = "nombre" type = "text" name = "nombre" value = "$nombre" />
            EOS;
            $html.= $this->mostrarError('nombre');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "contra1">Contraseña:</label>
                        <input id = "contra1" type = "password" name = "contra1" value = "$contra1" />
            EOS;
            $html.= $this->mostrarError('contra1');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "contra2">Repite la contraseña:</label>
                        <input id = "contra2" type = "password" name = "contra2" value="$contra2" />
            EOS;
            $html.= $this->mostrarError('contra2');
            $html .= <<<EOS
                    </div>
                </fieldset>
                <div>
                    <button type = "submit" name = "registro">Entrar</button>
                </div>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            $nombreUsuario = trim($datos['nombreUsuario'] ?? '');
            $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$nombreUsuario || empty($nombreUsuario)) {
                $this->errores['nombreUsuario'] = 'El nombre de usuario no puede estar vacío';
            }
            $nombre = trim($datos['nombre'] ?? '');
            $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$nombre || empty($nombre)) {
                $this->errores['nombre'] = 'El nombre no puede estar vacío';
            }
            $contra1 = trim($datos['contra1'] ?? '');
            $contra1 = filter_var($contra1, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$contra1 || empty($contra1) || mb_strlen($contra1) < 5) {
                $this->errores['contra1'] = 'La contraseña debe tener al menos 5 caracteres';
            }
            $contra2 = trim($datos['contra2'] ?? '');
            $contra2 = filter_var($contra2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$contra2 || $contra1 != $contra2) {
                $this->errores['contra2'] = 'Las contraseñas deben coincidir';
            }
            if (count($this->errores) === 0) {
                $usuario = Usuario::registrar($nombreUsuario, $nombre, $contra1);
                if (!$usuario) {
                    $this->errores[] = 'El usuario ya existe';
                }
                else {
                    $_SESSION['login'] = true;
                    $_SESSION['nombre'] = $usuario->getNombre();
                    $_SESSION['esAdmin'] = $usuario->esAdmin();
                    header('Location: index.php');
                }
            }
        }

    }