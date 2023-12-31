<?php

use src\modelo\Clases\Presentacion;

session_start();

require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';


if (isset($_GET['nombre']) && ($_GET['nombre'] != null && $_GET['nombre'] != "")) {
    $nombre = $_GET['nombre'];
    $descripcion = $_GET['descripcion'];
    $_SESSION = (['nombre' => $nombre, 'descripcion' => $descripcion]);
    header('Location:crearDiapositiva.php');
}

if (isset($_COOKIE["id_ultima_presentacion"])) {
    $idUltimaPresentacion = $_COOKIE["id_ultima_presentacion"];
} else {
}
if (isset($_COOKIE['idEstilo'])) {
    $estilo = $_COOKIE['idEstilo'];
}
$_SESSION["id_ultima_presentacion"] = $idUltimaPresentacion;
if (isset($_COOKIE["crearDiapo"])) {
    $mostrarFeedback = $_COOKIE["crearDiapo"];
} else {
}
if (isset($_COOKIE["nDiapo"])) {
    $nDiapo = $_COOKIE["nDiapo"];
} else {
}

$_SESSION["id_ultima_presentacion"] = $idUltimaPresentacion;

$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();

$resultado = Presentacion::devolverPresentacion($conexion, $idUltimaPresentacion);

$nombrePresentacion = $resultado[0]['nombre'];

setcookie("nDiapo", $nDiapo, time() + 3600, "/");

setcookie("idEstilo", $estilo, time() + 3600, "/");

setcookie("id_ultima_presentacion", $idUltimaPresentacion, time() + 3600, "/");

if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $tipoDiapo = $_POST['tipoDiapo'];
    $imagen = $_POST['imagen'];
    $respuestaCorrecta = $_POST['respuestaCorrecta'];
    $pregunta = $_POST['pregunta'];
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/crearDiapositiva.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Crear Diapositiva</title>
</head>

