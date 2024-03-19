<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de login
     */
    class FormularioLogin extends Formulario {

        public function __construct() {
            parent::__construct('formLogin', ['urlRedireccion' => '/Ejercicio-3']);
        }

        public function generaCamposFormulario(&$datos) {
            $nombreUsuario = $datos['nombreUsuario'] ?? '';
            $contra = $datos['contra'] ?? '';
            $html = <<<EOS
                <fieldset>
                    <legend>Usuario y contraseña</legend>
                    <div>
                        <label for = "nombreUsuario">Nombre de usuario:</label>
                        <input id = "nombreUsuario" type = "text" name = "nombreUsuario" 
                            value = "$nombreUsuario" />
            EOS;
            $html .= $this->mostrarError('nombreUsuario');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "contra">Contraseña:</label>
                        <input id = "contra" type = "password" name = "contra" value = "$contra" />
            EOS;
            $html.= $this->mostrarError('contra');
            $html .= <<<EOS
                    </div>
                </fieldset>
                <div>
                    <button type = "submit" name = "login">Entrar</button>
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
            $contra = trim($datos['contra'] ?? '');
            $contra = filter_var($contra, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$contra || empty($contra)) {
                $this->errores['contra'] = 'La contraseña no puede estar vacía.';
            }
            if (count($this->errores) === 0) {
                $usuario = Usuario::login($nombreUsuario, $contra);
                if (!$usuario) {
                    $this->errores[] = "El usuario o contraseña no coinciden";
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