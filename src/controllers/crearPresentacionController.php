<?php
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Presentacion;
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Presentacion;
use src\modelo\Clases\Estilo;
require_once '../modelo/Clases/Presentacion.php';
require_once '../modelo/Clases/Estilo.php';
require_once '../config/ConexionBD.php';
session_start();

function inicioPagina(){
    
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();
    $estilos = Estilo::getAllEstilos($conexion);

    $_SESSION['estilos'] = $estilos;
    header("Location: ../vista/crearPresentacion.php");
}

inicioPagina();

/**
 * Funcion que llama a la funcion de insertar de la clase Prersentacion
 * @param $titulo titulo de la prsentación
 * @param $descripcion descripcion
 */
function isertarPresentacion($titulo, $descripcion, $idEstilo){
    
    $presentacion = new Presentacion($titulo, $descripcion, $idEstilo);
           
            $bdConexion = ConexionBD::obtenerInstancia();
            $conexion = $bdConexion->getConnection();
            Presentacion::insertPresentacion($conexion, $presentacion);
            
            
            $conexion = null;


    
    header("Location: ../vista/home.php");
}

/**
 * Funcion que valida los datos recibidos por formulario de crear presentación.
 */
function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $titulo = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $idEstilo = $_POST['id_estilo'];
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
        if((!is_numeric($idEstilo))){
            $errores['estilo'] = "Ha habido un error al seleccionar el estilo. Vuelva a intentarlo";
        }

        if(count($errores) > 0){
            
            $_SESSION['errores'] = $errores;
            $_SESSION['titulo'] = $titulo;
            $_SESSION['descripcion'] = $descripcion;
            header("Location: ../vista/crearPresentacion.php");
            
        } else{

            $numEstiloId = intval($idEstilo);
            isertarPresentacion($titulo, $descripcion, $numEstiloId);

        }
    }
}

procesarFormulario();

