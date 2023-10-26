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
$_SESSION["id_ultima_presentacion"] = $idUltimaPresentacion;

if (isset($_COOKIE["crearDiapo"])) {
    $mostrarFeedback = $_COOKIE["crearDiapo"];
} else {
}
$_SESSION["id_ultima_presentacion"] = $idUltimaPresentacion;


$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();

$resultado = Presentacion::devolverPresentacion($conexion, $idUltimaPresentacion);

$nombrePresentacion = $resultado[0]['nombre'];

setcookie("id_ultima_presentacion", $idUltimaPresentacion, time() + 3600, "/");

if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $tipoDiapo = $_POST['tipoDiapo'];

} else {
    $titulo = '';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/crearDiapositiva.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Crear Diapositiva</title>
    <title>Crear Diapositiva</title>
</head>

<body>
    <div class="cabecera">

        <div class="bienvenida centrar">
            <span class="tituloNuevaDiapositiva">Nueva Diapositiva</span>
        </div>
    </div>
    <div class="crearDiapositiva">
        <div class="fondoLila">
            <div class="tiutlo nPresentacion">
                <span>Presentación:
                    <?= $nombrePresentacion ?>
                </span>
            </div>

            <div class="contentCrearDiapositivas">
                <form id="crearDiapositiva" action="../controllers/crearDiapositivaController.php" method="post"
                    class="form">
                    <fieldset class="divFormRow">
                        <legend class="subtitulos">Tipo de diapositiva</legend>
                        <div>
                            <input type="radio" id="tipoTitulo" name="tipoDiapo" value="titulo" <?php echo (!isset($tipoDiapo) || $tipoDiapo === 'titulo') ? 'checked' : ''; ?>>
                            <label for="tipoTitulo">Titulo</label><br>
                        </div>
                        <div>
                            <input class="contDiapo" type="radio" id="tipoTituloCont" name="tipoDiapo" value="contenido"
                                <?php echo (isset($tipoDiapo) && $tipoDiapo === 'contenido') ? 'checked' : ''; ?>>
                            <label for="tipoTituloCont">Titulo y contenido</label>
                        </div>
                    </fieldset>
                    <div>
                        <div class="divFormColumn">
                            <label for="tituloDiapo">Titulo</label>
                            <div id="errNombre" class="errores centrar">

                            </div>
                            <div id="errNombre" class="errores centrar">

                            </div>
                            <input class="titulo" type="text" id="tituloDiapo" name="tituloDiapo"
                                placeholder="Titulo de tu Diapositiva" required
                                value="<?php echo empty($titulo) ? '' : htmlspecialchars($titulo); ?>">
                        </div>
                        <div class="divOculto divFormColumn">
                            <label for="contenidoDiapo">Contenido</label>
                            <div id="errDescripcion" class="errores"></div>
                            <textarea class="inputCont text" id="contenidoDiapo" name="contenidoDiapo"
                                placeholder="Empieza aqui..."><?php echo (isset($contenido) && !empty($contenido)) ? htmlspecialchars($contenido) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="botonNuevaDiapositiva">
                        <button class="botonCrear" type="submit">Crear</button>
                        <div class="centrar">
                            <button type="button" class="botonSalir"
                                onclick="window.location.href='/vista/home.php'">Salir</button>
                            <button type="button" class="botonVer" onclick="verDiapositiva()">Ver</button>
                        </div>
                    </div>
                </form>
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