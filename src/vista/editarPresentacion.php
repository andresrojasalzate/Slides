<?php

use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\DiapositivaImagen;
use src\modelo\Clases\Presentacion;

session_start();

require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Diapositiva.php';
require_once '../modelo/Clases/DiapositivaImagen.php';



if (isset($_COOKIE["id_ultima_presentacion"])) {
    $idUltimaPresentacion = $_COOKIE["id_ultima_presentacion"];
} else {
}

$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();

$resultado = Presentacion::devolverPresentacion($conexion, $idUltimaPresentacion);

$nombrePresentacion = $resultado[0]['nombre'];
$descripcion = $resultado[0]['descripcion'];
$id = $resultado[0]['id'];
$vista_cliente = $resultado[0]['vista_cliente'];
$mostrarFeedback = null;
$diapositivas = Diapositiva::arrayDiapositivas($conexion, $id);

//Funcion para eliminar diapositivas
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["btnAceptar"])) {
        $diapo = returnDiapo($conexion, $_POST["btnAceptar"])["nDiapositiva"];
        Diapositiva::restar1nDiapos($conexion, $id, $diapo, Diapositiva::getTipo($conexion, $_POST["btnAceptar"])["tipoDiapositiva"]);
        $nombre = DiapositivaImagen::getNombreImagen($conexion, $_POST["btnAceptar"]);
        $rutaImagen = dirname(__FILE__) . '/img/' . $idUltimaPresentacion . '/' . $nombre;
        if (file_exists($rutaImagen)) {
            if (!is_dir($rutaImagen) && $nombre !== null) {
                if (unlink($rutaImagen)) {
                }
            } else {
            }
        } else {
        }
        $mostrarFeedback = Diapositiva::eliminarDiapositiva($conexion, $_POST["btnAceptar"]);
        $diapositivas = Diapositiva::arrayDiapositivas($conexion, $id);
    }
}

if (isset($_SESSION['confirmacion'])) {
    if ($_SESSION['confirmacion'] != null) {
        $mostrarFeedback = $_SESSION['confirmacion'];
        unset($_SESSION['confirmacion']);
    }
}

setcookie("id_ultima_presentacion", $idUltimaPresentacion, time() + 3600, "/");

function returnDiapo($connexion, $id)
{
    $diapo = Diapositiva::getDiapo($connexion, $id);
    return $diapo;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/editarPresentacion.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Editar Presentación</title>
</head>

<body>
    <div class="home">
        <div class="pantallaEditar">
            <div class="tituloEditarPresentaciones">
                <span>Editar Presentación</span>
            </div>
            <div class="edicion">
                <div class="datosPresentacion">
                    <div class="contentForm">
                        <form action="../controllers/editarPresentacionController.php" method="POST">
                            <label>Titulo</label>
                            <input class="titulo" name="nombre" type="text" value="<?= $nombrePresentacion ?>" required>
                            <label>Descripción</label>
                            <input class="descripcion" name="descripcion" type="text" value="<?= $descripcion ?>">
                            <div class="botonesEdicionPresentacion">
                                <button class="botonCrear" name="btnNuevaDiapositiva" value="<?= $id ?>">Nueva
                                    Diapositiva</button>
                                <button class="botonCrear">Cambiar Estilo</button>
                            </div>

                            <div class="vistaCliente">
                                <input type="checkbox" id="vista_cliente" name="vista_cliente"
                                    value="<?= $vista_cliente ?>" <?php if ($vista_cliente === 1)
                                          echo 'checked'; ?>>
                                <label for="vista_cliente">Compartir presentación</label>
                            </div>
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button class="botonCrear" type="submit">Guardar Cambios</button>
                            <button class="botonCrear" name="btnVolver">Volver</button>
                        </form>
                    </div>
                </div>
                <div class="contenedorDiapositivas">
                    <?php if (count($diapositivas) > 0): ?>
                        <?php foreach ($diapositivas as $diapositiva): ?>
                            <div class="presentacionBD" draggable="true" id="<?= $diapositiva['id'] ?>">
                                <div class="tituloDiapo"><span>
                                        <?= $diapositiva['titulo'] ?>
                                    </span></div>
                                <div class="opciones">
                                    <button name="btnDelDiapositiva" value="<?= $diapositiva['id'] ?>"
                                        class="material-symbols-outlined ">delete</button>
                                    <button class="vDiapo material-symbols-outlined"
                                        diapo="<?= htmlspecialchars(json_encode(returnDiapo($conexion, $diapositiva['id']))) ?>">visibility</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="mensajeCeroDiapositivas">Aún no hay diapositivas</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="fondoModalEliminarDiapositiva">
        <div class="modalEliminarDiapositiva">
            <div class="cabeceraModal"><span>Confirmación</span></div>
            <div class="mensajeModal"><span>¿Seguro que desea eliminar esta diapositiva?</span></div>
            <div class="aceptarCancelar">
                <form action="editarPresentacion.php" method="POST">
                    <button class="botonCrear" name="btnAceptar">Aceptar</button>
                </form>
                <button class="botonCrear" name="btnCancelar">Cancelar</button>
            </div>
        </div>
    </div>
    <?php if ($mostrarFeedback != null): ?>
        <div class="fondoModalFeedBackEliminarDiapositiva">
            <div class="modalFeedBackEliminarDiapositiva">
                <div class="cabeceraModal"><span>Confirmación</span></div>
                <div class="mensajeModal"><span>
                        <?= $mostrarFeedback ?>
                    </span></div>
                <div class="aceptarCancelar">
                    <button class="botonCrear" name="btnCerrar">Cerrar</button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script src="javascript/editarPresentacion.js"></script>
</body>

</html>
