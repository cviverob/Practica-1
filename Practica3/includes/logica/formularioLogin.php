<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de login
     */
    class FormularioLogin extends Formulario {

        public function __construct() {
            parent::__construct('formLogin', ['urlRedireccion' => RUTA_APP]);
        }

        public function generaCamposFormulario(&$datos) {
            $correo = $datos['correo'] ?? '';
            $contra = $datos['contra'] ?? '';
            $html = <<<EOS
                <p>Todavía no tienes un usuario? <a href = 'registro.php'>¡Regístrate!</a></p>
                <fieldset>
                    <legend>Usuario y contraseña</legend>
                    <div>
            EOS;
            $html .= $this->mostrarErroresGlobales();   // Mostramos los errores globales
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "correo">Correo:</label>
                        <input id = "correo" type = "text" name = "correo" 
                            value = "$correo" />
            EOS;
            $html .= $this->mostrarError('correo');
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
            $correo = trim($datos['correo'] ?? '');
            $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$correo || empty($correo)) {
                $this->errores['correo'] = 'El correo no puede estar vacío';
            }
            $contra = trim($datos['contra'] ?? '');
            $contra = filter_var($contra, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$contra || empty($contra)) {
                $this->errores['contra'] = 'La contraseña no puede estar vacía.';
            }
            if (count($this->errores) === 0) {
                $usuario = Usuario::login($correo, $contra);
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