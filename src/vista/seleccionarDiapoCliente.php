<?php
use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\Presentacion;

include '../controllers/vistaClienteController.php';


$diapositivas = Diapositiva::arrayDiapositivas($conexion, $idPres['id']);
$pres = Presentacion::devolverPresentacion($conexion, $idPres['id']);
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
                <span><?php echo $pres[0]['nombre']; ?></span>
            </div>
            <div class="contentPresentaciones">
                <div class="mostrarPresentaciones">
                    <?php if (count($diapositivas) > 0): ?>
                        <?php foreach ($diapositivas as $diapositiva): ?>
                            <div class="presentacionBD" draggable="true" id="<?= $diapositiva['id'] ?>"
                                data-text="<?= ($diapositiva['contenido'] !== null) ? $diapositiva['contenido'] : 'no hay contenido' ?>">
                                <div class="tituloDiapo"><span>
                                        <?= $diapositiva['titulo'] ?>
                                    </span></div>
                                <div class="tituloDiapo"><span>
                                        <?= substr($diapositiva['contenido'], 0, 10).'...' ?>
                                    </span></div>
                                <div class="opciones">
                                <div class="tituloDiapo"><span><?= $diapositiva['tipoDiapositiva'] ?></span></div>
                                    <button class="vDiapo material-symbols-outlined" nDiapo="<?= $diapositiva['nDiapositiva'] ?>">visibility</button>
                                    
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="mensajeCeroDiapositivas">Aún no hay diapositivas</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../vista/javascript/seleccionarDiapoCliente.js"></script>
</body>

</html>