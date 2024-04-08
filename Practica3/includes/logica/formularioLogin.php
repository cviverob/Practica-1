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
            $contraseña = $datos['contraseña'] ?? '';
            $html = <<<EOS
            <p>¿Todavía no tienes un usuario? <a href="registro.php" class="RegisterUserButton">¡Regístrate!</a></p>
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
                        <label for = "contraseña">Contraseña:</label>
                        <input id = "contraseña" type = "password" name = "contraseña" value = "$contraseña" />
            EOS;
            $html.= $this->mostrarError('contraseña');
            $html .= <<<EOS
                    </div>
                </fieldset>
                    <button type = "submit" name = "login" class = "Entrar">Entrar</button>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            $correo = trim($datos['correo'] ?? '');
            $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$correo || empty($correo)) {
                $this->errores['correo'] = 'El correo no puede estar vacío';
            }
            $contraseña = trim($datos['contraseña'] ?? '');
            $contraseña = filter_var($contraseña, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$contraseña || empty($contraseña)) {
                $this->errores['contraseña'] = 'La contraseña no puede estar vacía.';
            }
            if (count($this->errores) === 0) {
                $usuario = Usuario::login($correo, $contraseña);
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