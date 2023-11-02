<?php

use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\Estilo;
use src\modelo\Clases\Presentacion;

require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Presentacion.php';
require_once '../modelo/Clases/Diapositiva.php';
require_once '../modelo/Clases/Estilo.php';


if (isset($_COOKIE['arrayDiapositivas'])) {
    $arrayCookie = $_COOKIE['arrayDiapositivas'];
    $arrayDiapositivas = json_decode($arrayCookie, true);
} else {
}

if (isset($_COOKIE['idEstilo'])) {
    $estilo = $_COOKIE['idEstilo'];
}
if (isset($_COOKIE['1diapo'])) {
    $diapoSola = $_COOKIE['1diapo'];
} else {
    $diapoSola = false;
}


$posicion = isset($_POST['posicion']) ? $_POST['posicion'] : 0;


if (isset($_POST['sumar'])) {
    $posicion = ($posicion + 1) % count($arrayDiapositivas);
} elseif (isset($_POST['restar'])) {
    $posicion = ($posicion - 1 + count($arrayDiapositivas)) % count($arrayDiapositivas);
}

// Guardar la posición actual en una cookie para recordarla
/*setcookie('arrayDiapositivas', json_encode($arrayDiapositivas), time() + 3600);*/

$rutaImg = "img/" . $arrayDiapositivas[$posicion]['presentaciones_id'] . "/" . $arrayDiapositivas[$posicion]['imagen'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/vista/estilos/visualizarDiapositiva.css">
    <link rel="stylesheet" href="/vista/estilos/<?= $estilo; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Diapositiva</title>
</head>

<body>
    <div class="visualizarDiapositiva">
        <div class="contenedor">
            <div class="titulo">
                <form method="post" class="formTitulo">
                    <div class="esquerra">
                        <?php if ($arrayDiapositivas[$posicion]['nDiapositiva'] !== 1) { ?>
                            <input class="btn" type="submit" name="restar" value="<">
                        <?php } ?>
                    </div>
                    <span>
                        <?php echo $arrayDiapositivas[$posicion]['titulo']; ?>
                    </span>
                    <input type="hidden" name="posicion" value="<?php echo $posicion; ?>">
                    <div class="dreta">
                        <?php if ($arrayDiapositivas[$posicion]['nDiapositiva'] !== count($arrayDiapositivas)) { ?>
                            <input class="btn" type="submit" name="sumar" value=">">
                        <?php } ?>
                    </div>
                </form>
            </div>
            <?php if ($arrayDiapositivas[$posicion]['tipoDiapositiva'] == 'tituloContenido' || $arrayDiapositivas[$posicion]['tipoDiapositiva'] == 'contenido') { ?>
                <div class="contenido">

                    <div class="mostrarDiapositiva">
                        <label for="contenido" id="contenidoLabel">
                            <!-- nl2br convierte los /n en <br> -->
                            <?php echo nl2br($arrayDiapositivas[$posicion]['contenido']); ?>
                        </label>
                    </div>

                </div>
            <?php } ?>
            <?php if ($arrayDiapositivas[$posicion]['tipoDiapositiva'] == 'imagen') { ?>

                <div class="mostrarDiapositiva">
                    <label for="contenido" id="contenidoLabel">
                        <!-- nl2br convierte los /n en <br> -->
                        <img src="<?php echo $rutaImg ?>" alt="Imagen" class="imagen">
                    </label>
                </div>

            <?php } ?>
            <div class="boton-salir-container">
                <?php if ($diapoSola == 'home') { ?>
                    <form action="home.php">
                        <button class="btnSalir">Salir</button>
                    </form>
                <?php } elseif ($diapoSola == 'crearDiapo') { ?>
                    <form action="crearDiapositiva.php" method="post">
                        <input type="hidden" name="titulo"
                            value="<?= htmlspecialchars($arrayDiapositivas[$posicion]['titulo']); ?>">
                        <input type="hidden" name="contenido"
                            value="<?= htmlspecialchars($arrayDiapositivas[$posicion]['contenido']); ?>">
                        <input type="hidden" name="tipoDiapo"
                            value=<?= htmlspecialchars($arrayDiapositivas[$posicion]['tipoDiapositiva']); ?>>
                        <input type="hidden" name="imagen"
                            value=<?= htmlspecialchars($arrayDiapositivas[$posicion]['imagen']); ?>>
                        <button class="btnSalir">Salir</button>
                    </form>
                <?php } elseif ($diapoSola == 'editarPres') { ?>
                    <form action="editarPresentacion.php">
                        <button class="btnSalir">Salir</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>