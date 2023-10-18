<?php

use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\Presentacion;

session_start();
require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Presentacion.php';
require_once '../modelo/Clases/Diapositiva.php';

//Almacenar presentaciones desde la BD para mostrarlas en la pantalla home
$presentaciones = [];
$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();
$presentaciones = Presentacion::devolverPresentaciones($conexion);

$diapositivas=[];
$diapositivas=Diapositiva::devolverDiapositivas($conexion);

foreach ($presentaciones  as &$value) {
    $i = array_search($value['id'],array_column($diapositivas,'id'));
    if($i!==false){
        $value+= ['nroDiapositivas'=>$diapositivas[$i]['totalDiapositivas']];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <div class="cabecera">
        <div class="bienvenida">
            <span>Hola Ususario</span>
        </div>
    </div>
    <div class="home">
        <div class="presentaciones">
            <div class="tituloContentPresentaciones">
                <span>Presentaciones</span>
            </div>
            <div class="contentPresentaciones">
                <div class="mostrarPresentaciones">
                    <?php if(count($presentaciones)>0): ?>
                        <?php foreach ($presentaciones as $presentacion): ?>
                            <div class="presentacionBD">
                                <div class="titulo"><span><?=$presentacion['nombre']?></span></div>
                                <div class="nroDiapositivas"><span>Diapositivas:<?=$presentacion['nroDiapositivas'];?></span></div>
                                <div class="opciones">
                                    <button><span class="material-symbols-outlined">edit</span></button>
                                    <button><span class="material-symbols-outlined">delete</span></button>
                                    <button><span class="material-symbols-outlined">content_copy</span></button>
                                    <button class="botonOpc"><span class="material-symbols-outlined">visibility</span></button>
                                </div>
                            </div>   
                        <?php endforeach; ?> 
                    <?php endif; ?>    
                </div>
                <div class="botonNuevaPresentacion">
                    <form action="crearPresentacion.php">
                        <button class="botonCrear" type="submit">Nueva Presentación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>