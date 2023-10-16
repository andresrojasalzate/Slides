<?php
session_start();

require_once '../modelo/Clases/Presentacion.php';

if (isset($_GET['nombre']) && ($_GET['nombre'] != null && $_GET['nombre'] != "")) {
    $nombre = $_GET['nombre'];
    $descripcion = $_GET['descripcion'];
    $_SESSION = (['nombre' => $nombre, 'descripcion' => $descripcion]);
    header('Location:crearDiapositiva.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear presentación</title>
    <link rel="stylesheet" type="text/css" href="estilos/style.css">
</head>

<body>
    <form action="../controllers/crearPresentacionController.php" method="post">
    <div class="divContenForm">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>
        
        <div class="containerDreta">
            <button type="submit" class="botonCrear">Crear</button>
        </div>
    </div>
    </form>
</body>

</html>