<?php

use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\Presentacion;

require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Presentacion.php';
require_once '../modelo/Clases/Diapositiva.php';

//Almacenar presentaciones desde la BD para mostrarlas en la pantalla home
$presentaciones = [];
$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();
$presentaciones = Presentacion::devolverPresentaciones($conexion);
$mostrarFeedback = null;

$diapositivas = [];
$diapositivas = Diapositiva::devolverDiapositivas($conexion);

foreach ($presentaciones as &$value) {
    $value['nroDiapositivas'] = 0;
}

foreach ($presentaciones as &$value) {
    $i = array_search($value['id'], array_column($diapositivas, 'id'));
    if ($i !== false) {
        $value['nroDiapositivas'] = $diapositivas[$i]['totalDiapositivas'];
    }
}

function buscarElementoEnArray($posicion, $miArray)
{
    if (isset($miArray[$posicion])) {
        $valorColumna = $miArray[$posicion]['id'];
        return $valorColumna;
    } else {
        return "La posición especificada no existe en el array";
    }
}

function arrayDiapos($posicion, $miArray){
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();

    $id=buscarElementoEnArray($posicion, $miArray);
    $diapos=Diapositiva::arrayDiapositivas($conexion,$id);
    
    $conexion = null;
    
    return $diapos;
}

if (isset($_COOKIE["id_ultima_presentacion"])) {
    setcookie("id_ultima_presentacion", "", time()-3600);
}
if (isset($_COOKIE["arrayDiapositivas"])) {
   setcookie("arrayDiapositivas", "", time()-3600);
}
if (isset($_COOKIE["1diapo"])) {
    setcookie("1diapo", false, time()-3600);
 }


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["btnAceptar"])) {
        $mostrarFeedback = Presentacion::eliminarPresentacion($conexion, $_POST["btnAceptar"]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>

<body>
    <div class="home">
        <div class="presentaciones">
            <div class="tituloContentPresentaciones">
                <span>Presentaciones</span>
            </div>
            <div class="contentPresentaciones">
                <div class="mostrarPresentaciones">
                    <?php if (count($presentaciones) > 0) : ?>
                        <?php foreach ($presentaciones as $posicion => $presentacion) : ?>
                            <div class="presentacionBD">
                                <div class="titulo"><span><?= $presentacion['nombre'] ?></span></div>
                                <div class="nroDiapositivas"><span>Diapositivas: <?= $presentacion['nroDiapositivas']; ?></span></div>
                                <div class="opciones">
                                    <button name="btnEditPresentacion" value="<?= buscarElementoEnArray($posicion, $presentaciones) ?>" class="material-symbols-outlined">edit</button>
                                    <button name="btnDelPresentacion" value="<?= buscarElementoEnArray($posicion, $presentaciones) ?>" class="material-symbols-outlined">delete</button>
                                    <button class="material-symbols-outlined">content_copy</button>
                                    <button class="vDiapo material-symbols-outlined" data-position="<?= htmlspecialchars(json_encode(arrayDiapos($posicion, $presentaciones))) ?>">visibility</button>
                                    <button class="nDiapo library-add-button" data-id="<?= $presentacion['id'] ?>" data-position="<?= buscarElementoEnArray($posicion, $presentaciones) ?>"><span class="material-symbols-outlined">library_add</span></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="botonNuevaPresentacion">
                    <form action="crearPresentacion.php">
                        <button class="botonCrear" type="submit">Nueva Presentación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="fondoModalEliminarPresentacion">
        <div class="modalEliminarPresentacion">
            <div class="cabeceraModal"><span>Confirmación</span></div>
            <div class="mensajeModal"><span>¿Seguro que desea eliminar esta presentación?</span></div>
            <div class="aceptarCancelar">
                <form action="home.php" method="POST">
                    <button class="botonCrear" name="btnAceptar">Aceptar</button>
                </form>
                <button class="botonCrear" name="btnCancelar">Cancelar</button>
            </div>
        </div>
    </div>
    <?php if($mostrarFeedback != null): ?>
        <div class="fondoModalFeedBackEliminarPresentacion">
        <div class="modalFeedBackEliminarPresentacion">
            <div class="cabeceraModal"><span>Confirmación</span></div>
            <div class="mensajeModal"><span><?= $mostrarFeedback?></span></div>
            <div class="aceptarCancelar">
                <button class="botonCrear" name="btnCerrar">Cerrar</button>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <script src="../vista/javascript/homejavascript.js"></script>
</body>

</html>