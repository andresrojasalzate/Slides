<?php

use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\DiapositivaImagen;
use src\modelo\Clases\Presentacion;
use src\modelo\Clases\Estilo;

require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Presentacion.php';
require_once '../modelo/Clases/Diapositiva.php';
require_once '../modelo/Clases/DiapositivaImagen.php';
require_once '../modelo/Clases/Estilo.php';

session_start();

//Almacenar presentaciones desde la BD para mostrarlas en la pantalla home
//$presentaciones = [];
$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();
$presentaciones = Presentacion::devolverPresentaciones($conexion);
$mostrarFeedback = null;

$_SESSION['toast'] = false;


function buscarElementoEnArray($posicion, $miArray)
{
    if (isset($miArray[$posicion])) {
        $valorColumna = $miArray[$posicion]['id'];
        return $valorColumna;
    } else {
        return "La posición especificada no existe en el array";
    }
}

function arrayDiapos($posicion, $miArray)
{
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();

    $id = buscarElementoEnArray($posicion, $miArray);
    $diapos = Diapositiva::arrayDiapositivas($conexion, $id);

    $conexion = null;

    return $diapos;
}
function buscarIdEstilo($posicion, $miArray)
{
    if (isset($miArray[$posicion])) {
        $valorColumna = $miArray[$posicion]['estilo_id'];
        return $valorColumna;
    } else {
        return "La posición especificada no existe en el array";
    }
}
function recargar(){
    header("Location: /vista/home.php");
}
function devolverEstilo($posicion, $miArray){
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();

    $idEstilo = buscarIdEstilo($posicion, $miArray);

    $estilo = Estilo::getEstilo($conexion, $idEstilo);
    
    foreach ($estilo as $fila) {
        $cssResource = $fila['css_resource'];
        
    }
    return $cssResource;
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
if (isset($_COOKIE["idEstilo"])) {
    setcookie("idEstilo", false, time()-3600);
 }
 if (isset($_COOKIE["nDiapo"])) {
    setcookie("nDiapo", "", time()-3600);
 }

 
//Eliminar las presentaciones
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["btnAceptar"])) {
        $mostrarFeedback = Presentacion::eliminarPresentacion($conexion, $_POST["btnAceptar"]);
        $presentaciones = Presentacion::devolverPresentaciones($conexion);
        DiapositivaImagen::eliminarCarpeta($_POST["btnAceptar"]);
    }
}

//Eliminar las presentaciones
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["btnSharePresentacion"])) {
        $mostrarFeedback = Presentacion::compartirPresentacion($conexion,$_POST['btnSharePresentacion']);
        $presentaciones = Presentacion::devolverPresentaciones($conexion);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/home.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                    <?php if (count($presentaciones) > 0): ?>
                        <?php foreach ($presentaciones as $posicion => $presentacion): ?>
                            <div class="<?php echo ($presentacion['vista_cliente']===1) ? 'presentacionBDCompartida' : 'presentacionBD';?>">
                                <div class="titulo"><span><?= $presentacion['nombre'] ?></span></div>
                                <div class="nroDiapositivas"><span>Diapositivas:<?= $presentacion['nroDiapositivas']; ?></span></div>
                                <div class="opciones">
                                    <button name="btnEditPresentacion" value="<?= buscarElementoEnArray($posicion, $presentaciones) ?>" class="material-symbols-outlined tool_container"><span class="tool_text">Editar Presentación</span> edit</button>
                                    <button name="btnDelPresentacion" value="<?= buscarElementoEnArray($posicion, $presentaciones) ?>" class="material-symbols-outlined tool_container"><span class="tool_text">Eliminar Presentación</span> delete</button>
                                    <form action="home.php" method="POST">
                                        <button name="btnSharePresentacion" class="material-symbols-outlined tool_container" value="<?= buscarElementoEnArray($posicion, $presentaciones) ?>" <?php if($presentacion['vista_cliente']===1) echo 'disabled'?>><span class="tool_text">Compartir Presentación</span> share</button>
                                    </form>
                                    <button class="vDiapo material-symbols-outlined tool_container" data-position="<?= htmlspecialchars(json_encode(arrayDiapos($posicion, $presentaciones))) ?>" estilo="<?= devolverEstilo($posicion, $presentaciones)?>"><span class="tool_text">Ver Presentación</span> visibility</button>
                                    <button class="nDiapo material-symbols-outlined tool_container" data-id="<?= $presentacion['id'] ?>" data-position="<?= buscarElementoEnArray($posicion, $presentaciones) ?>"><span class="tool_text">Agregar Diapositiva</span><span>library_add</span></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="botonNuevaPresentacion">
                    <form action="crearPresentacion.php">
                        <button class="botonCrear animacion" type="submit">Nueva Presentación</button>
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
    <?php if ($mostrarFeedback != null): ?>
        <div class="fondoModalFeedBackEliminarPresentacion">
            <div class="modalFeedBackEliminarPresentacion">
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
    <script src="../vista/javascript/homejavascript.js"></script>
</body>

</html>