<body>
    <div class="cabecera">

        <div class="bienvenida">
            <span>Nueva Diapositiva</span>
        </div>
    </div>
    <div class="crearDiapositiva">
        <div class="fondoLila">
            <div class="tiutlo">
                <span>Presentación:
                    <?= $nombrePresentacion ?>
                </span>
            </div>

            <div class="contentCrearDiapositivas">
                <form id="crearDiapositiva" action="../controllers/crearDiapositivaController.php" method="post"
                    class="form" enctype="multipart/form-data">
                    <fieldset class="divFormRow">
                        <legend class="subtitulos">Tipo de diapositiva</legend>
                        <div>
                            <input type="hidden" id="presentaciones_id" value="<?= $idUltimaPresentacion ?>">
                            <input type="radio" id="tipoTitulo" name="tipoDiapo" value="titulo" <?php echo (!isset($tipoDiapo) || $tipoDiapo === 'titulo') ? 'checked' : ''; ?>>
                            <label for="tipoTitulo">Titulo</label><br>
                        </div>
                        <div>
                            <input class="contDiapo" type="radio" id="tipoTituloCont" name="tipoDiapo" value="contenido"
                                <?php echo (isset($tipoDiapo) && $tipoDiapo === 'contenido') ? 'checked' : ''; ?>>
                            <label for="tipoTituloCont">Titulo y contenido</label>
                        </div>
                        <div>
                            <input class="imgDiapo" type="radio" id="tipoImg" name="tipoDiapo" value="imagen" <?php echo (isset($tipoDiapo) && $tipoDiapo === 'imagen') ? 'checked' : ''; ?>>
                            <label for="tipoImg">Titulo e Imagen</label>
                        </div>
                        <div>
                            <input class="test" type="radio" id="test" name="tipoDiapo" value="test" <?php echo (isset($tipoDiapo) && $tipoDiapo === 'test') ? 'checked' : ''; ?>>
                            <label for="test">Tipo Test</label>
                        </div>
                    </fieldset>
                    <div>
                        <div class="divFormColumn">
                            <label for="tituloDiapo">Titulo</label>
                            <div id="errNombre" class="errores">

                            </div>
                            <input class="titulo" type="text" id="tituloDiapo" name="tituloDiapo"
                                placeholder="Titulo de tu Diapositiva" required
                                value="<?php echo empty($titulo) ? '' : htmlspecialchars($titulo); ?>">
                        </div>
                        <div class="divOculto divFormColumn">
                            <label for="contenidoDiapo">Contenido</label>
                            <div id="errDescripcion" class="errores">

                            </div>
                            <textarea class="inputCont text textarea" id="contenidoDiapo" name="contenidoDiapo"
                                placeholder="Empieza aqui..."><?php echo (isset($contenido) && !empty($contenido)) ? htmlspecialchars($contenido) : ''; ?></textarea>
                        </div>
                        <div class="imgOculto divFormColumn">
                            <div class="divFrom">
                                <label for="contenidoDiapo">Imagen</label><label for="contenidoDiapo">Contenido</label>
                            </div>
                            <div id="errDescripcionImg" class="errores">

                            </div>
                            <div class="divFrom2">
                                <div class="imgcss">
                                    <input class="img" id="fileTest" name="imagen" id="imagen" type="file"
                                        accept=".png, .jpg">
                                </div>
                                <textarea class="inputCont textAreaImg" id="contenidoDiapoImg" name="contenidoDiapoImg"
                                    placeholder="Empieza aqui..."><?php echo (isset($contenido) && !empty($contenido)) ? htmlspecialchars($contenido) : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="respuestaOculta">
                            <label for="pregunta">Pregunta</label>
                            <div id="errDescripcion" class="errores"></div>
                            <input class="pregunta" type="text" id="pregunta" name="pregunta"
                                placeholder="¿Cual será tu pregunta?" 
                                value="<?php echo empty($pregunta) ? '' : htmlspecialchars($pregunta); ?>">
                            <label for="opcionesRespuestas">Posibles respuestas</label>
                            <textarea class="textarea" id="contenidoDiapoTest" name="contenidoDiapoTest"
                                placeholder="Ingresa aca las posibles respuestas..."><?php echo (isset($contenido) && !empty($contenido)) ? htmlspecialchars($contenido) : ''; ?></textarea>
                            <span class="alerta">*Ingrese las opciones separadas por comas (,)</span>
                            <label for="respuestaCorrecta">Respuesta Correcta</label>
                            <div id="errDescripcion" class="errores"></div>
                            <input class="respuesta" type="text" id="respuestaCorrecta" name="respuestaCorrecta"
                                placeholder="Ingresa la respuesta correcta a esta pregunta" 
                                value="<?php echo empty($respuestaCorrecta) ? '' : htmlspecialchars($respuestaCorrecta); ?>">
                        </div>
                    </div>

                    <div class="botonNuevaDiapositiva">
                        <button class="botonCrear" type="submit">Crear</button>
                        <div class="centrar">

                            <div class="btnVerSalir">
                                <?php if ($nDiapo == "editarPres") { ?>
                                    <button type="button" class="botonSalir"
                                        onclick="window.location.href='/vista/editarPresentacion.php'">Salir</button>
                                <?php } else { ?>
                                    <button type="button" class="botonSalir"
                                        onclick="window.location.href='/vista/home.php'">Salir</button>
                                <?php } ?>
                                <button type="button" class="botonVer" onclick="verDiapositiva()">Ver</button>
                            </div>
                        </div>
                </form>
                <?php
                $mostrarToast = $_SESSION['toast'];
                if ($mostrarToast) {
                    echo '<div id="toast" class="toast">¡Diapositiva creada con éxito!</div>';
                }
                $_SESSION['toast'] = false;
                ?>
            </div>
        </div>
    </div>


</body>
<script src="javascript/crearDiapositiva.js"></script>

</html>