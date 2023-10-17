<?php
namespace src\vista;
session_start();

require_once '../modelo/Clases/Presentacion.php';

//Almacenar presentaciones desde la BD
/*$presentaciones = [
    ['nombre'=> "pres 1",'diapositivas'=>[1,2,3]],
    ['nombre'=> "pres 2",'diapositivas'=>[1,2,3,4,5,6]],
    ['nombre'=> "pres 3",'diapositivas'=>[1,2,3,4,5]],
    ['nombre'=> "pres 4",'diapositivas'=>[1]],
    ['nombre'=> "pres 5",'diapositivas'=>[1,2]],
    ['nombre'=> "pres 6",'diapositivas'=>[1,2]],
    ['nombre'=> "pres 7",'diapositivas'=>[1,2]],
    ['nombre'=> "pres 8",'diapositivas'=>[1,2]],
    ['nombre'=> "pres 9",'diapositivas'=>[1,2]],
    ['nombre'=> "pres 10",'diapositivas'=>[1,2]],
    ['nombre'=> "pres 11",'diapositivas'=>[1,2]]
];*/

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
        <input type="text" id="nombre" name="nombre" ><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>
        
        <div class="containerDreta">
            <button type="submit" class="botonCrear">Crear</button>
        </div>
        
    </div>
    </form>
</body>

</html>