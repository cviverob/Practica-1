<?php
    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de registro
     */
    class formularioRegistro extends formulario {

        public function __construct() {
            parent::__construct('formReg', ['urlRedireccion' => RUTA_APP . RUTA_INDX]);
        }

        public function generaCamposFormulario(&$datos) {
            /* Obtenemos los valores predeterminados */
            $correo = $datos['correo'] ?? '';
            $nombre = $datos['nombre'] ?? '';
            $contra1 = $datos['contra1'] ?? '';
            $contra2 = $datos['contra2'] ?? '';
            $edad = $datos['edad'] ?? '';
            /* Inicio del formulario */
            $html = <<<EOS
                <p>¿Ya tienes un usuario? <a href = 'login.php' class="LogUserButton">¡Logeate!</a></p>
                <fieldset>
                    <legend>Usuario, nombre y contraseñas</legend>
                    <div>
            EOS;
            $html .= $this->mostrarErroresGlobales();
            /* Correo */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "correo">Correo:</label>
                        <input id = "correo" type = "text" name = "correo" 
                            value = "$correo" />
            EOS;
            $html .= $this->mostrarError('correo');
            /* Nombre */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "nombre">Nombre:</label>
                        <input id = "nombre" type = "text" name = "nombre" value = "$nombre" />
            EOS;
            $html.= $this->mostrarError('nombre');
            /* Contraseña 1 */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "contra1">Contraseña:</label>
                        <input id = "contra1" type = "password" name = "contra1" value = "$contra1" />
            EOS;
            $html.= $this->mostrarError('contra1');
            /* Contraseña 2 */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "contra2">Repite la contraseña:</label>
                        <input id = "contra2" type = "password" name = "contra2" value="$contra2" />
            EOS;
            $html.= $this->mostrarError('contra2');
            /* Edad */
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "edad">Edad:</label>
                        <input id = "edad" type = "text" name = "edad" value="$edad" />
            EOS;
            $html.= $this->mostrarError('edad');
            /* Botones de enviar y borrar */
            $html .= <<<EOS
                    </div>
                </fieldset>
                <div>
                    <button type = "submit" name = "registro" class = "seleccionarPelicula">Entrar</button>
                    <button type = "reset" name = "borrar">Resetear</button>
                </div>
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
            /* Validación del nombre */
            $nombre = trim($datos['nombre'] ?? '');
            $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$nombre || empty($nombre)) {
                $this->errores['nombre'] = 'El nombre no puede estar vacío';
            }
            /* Validación de la contraseña 1 */
            $contra1 = trim($datos['contra1'] ?? '');
            $contra1 = filter_var($contra1, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$contra1 || empty($contra1) || mb_strlen($contra1) < 5) {
                $this->errores['contra1'] = 'La contraseña debe tener al menos 5 caracteres';
            }
            /* Validación de la contraseña 2 */
            $contra2 = trim($datos['contra2'] ?? '');
            $contra2 = filter_var($contra2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$contra2 || $contra1 != $contra2) {
                $this->errores['contra2'] = 'Las contraseñas deben coincidir';
            }
            /* Validación de la edad */
            $edad = trim($datos['edad'] ?? '');
            $edad = filter_var($edad, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$edad || empty($edad)) {
                $this->errores['edad'] = 'La edad no puede estar vacía';
            }
            else if (!is_numeric($edad)) {
                $this->errores['edad'] = 'La edad debe ser un número';
            }
            else if ($edad < 0 || $edad > 125) {
                $this->errores['edad'] = '¡Ponga su edad verdadera!';
            }
            /* Intentamos registrar al usuario */
            if (count($this->errores) === 0) {
                $usuario = usuario::registrar($correo, $nombre, $contra1, $edad);
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