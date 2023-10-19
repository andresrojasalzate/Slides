<?php
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Presentacion;
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Presentacion;
require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';
session_start();

function isertarPresentacion($titulo, $descripcion){

    $presentacion = new Presentacion($titulo, $descripcion);
           
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();
    Presentacion::insertPresentacion($conexion, $presentacion);
    
    
    $idUltimaPresentacion = Presentacion::idUltimaPresentacion($conexion);
    $conexion = null;

    setcookie("id_ultima_presentacion", $idUltimaPresentacion, time() + 3600, "/");
    setcookie("nombrePresentacion", $titulo, time() + 3600, "/");

    
    header("Location: ../vista/crearDiapositiva.php");
}

function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $titulo = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $errores = [];
 
        if (empty($titulo)) {
            $errores['titulo'] = "El campo \"Titulo\" no puede estar vacío";
            
        }
        if(strlen($titulo) > 255){
            $errores['titulo'] = "El campo \"Titulo\" no puede tener más de 255 caracteres";
        } 

        if(strlen($descripcion) > 255){
            $errores['descripcion'] = "El campo \"Descripción\"  no puede tener más de 255 caracteres";
        }

        if(count($errores) > 0){
            
            $_SESSION['errores'] = $errores;
            $_SESSION['titulo'] = $titulo;
            $_SESSION['descripcion'] = $descripcion;
            header("Location: ../vista/crearPresentacion.php");
            
        } else{
            isertarPresentacion($titulo, $descripcion);
        }
    }
}

procesarFormulario();

