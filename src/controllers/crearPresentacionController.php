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

//Funcion que crea el nombreURL de cada presentacion

function crearNombreURL($titulo){
    $nameURL = str_replace(" ", "_", strtolower(trim($titulo)));
    $length = strlen($nameURL);
    $nameURL .= "_" . $length;
    return $nameURL;
}

/**
 * Funcion que llama a la funcion de insertar de la clase Prersentacion
 * @param $titulo titulo de la prsentación
 * @param $descripcion descripcion
 */
function isertarPresentacion($titulo, $descripcion, $idEstilo, $nombreURL, $pin){
    
    $presentacion = new Presentacion($titulo, $descripcion, $idEstilo, $nombreURL, $pin);
           
            $bdConexion = ConexionBD::obtenerInstancia();
            $conexion = $bdConexion->getConnection();
            Presentacion::insertPresentacion($conexion, $presentacion);
            
            
            $pres = Presentacion::idUltimaPresentacion($conexion);
            setcookie("id_ultima_presentacion", $pres, time() + 3600, "/");
            $estilo = Estilo::getEstilo($conexion,$idEstilo);
            foreach ($estilo as $fila) {
                $cssResource = $fila['css_resource'];
                
            }
            setcookie("idEstilo", $cssResource, time() + 3600, "/");
            $_SESSION["id_ultima_presentacion"] = $pres;


            $conexion = null;


    
    header("Location: ../vista/crearDiapositiva.php");
}

/**
 * Funcion que valida los datos recibidos por formulario de crear presentación.
 */
function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $idEstilo = $_POST['id_estilo'];
        $nombreURL = crearNombreURL($titulo);
        $pin = $_POST['pin'];
        $repPin = $_POST['rep_pin'];
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

        if($pin != $repPin){

            $errores['pin'] = "Los PINS no coinciden";
        }

        if(strlen($pin) > 50){
            $errores['pin'] = "El PIN no puede tener más de 50 caracteres";
        }

        if(count($errores) > 0){
            
            $_SESSION['errores'] = $errores;
            $_SESSION['titulo'] = $titulo;
            $_SESSION['descripcion'] = $descripcion;
            header("Location: ../vista/crearPresentacion.php");
            
        } else{

            $numEstiloId = intval($idEstilo);
            isertarPresentacion($titulo, $descripcion, $numEstiloId,$nombreURL, $pin);

        }
    }
}

procesarFormulario();
