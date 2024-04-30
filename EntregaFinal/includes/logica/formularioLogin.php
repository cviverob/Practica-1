<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de login
     */
    class formularioLogin extends formulario {

        public function __construct() {
            parent::__construct('formLogin', ['urlRedireccion' => RUTA_APP . RUTA_INDX]);
        }

        public function generaCamposFormulario(&$datos) {
            /* Obtenemos los valores predeterminados */
            $correo = $datos['correo'] ?? '';
            $contraseña = $datos['contraseña'] ?? '';
            /* Inicio del formulario */
            $html = <<<EOS
            <p>¿Todavía no tienes un usuario? <a href="registro.php" class="botonFormulario">¡Regístrate!</a></p>
                <fieldset>
                    <legend>Usuario y contraseña</legend>
                    <div>
            EOS;
            $html .= $this->mostrarErroresGlobales();
            /* Correo */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "correo">Correo:</label>
                        <input id = "correo" type = "email" name = "correo" value = "$correo" required />
                        <span id = "validezCorreo"></span>
            EOS;
            $html .= $this->mostrarError('correo');
            /* Contraseña */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "contraseña">Contraseña:</label>
                        <input id = "contraseña" type = "password" name = "contraseña" value = "$contraseña" minlength = 5 required/>
                        <span id = "validezContraseña"></span>
            EOS;
            $html.= $this->mostrarError('contraseña');
            /* Botón de login y borrado */
            $html .= <<<EOS
                    </div>
                </fieldset>
                    <button type = "submit" name = "login" class = "botonFormulario">Entrar</button>
                    <button type = "reset" name = "borrar" class = "botonFormulario">Resetear</button>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            /* Validación del correo */
            $correo = trim($datos['correo'] ?? '');
            $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$correo || empty($correo)) {
                $this->errores['correo'] = 'El correo no puede estar vacío';
            }
            /* Validación de la contraseña */
            $contraseña = trim($datos['contraseña'] ?? '');
            $contraseña = filter_var($contraseña, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $contraseña = html_entity_decode($contraseña);
            if (!$contraseña || empty($contraseña) || mb_strlen($contraseña) < 5) {
                $this->errores['contraseña'] = 'La contraseña debe tener al menos 5 caracteres';
            }
            /* Intento de logearse */
            if (count($this->errores) === 0) {
                $usuario = usuario::login($correo, $contraseña);
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