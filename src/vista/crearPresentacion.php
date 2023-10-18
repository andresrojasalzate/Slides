<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/crearPresentacion.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Crear Presentación</title>
</head>
<body>
    <div class="cabecera">
        <div class="bienvenida">
            <span>Hola Ususario</span>
        </div>
    </div>
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

                    </div>
                     <input type="text" class="introducirTexto"id="nombre" name="nombre" placeholder="Dale nombre a tu presentación" required><br>
                    <label for="descripcion">Descripción</label>
                    <div id="errDescripcion" class="errores">

                    </div>
                    <textarea class="introducirTexto" id="descripcion" name="descripcion" placeholder="¿De que será tu presentacion?"></textarea><br>

                    <button type="submit" class="botonCrear">Crear Presentación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="javascript/crearPresentacion.js"></script>
</body>
</html>