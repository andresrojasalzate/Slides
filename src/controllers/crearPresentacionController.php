<?php
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Presentacion;
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Presentacion;
require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';

function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $titulo = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
 
        if (empty($titulo)) {
            
            header("Location: ../vista/crearPresentacion.php");
        } else {
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
    }

    
}

procesarFormulario();

include('../vista/crearPresentacion.php');