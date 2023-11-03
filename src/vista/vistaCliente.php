<?php
include '../controllers/vistaClienteController.php';

if(isset($_SESSION['vistaDiapositivas'][$posDiapo]['imagen'])){
    $rutaImg = "img/" . $_SESSION['vistaDiapositivas'][$posDiapo]['presentaciones_id'] . "/" . $_SESSION['vistaDiapositivas'][$posDiapo]['imagen'];
}else{
    $rutaImg = "a";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/vista/estilos/visualizarDiapositiva.css">
    <link rel="stylesheet" href="/vista/estilos/<?= $_SESSION['estilo'][0]['css_resource'] ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>vista cliente</title>
</head>

<body>
    <div class="visualizarDiapositiva">
        <div class="contenedor">
            <div class="titulo">
                <form method="POST" class="formTitulo">
                    <div class="esquerra">
                        <?php if ($_SESSION['vistaDiapositivas'][$posDiapo]['nDiapositiva'] !== 1) : ?>
                            <input class="btn" type="submit" name="restar" value="<">
                        <?php endif; ?>
                    </div>
                    <span>
                        <?= $_SESSION['vistaDiapositivas'][$posDiapo]['titulo']; ?>
                    </span>
                    <input type="hidden" name="posicion" value="<?php echo $posDiapo; ?>">
                    <div class="dreta">
                        <?php if ($_SESSION['vistaDiapositivas'][$posDiapo]['nDiapositiva'] !== count($_SESSION['vistaDiapositivas'])) : ?>
                            <input class="btn" type="submit" name="sumar" value=">">
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <?php if ($_SESSION['vistaDiapositivas'][$posDiapo]['tipoDiapositiva'] == 'tituloContenido' || $_SESSION['vistaDiapositivas'][$posDiapo]['tipoDiapositiva'] == 'contenido') : ?>
                <div class="contenido">
                    <div class="mostrarDiapositiva">
                        <label for="contenido" id="contenidoLabel">
                            <?php echo nl2br($_SESSION['vistaDiapositivas'][$posDiapo]['contenido']); ?>
                        </label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($_SESSION['vistaDiapositivas'][$posDiapo]['tipoDiapositiva'] == 'imagen') { ?>

                <div class="mostrarDiapositiva">
                    <label for="contenido" id="contenidoLabel">
                        <!-- nl2br convierte los /n en <br> -->
                        <img src="<?php echo $rutaImg ?>" alt="Imagen" class="imagen">
                    </label>
                </div>

            <?php } ?>
        </div>
    </div>
</body>

</html>