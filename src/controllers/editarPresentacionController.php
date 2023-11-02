<?php


namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\Presentacion;

require_once '../modelo/Clases/Presentacion.php';
require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Diapositiva.php';
session_start();

/**
 * Funcion que llama a la funcion de insertar de la clase Prersentacion
 * @param $titulo titulo de la prsentación
 * @param $descripcion descripcion
 */

// Funcion para inicializar el orden nuevo cuando no viene en el formulario
function esNuevoOrdenVacio()
{
    if (!isset($_POST['ordenNuevoDiapositivas'])) {
        return null;
    } else {
        return $_POST['ordenNuevoDiapositivas'];
    }
}

// Funcion para inicializar la vista cliente cuando no viene en el formulario
function esVistaClienteVacio()
{
    if (!isset($_POST['vista_cliente'])) {
        return 0;
    } else {
        return $_POST['vista_cliente'];
    }
}

// Funcion para reordenar las diapositivas
function reordenarDiapositivas($ordenOriginal, $nuevoOrden)
{
    if ($nuevoOrden === null) {
        $nuevoOrden = $ordenOriginal;
    }
    else{
        $arrayNuevoOrden = json_decode($nuevoOrden);
        $arrayOrdenOriginal = json_decode($ordenOriginal);
        if (array_values($arrayOrdenOriginal) !== array_values($arrayNuevoOrden)) {
            $bdConexion = ConexionBD::obtenerInstancia();
            $conexion = $bdConexion->getConnection();
            for ($i = 0; $i < count($arrayNuevoOrden); $i++) {
                Diapositiva::reordenarDiapositivas($conexion, $arrayNuevoOrden[$i], (array_search($arrayNuevoOrden[$i], $arrayNuevoOrden) + 1));
            }
            $conexion = null;
        }
    }
}

// funcion que modifica el titulo y descripcion de la presentación
function editarPresentacion($id, $titulo, $descripcion, $vistaCliente)
{

    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();
    $respuesta = Presentacion::actualizarPresentacion($conexion, $id, $titulo, $descripcion, $vistaCliente);
    $conexion = null;
    return $respuesta;
}

/**
 * Funcion que valida los datos recibidos por formulario de crear presentación.
 */
function procesarFormulario()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $titulo = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $ordenOriginal = $_POST['ordenOriginalDiapositivas'];
        $nuevoOrden = esNuevoOrdenVacio();
        $vistaCliente = esVistaClienteVacio();
        $nuevoOrden = esNuevoOrdenVacio();
        $vistaCliente = esVistaClienteVacio();
        $errores = [];

        if (empty($titulo)) {
            $errores['titulo'] = "El campo \"Titulo\" no puede estar vacío";
        }
        if (strlen($titulo) > 255) {
            $errores['titulo'] = "El campo \"Titulo\" no puede tener más de 255 caracteres";
        }
        if (strlen($descripcion) > 255) {
            $errores['descripcion'] = "El campo \"Descripción\"  no puede tener más de 255 caracteres";
        }

        if (count($errores) > 0) {

            $_SESSION['errores'] = $errores;
            $_SESSION['titulo'] = $titulo;
            $_SESSION['descripcion'] = $descripcion;


            //header("Location: ../vista/crearPresentacion.php");

        } else {
            $_SESSION['confirmacion'] = editarPresentacion($id, $titulo, $descripcion, $vistaCliente);
            reordenarDiapositivas($ordenOriginal, $nuevoOrden);

        }  reordenarDiapositivas($ordenOriginal, $nuevoOrden);
        header("Location: ../vista/editarPresentacion.php");
    }
}
procesarFormulario();
