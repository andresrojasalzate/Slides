<?php
use ConexionBD;
use src\modelo\Clases\Presentacion;

require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';

session_start();

function cambiarEstilo($estilo){

    $idPresentacion = $_SESSION['idPresentacion'];
    unset($_SESSION['idPresentacion']);
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();

    Presentacion::cambiarEstiloPresentacion($conexion, $estilo, $idPresentacion);
}

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estiloId = $_POST['id_estilo'];
    $errores = [];

    if((!is_numeric($estiloId))){
        $errores['estilo'] = "Ha habido un error al seleccionar el estilo. Vuelva a intentarlo";
    }

    if(count($errores) > 0){
        $_SESSION['errores'] = $errores;
        header("Location: ../vista/cambiarEstiloPresentacion.php");
        exit;
    } else{
        unset($_SESSION['idEstilo']);
        cambiarEstilo($estiloId);
        header("Location: ../vista/editarPresentacion.php");
        exit;
    }
 }