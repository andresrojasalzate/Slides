<?php
session_start();
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
    }else{
        unset($_SESSION['idEstilo']);
        $_SESSION['nuevoEstilo'] = $estiloId; 
        header("Location: ../vista/editarPresentacion.php");
        exit;
    }
 }