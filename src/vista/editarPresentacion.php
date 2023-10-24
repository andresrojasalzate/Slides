<?php
use src\modelo\Clases\Presentacion;
session_start();

require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';


if (isset($_COOKIE["id_ultima_presentacion"])) {
    $idUltimaPresentacion = $_COOKIE["id_ultima_presentacion"];
}else{}

$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();

$resultado = Presentacion::devolverPresentacion($conexion,$idUltimaPresentacion);

$nombrePresentacion = $resultado[0]['nombre'];
$descripcion = $resultado[0]['descripcion'];
$id = $resultado[0]['id'];

setcookie("id_ultima_presentacion", $idUltimaPresentacion, time() + 3600, "/");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/editarPresentacion.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Editar Presentación</title>
</head>

<body>
    <div class="home">
        <div class="pantallaEditar">
            <div class="tituloEditarPresentaciones">
                <span>Editar Presentación</span>
            </div>
            <div class="edicion">
                <div class="datosPresentacion">
                    <form>
                        <label>Titulo</label>
                        <input class="titulo" type="text" value="<?=$nombrePresentacion ?>">
                        <label>Descripción</label>
                        <input class="descripcion" type="text" value="<?=$descripcion?>">
                        <div class="botonesEdicionPresentacion">
                            <button class="botonCrear" name="btnNuevaDiapositiva" value="<?=$id?>">Nueva Diapositiva</button>
                            <button class="botonCrear">Cambiar Estilo</button>
                        </div>
                        <button class="botonCrear" type="submit">Guardar Cambios</button>
                        <button class="botonCrear" name="btnVolver" type="submit">Volver</button>
                    </form>
                </div>
                <div class="contenedorDiapositivas"></div>
            </div>
        </div>
    </div>
    <script src="javascript/editarPresentacion.js"></script>
</body>

</html>