<?php
    session_start();
    
    require_once '../modelo/Clases/Presentacion.php';
    require_once '../modelo/Clases/DiapositivaTituloContenido.php';
    require_once '../modelo/Clases/DiapositivaTitulo.php';

    $presentacion = new Presentacion($_SESSION['nombre'],$_SESSION['descripcion']);
    

    if(isset($_GET['tituloDiapo']) &&($_GET['tituloDiapo']!=null && $_GET['tituloDiapo']!="")){
        if($_GET['tipoDiapo']=='contenido'){
            $titulo = $_GET['tituloDiapo'];
            $tipo = $_GET['tipoDiapo'];
            $contenido = $_GET['contenidoDiapo'];
            $nuevaDiapositiva = new DiapositivaTituloContenido($titulo,$tipo,$contenido);
        }
        else{
            $titulo = $_GET['tituloDiapo'];
            $tipo = $_GET['tipoDiapo'];
            $nuevaDiapositiva = new DiapositivaTitulo($titulo,$tipo);
        }
        $presentacion->setDiapositivas($nuevaDiapositiva );
        var_dump($presentacion);
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos/crearDiapositiva.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
   <title>Crear Diapositiva</title>
</head>

<body>
    <form>
        <h1>Nueva Diapositiva</h1>
        <div>
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
                    <input class="titulo" type="text" id="tituloDiapo" name="tituloDiapo" placeholder="Titulo de tu Diapositiva" required>
                </div>
                <div class="divOculto divFormColumn">
                    <label for="contenidoDiapo">Contenido</label>
                    <input class="inputCont" type="text" id="contenidoDiapo" name="contenidoDiapo" placeholder="Empieza aqui..." required>
                </div>
            </div>
            <div class="divBotonCrear">
                <button class="botonCrear" type="submit">Crear Diapositiva</button>
            </div>
        </div>
    </form>
</body>
<script src="crearDiapositiva.js"></script>
</html>