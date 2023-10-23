<?php
if (isset($_COOKIE['arrayDiapositivas'])) {
    $arrayCookie = $_COOKIE['arrayDiapositivas'];
    $arrayDiapositivas = unserialize($arrayCookie);
} else {
    $arrayDiapositivas = array(
        array(
            'idPresentacio' => 1,
            'numDiapositiva' => 1,
            'tipo' => 'A',
            'contenido' => 'hola'
        ),
        array(
            'idPresentacio' => 2,
            'numDiapositiva' => 2,
            'tipo' => 'B',
            'contenido' => 'aaaa'
        ),
        array(
            'idPresentacio' => 3,
            'numDiapositiva' => 3,
            'tipo' => 'A',
            'contenido' => 'adeu'
        )
    );
}

$posicion = isset($_POST['posicion']) ? $_POST['posicion'] : 0;

if (isset($_POST['sumar'])) {
    $posicion = ($posicion + 1) % count($arrayDiapositivas);
} elseif (isset($_POST['restar'])) { 
    $posicion = ($posicion - 1 + count($arrayDiapositivas)) % count($arrayDiapositivas);
}

// Guardar la posición actual en una cookie para recordarla
setcookie('arrayDiapositivas', serialize($arrayDiapositivas), time() + 3600);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/vista/estilos/visualizarDiapositiva.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Diapositiva</title>
</head>

<body>
    <div class="visualizarDiapositiva">
        <div class="contenido">
            <div class="titulo">
                <form method="post" class="formTitulo">
                    <div class="esquerra">
                <?php if ($arrayDiapositivas[$posicion]['numDiapositiva']!== 1) { ?>
                    <input class="btn" type="submit" name="restar" value="<">
                    <?php } ?>
                    </div>
                    <span>Titulo diapositiva</span>
                    <input type="hidden" name="posicion" value="<?php echo $posicion; ?>">
                    <div class="dreta">
                    <?php if ($arrayDiapositivas[$posicion]['numDiapositiva'] !== count($arrayDiapositivas)) { ?>
                        <input class="btn" type="submit" name="sumar" value=">">
                    <?php } ?>
                    </div>
                </form>
            </div>
            <?php if ($arrayDiapositivas[$posicion]['tipo'] !== 'B') { ?>
                <div class="contentDiapositiva">

                    <div class="mostrarDiapositiva">
                        <label for="contenido" id="contenidoLabel">
                            <?php echo $arrayDiapositivas[$posicion]['contenido']; ?>
                        </label>
                    </div>

                </div>
            <?php } ?>
            <form action="home.php">
            <button class="btnSalir">Salir</button>
            </form>
        </div>
    </div>
</body>

</html>