<?php
require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';

function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $titulo = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
 
        if (empty($titulo) || empty($descripcion)) {
          
        } else {
            $presentacion = new Presentacion($titulo, $descripcion);
           
            $bdConexion = ConexionBD::obtenerInstancia();
            $conexion = $bdConexion->getConnection();
            Presentacion::insertPresentacion($conexion, $presentacion);

            $idUltimaPresentacion = Presentacion::idUltimaPresentacion($conexion);
            header("Location: ../vista/crearDiapositiva.php?id={$idUltimaPresentacion}");
        }
    }

    
}

procesarFormulario();

include('../vista/crearPresentacion.php');