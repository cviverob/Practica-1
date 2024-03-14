<?php
    require_once('config.php');

    function creaFormularioRegistro($nombre = '', $edad = '', $correo = '', $contrasenia = '') {
        $ruta_proc_reg = RUTA_APP . RUTA_PROC_REG;
        $ruta_lgin = RUTA_APP . RUTA_LGIN;
        return <<<EOS
            <a href = "$ruta_lgin"><button type = "button">Conectarse</button></a>
            <a href = ""><button type = "button">Registrarse</button></a>
            <form action = "$ruta_proc_reg" method = "POST">
                <fieldset>
                    <legend>Registro</legend>
                    <div>
                        <label>*Nombre:</label>
                        <input type='text' name='nombre' value="$nombre" required />
                    </div>
                    <div>
                        <label>*Edad:</label>
                        <input type='text' name='edad' value="$edad" required />
                    </div>
                    <div>
                        <label>*Correo:</label>
                        <input type='text' name='correo' value="$correo" required />
                    </div>
                    <div>
                        <label>*Contraseña:</label>
                        <input type = "password" name = "contraseña" value = "$contrasenia" required />
                    </div>
                </fieldset>
                *Campo obligatorio
                <button type = "submit">Registrarse</button>
            </form>
        EOS;
    }