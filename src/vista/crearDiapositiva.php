<?php
session_start();

require_once '../modelo/Clases/Presentacion.php';

//Almacenar presentaciones desde la BD
$presentaciones = [
    /*
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
['nombre'=> "pres 11",'diapositivas'=>[1,2]]*/
];

if (isset($_GET['nombre']) && ($_GET['nombre'] != null && $_GET['nombre'] != "")) {
    $nombre = $_GET['nombre'];
    $descripcion = $_GET['descripcion'];
    $_SESSION = (['nombre' => $nombre, 'descripcion' => $descripcion]);
    header('Location:crearDiapositiva.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/crearDiapositiva.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>

<body>
    <div class="cabecera">
        <div class="bienvenida">
            <span>Hola Ususario</span>
        </div>
    </div>
    <div class="crearDiapositiva">
        <div class="fondoLila">
            <div class="tiutlo">
                <span>Nueva Diapositiva</span>
            </div>

            <div class="contentCrearDiapositivas">
                <form action="../controllers/crearDiapositivaController.php" method="post">
                    <fieldset class="divFormRow">
                        <legend class="subtitulos">Tipo de diapositiva</legend>
                        <div>
                            <input type="radio" id="tipoTitulo" name="tipoDiapo" value="titulo" checked>
                            <label for="tipoTitulo">Titulo</label><br>
                        </div>
                        <div>
                            <input type="radio" id="tipoTituloCont" name="tipoDiapo" value="contenido">
                            <label for="tipoTituloCont">Titulo y contenido</label>
                        </div>
                    </fieldset>
                    <div>
                        <div class="divFormColumn">
                            <label for="tituloDiapo">Titulo</label>
                            <input class="titulo" type="text" id="tituloDiapo" name="tituloDiapo"
                                placeholder="Titulo de tu Diapositiva" required>
                        </div>
                        <div class="divOculto divFormColumn">
                            <label for="contenidoDiapo">Contenido</label>
                            <input class="inputCont" type="text" id="contenidoDiapo" name="contenidoDiapo"
                                placeholder="Empieza aqui...">
                        </div>
                    </div>
                    <div class="botonNuevaDiapositiva">
                        <form action="crearPresentacion.php">
                            <button class="botonCrear" type="submit">Crear</button>
                        </form>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
<script src="crearDiapositiva.js"></script>

</html>