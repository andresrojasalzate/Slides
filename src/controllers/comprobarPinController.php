<?php

use src\modelo\Clases\Presentacion;

require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';
session_start();


function procesarFormulario()
{
    $url = $_SESSION['url'];
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();
    $idPres = Presentacion::devolverPresentacionByURL($conexion, $url);
    $pinCorrecto = Presentacion::recuperarPinPresentacion($conexion, $idPres);
    $pinIntroducido = $_POST['pin'];
    $errores = [];

    if (empty($pinIntroducido)) {
        $errores['pin'] = "El PIN no puede estar vacio";
    }

    if ($pinCorrecto != $pinIntroducido) {
        $errores['pin'] = "El PIN introducio es incorrecto";
    }

    if (count($errores) > 0) {
        $_SESSION['errores'] = $errores;
        header("Location: ../vista/comprobarPin.php");
        exit;
    } else {
        header("Location: ../vista/vistaCliente.php?url=$url");
        exit;
    }
}

procesarFormulario();

