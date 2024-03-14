<?php
    require_once('config.php');

    function creaFormularioLogin($correo='', $contrasenia='') {
        $ruta_proc_log = RUTA_APP . RUTA_PROC_LOG;
        $ruta_reg = RUTA_APP . RUTA_REG;
        return <<<EOS
            <a href = ""><button type = "button">Conectarse</button></a>
            <a href = "$ruta_reg"><button type = "button">Registrarse</button></a>
            <form action = "$ruta_proc_log" method = "POST">
                <fieldset>
                    <legend>Login</legend>
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
                <button type = "submit">Iniciar sesión</button>
            </form>
        EOS;
    }