<?php
session_start();

$estilos = $_SESSION['estilos'];

$titulo = "";
$descripcion = "";
if (isset($_SESSION['errores'])) {

    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);

    $titulo = $_SESSION['titulo'];
    unset($_SESSION['titulo']);

    $descripcion = $_SESSION['descripcion'];
    unset($_SESSION['descripcion']);

    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/vista/estilos/crearPresentacion.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Crear Presentación</title>
</head>
<body>
    <div class="crearPresentacion">
        <div class="contenido">
            <div class="tituloCrearPresentacion">
                <span>Nueva Presentaciones</span>
            </div>
            <div class="contentFormulario">
                <div class="mostrarFormulario">
                    <form id="crearPresentacion" action="../controllers/crearPresentacionController.php" method="post">
                    <label for="nombre">Titulo</label>
                    <div id="errNombre" class="errores">
                        <?php if (isset($errores["titulo"])): ?>
                            <p><?= $errores["titulo"]; ?></p>      
                        <?php endif; ?>
                    </div>
                    <input type="text" id="nombre" name="nombre" placeholder="Dale nombre a tu presentación" value="<?= $titulo; ?>" required><br>
                    <label for="descripcion">Descripción</label>
                    <div id="errDescripcion" class="errores">
                         <?php if (isset($errores["descripcion"])): ?>
                            <p><?= $errores["descripcion"]; ?></p>     
                        <?php endif; ?>
                    </div>
                    <textarea id="descripcion" name="descripcion" placeholder="¿De que será tu presentacion?" value="<?= $descripcion; ?>"></textarea><br>
                    <label for="estilo">Estilo</label>
                    <div id="errEstilo" class="errores">
                        <?php if (isset($errores["estilo"])): ?>
                            <p><?= $errores["estilo"]; ?></p>      
                        <?php endif; ?>
                    </div>
                    <div class="slider">
                        <button type="button" id="anterior" class="botones-estilos">Anterior</button>
                        <ul>
                            <?php foreach ($estilos as $estilo): ?>
                                <li data="<?= $estilo['id']; ?>">
                                    <img src="img/estilosDipositivas/<?=$estilo["img_resource"]; ?>" alt="">
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" id="siguiente" class="botones-estilos">Siguiente</button>
                    </div>
                    <input type="hidden" id="id_estilo" name="id_estilo">
                    <button type="submit" class="botonCrear">Crear Presentación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/vista/javascript/crearPresentacion.js"></script>
</body>
</html>