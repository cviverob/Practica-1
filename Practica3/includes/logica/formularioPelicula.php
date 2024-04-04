<?php

    namespace es\ucm\fdi\aw;

    /**
     * Clase encargada del formulario de las películas
     */
    class FormularioPelicula extends Formulario {

        /**
         * @param Pelicula $pelicula Película original para modificar, o null
         * si estamos en el caso de dar de alta
         */
        private $pelicula;

        public function __construct($idPelicula = null) {
            parent::__construct('formPelicula', ['urlRedireccion' => RUTA_APP . RUTA_ADMN, 
                'enctype' => 'multipart/form-data']
            );
            $this->pelicula = $idPelicula != null ? Pelicula::buscar($idPelicula) : null;
        }

        public function generaCamposFormulario(&$datos) {
            if ($this->pelicula) {
                $nombre = $this->pelicula->getTitulo();
                $sinopsis = $this->pelicula->getSinopsis();
                $pegi = $this->pelicula->getPegi();
                $genero = $this->pelicula->getGenero();
                $duracion = $this->pelicula->getDuracion();
            }
            $nombre = $datos['nombre'] ?? $nombre ?? '';
            $sinopsis = $datos['sinopsis'] ?? $sinopsis ?? '';
            $pegi = $datos['pegi'] ?? $pegi ?? '';
            $genero = $datos['genero'] ?? $genero ?? '';
            $duracion = $datos['duracion'] ?? $duracion ?? '';
            $html = <<<EOS
                <fieldset>
                    <legend>Datos de la película</legend>
                    <div>
            EOS;
            $html .= $this->mostrarErroresGlobales();   // Mostramos los errores globales
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "nombre">Nombre:</label>
                        <input id = "nombre" type = "text" name = "nombre" value = "$nombre" />
            EOS;
            $html .= $this->mostrarError('nombre');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "sinopsis">Sinopsis:</label>
                        <input id = "sinopsis" type = "text" name = "sinopsis" value = "$sinopsis" />
            EOS;
            $html.= $this->mostrarError('sinopsis');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "pegi">Pegi:</label>
                        <input id = "pegi" type = "text" name = "pegi" value = "$pegi" />
            EOS;
            $html .= $this->mostrarError('pegi');
            $html .= <<<EOS
                    </div>
                    <div>
                        <label for = "poster">Póster:</label>
                        <input id = "poster" type = "file" name = "poster" />
            EOS;
            if ($this->pelicula) {
                $rutaPoster = RUTA_APP . RUTA_PSTR . "/" . $this->pelicula->getRutaPoster();
                $html .= <<<EOS
                                <a href = $rutaPoster>Póster actual</a>
                EOS;
            }
            $html .= <<<EOS
                        <div>
            EOS;
            $html.= $this->mostrarError('poster');
            $html .= <<<EOS
                    </div>
                    </div>
                    <div>
                        <label for = "trailer">Tráiler:</label>
                        <input id = "trailer" type = "file" name = "trailer" />
            EOS;
            if ($this->pelicula) {
                $rutaTrailer = RUTA_APP . RUTA_TRL . "/" . $this->pelicula->getRutaTrailer();
                $html .= <<<EOS
                                <a href = $rutaTrailer>Trailer actual</a>
                EOS;
            }
            $html .= <<<EOS
                        <div>
            EOS;
            $html .= $this->mostrarError('trailer');
            $html .= <<<EOS
                    </div>
                    </div>
                    <div>
                        <label for = "genero">Género:</label>
                        <input id = "genero" type = "text" name = "genero" value = "$genero"/>
                        <div>
            EOS;
            $html.= $this->mostrarError('genero');
            $html .= <<<EOS
                        </div>
                    </div>
                    <div>
                        <label for = "duracion">Duración:</label>
                        <input id = "duracion" type = "text" name = "duracion" value = "$duracion" />
            EOS;
            $html.= $this->mostrarError('duracion');
            $html .= <<<EOS
                    </div>
                </fieldset>
                <div>
                    <button type = "submit" name = "login">Subir</button>
                </div>
            EOS;
            return $html;
        }

        public function procesaFormulario(&$datos) {
            
            $nombre = trim($datos['nombre'] ?? '');
            $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$nombre || empty($nombre)) {
                $this->errores['nombre'] = 'El nombre no puede estar vacío';
            }
            $sinopsis = trim($datos['sinopsis'] ?? '');
            $sinopsis = filter_var($sinopsis, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$sinopsis || empty($sinopsis)) {
                $this->errores['sinopsis'] = 'La sinopsis no puede estar vacía';
            }
            $pegi = trim($datos['pegi'] ?? '');
            $pegi = filter_var($pegi, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$pegi || empty($pegi)) {
                $this->errores['pegi'] = 'El pegi no puede estar vacío';
            }
            else if (!is_numeric($pegi)) {
                $this->errores['pegi'] = 'El pegi debe ser un número';
            }
            else if ($pegi < 0 || $pegi > 18) {
                $this->errores['pegi'] = 'El pegi debe ser un número entre 0 y 18';
            }
            $tiposPermitidos = array('image/jpeg', 'image/jpg', 'image/png');
            if (!isset($_FILES['poster']) || $_FILES['poster']['error'] !== UPLOAD_ERR_OK) {
                if (!$this->pelicula) {
                    $this->errores['poster'] = ' :(';
                }
            }
            else if (!in_array($_FILES['poster']['type'], $tiposPermitidos)) {
                $this->errores['poster'] = 'El tipo de imagen no es válido. Solo se permiten imágenes JPEG, JPG o PNG.';
            }
            else {
                $rutaPoster = $_FILES['poster']['name'];
            }
            $tiposPermitidos = array('video/mp4');
            if (!isset($_FILES['trailer']) || $_FILES['trailer']['error'] !== UPLOAD_ERR_OK) {
                if (!$this->pelicula) {
                    $this->errores['trailer'] = ' :(';
                }
            }
            else if (!in_array($_FILES['trailer']['type'], $tiposPermitidos)) {
                $this->errores['trailer'] = 'El tipo de vídeo no es válido. Solo se permiten vídeos MP4.';
            }
            else {
                $rutaTrailer = $_FILES['trailer']['name'];
            }
            $genero = trim($datos['genero'] ?? '');
            $genero = filter_var($genero, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$genero || empty($genero)) {
                $this->errores['genero'] = 'El género no puede estar vacío';
            }
            $duracion = trim($datos['duracion'] ?? '');
            $duracion = filter_var($duracion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$duracion || empty($duracion)) {
                $this->errores['duracion'] = 'La duración no puede estar vacía';
            }
            else if (!is_numeric($duracion)) {
                $this->errores['duracion'] = 'La duración debe ser un número';
            }
            else if ($duracion < 0) {
                $this->errores['duracion'] = 'La duración no puede ser negativa';
            }

            /* 
                Función unlink sacada del chatgpt para borrar los archivos subidos
                en caso de un error posterior.
                Por otro lado, hacemos la comprobación !isset($rutaPoster)
                que únicamente saltará si estamos en el estado de modificar y no
                hemos subido el archivo correspondiente. En cualquier otro caso,
                se meterá en la función de move_uploaded_file();
            */
            if (count($this->errores) === 0) {
                // Copiamos los archivos del póster y del tráiler
                if (!isset($rutaPoster) || move_uploaded_file($_FILES['poster']['tmp_name'], RUTA_RAIZ . RUTA_PSTR . '/' . $rutaPoster)) {
                    if (!isset($rutaTrailer) || move_uploaded_file($_FILES['trailer']['tmp_name'], RUTA_RAIZ . RUTA_TRL . '/' . $rutaTrailer)) {
                        if ($this->pelicula) {    // Modificar
                            if (Pelicula::actualizaPelicula($this->pelicula->getId(), $nombre, $sinopsis, 
                                $rutaPoster ?? $this->pelicula->getRutaPoster(), $rutaTrailer ?? 
                                $this->pelicula->getRutaTrailer(), $pegi, $genero, $duracion)) {
                                if (isset($rutaPoster) && $rutaPoster != $this->pelicula->getRutaPoster()) {
                                    unlink(RUTA_RAIZ . RUTA_PSTR . "/" . $this->pelicula->getRutaPoster()); 
                                }
                                if (isset($rutaTrailer) && $rutaTrailer != $this->pelicula->getRutaTrailer()) {
                                    unlink(RUTA_RAIZ . RUTA_TRL . "/" . $this->pelicula->getRutaTrailer());
                                }
                            }
                            else {
                                $this->errores[] = "Error al modificar la película";
                            }
                        }   // Dar de alta
                        else if (!Pelicula::crear($nombre, $sinopsis, $rutaPoster, $rutaTrailer, $pegi, $genero, $duracion)) {
                            unlink(RUTA_RAIZ . $ruta_destino_poster); 
                            unlink(RUTA_RAIZ . $ruta_destino_trailer);   
                            $this->errores[] = "Error al subir la película"; 
                        }
                    }
                    else {
                        unlink(RUTA_RAIZ . $ruta_destino_poster);   
                        $this->errores[] = "Error al subir el tráiler";
                    }
                }
                else {
                    $this->errores[] = "Error al subir el póster";
                }
            }
        }

    }