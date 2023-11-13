<?php
require_once '../modelo/Clases/Estilo.php';
require_once '../config/ConexionBD.php';
use src\modelo\Clases\Estilo;

session_start(); 

$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();
$estilos = Estilo::getAllEstilos($conexion);

$idEstiloActual = $_SESSION['idEstilo'];
$columnaBuscada = "id";

$posicion = array_search($idEstiloActual, array_column($estilos, $columnaBuscada));

if ($posicion !== false) {
    $elementoEncontrado = array_splice($estilos, $posicion, 1);
    array_unshift($estilos, $elementoEncontrado[0]);
}

if (isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/cambiarEstiloPresentacion.css">
    <title>Document</title>
</head>
<body>
    <div class="crearPresentacion">
        <div class="contenido">
            <div class="tituloCrearPresentacion">
                <span>Cambiar Estilo</span>
            </div>
            <div class="contentFormulario">
                <div class="mostrarFormulario">
                    <form action="../controllers/cambiarEstiloController.php" method="post">
                        <label>Escoge el nuevo estilo</label>
                        <div id="errEstilo" class="errores">
                        <?php if (isset($errores["estilo"])): ?>
                            <p><?= $errores["estilo"]; ?></p>      
                        <?php endif; ?>
                    </div>
                        <div class="slider">
                            <button type="button" id="anterior" class="botones-estilos"><div class="Triangulo"></div></button>
                            <ul>
                                <?php foreach ($estilos as $estilo): ?>
                                    <li data="<?= $estilo['id']; ?>">
                                        <img src="img/estilosDipositivas/<?=$estilo["img_resource"]; ?>" alt="">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" id="siguiente" class="botones-estilos"></button>
                        </div>
                        <input type="hidden" id="id_estilo" name="id_estilo">
                        <button type="submit" class="botonCrear">Seleccionar Estilo</button>
                    </form>
                    <script src="javascript/cambiarEstiloPresentacion.js"></script>
                </div>
            </div>
        </div>
    </div>
</body>
</html>