<?php
    session_start();
    
    require_once '../modelo/Clases/Presentacion.php';
    require_once '../modelo/Clases/DiapositivaTituloContenido.php';
    require_once '../modelo/Clases/DiapositivaTitulo.php';

    $idUltimaPresentacion = $_GET['id'];

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
    <link rel="stylesheet" type="text/css" href="estilos/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
   <title>Nueva Diapositiva</title>
</head>

<body>
    <form action="../controllers/crearDiapositivaController.php?id=<?php echo $idUltimaPresentacion; ?>" method="post">
        <div class="divContenedor">
            <div class="divContenForm">
                <label for="tituloDiapo">Titulo</label>
                <input type="text" id="tituloDiapo" name="tituloDiapo" placeholder="Titulo de tu Diapositiva" required>
                <label for="contenidoDiapo">Contenido</label>
                <textarea id="contenidoDiapo" name="contenidoDiapo" placeholder="Empieza aqui..."></textarea>
            </div>
            <div class="divContenForm">
                <p class="subtitulos">Tipo de diapositiva</p>
                <div>
                    <input type="radio" id="tipoTitulo" name="tipoDiapo" value="titulo">
                    <label for="tipoTitulo">Titulo</label><br>
                </div>
                <div>
                    <input type="radio" id="tipoTituloCont" name="tipoDiapo" value="contenido">
                    <label for="tipoTituloCont">Titulo + contenido</label>
                </div>
            </div>
        </div>
        <div>
            <button class="botonCrear" type="submit">Crear Diapositiva</button>
        </div>
    </form>
</body>

</html>