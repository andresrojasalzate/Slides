<?php
use src\modelo\Clases\Presentacion;
require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';

session_start(); 

$idPresentacion = 3; 
$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();
$pin = Presentacion::recuperarPinPresentacion($conexion, $idPresentacion);

if($pin == false){
    header("Location: ../vista/visualizarDiapositiva.php");
    exit;
} 

if (isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/comprobarPin.css">
    <title>Introduce el PIN</title>
</head>
<body>
    <div class="comprobarPin">
        <div class="contenido">
            <div class="tituloComprobarPin">
                <span>Comprobar PIN</span>
            </div>
            <div class="contentFormulario">
                <div class="mostrarFormulario">
                    <form id="formulario" action="../controllers/comprobarPinController.php" method="post">
                        <label class="elementosForm">PIN de la presentación</label><br>
                        <div id="errPin" class="errores">
                            <?php if (isset($errores["pin"])): ?>
                                <p><?= $errores["pin"]; ?></p>      
                            <?php endif; ?>
                        </div>
                        <input class="elementosForm" type="password" id="pin" name="pin" placeholder="Introduce el PIN de la presentación"/><br>
                        <button id="btnEnviar" class="elementosForm" type="submit">Comprobar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>