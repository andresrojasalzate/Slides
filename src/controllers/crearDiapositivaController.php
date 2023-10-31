<?php
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\DiapositivaImagen;
use src\modelo\Clases\DiapositivaTitulo;
use src\modelo\Clases\DiapositivaTituloContenido;

require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Diapositiva.php';
require_once '../modelo/Clases/DiapositivaTitulo.php';
require_once '../modelo/Clases/DiapositivaTituloContenido.php';
require_once '../modelo/Clases/DiapositivaImagen.php';


function procesarFormulario()
{
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titulo = $_POST['tituloDiapo'];
        $descripcion = $_POST['contenidoDiapo'];
        $tipo = $_POST['tipoDiapo'];

        $idUltimaPresentacion = $_SESSION["id_ultima_presentacion"];
        if (empty($titulo)) {

        } else {
            $bdConexion = ConexionBD::obtenerInstancia();
            $conexion = $bdConexion->getConnection();
            $nDiapositiva = Diapositiva::nDiapositivas($conexion, $idUltimaPresentacion) + 1;
            if ($tipo === 'titulo') {
                $diapositiva = new DiapositivaTitulo($titulo, "titulo", $idUltimaPresentacion, $nDiapositiva);

                DiapositivaTitulo::insertDiapositivaTitulo($conexion, $diapositiva);
                $conexion = null;

                $_SESSION['toast'] = true;
                header("Location: ../vista/crearDiapositiva.php");

            } elseif ($tipo === 'contenido') {
                $diapositiva = new DiapositivaTituloContenido($titulo, 'tituloContenido', $descripcion, $idUltimaPresentacion, $nDiapositiva);

                DiapositivaTituloContenido::insertDiapositivaTituloYContenido($conexion, $diapositiva);
                $conexion = null;
                $_SESSION['toast'] = true;

                header("Location: ../vista/crearDiapositiva.php");
            } elseif ($tipo === 'imagen') {
                $nombreImagen = $_POST['nombreImagen'] . '.png';
                $nombreImagen = str_replace(' ', '_', $nombreImagen);
                //$imagen = $_FILES["imagen"]["name"];
                $url_temp = $_FILES["imagen"]["tmp_name"];
                $url_insert = dirname(__FILE__) . "/../vista/img/" . $idUltimaPresentacion;
                $url_target = str_replace('\\', '/', $url_insert) . '/' . $nombreImagen;
                if (!file_exists($url_insert)) {
                    mkdir($url_insert, 0777, true);
                }
                $cont = 0;
                while (file_exists($url_target)) {
                    $url_target = str_replace('\\', '/', $url_insert) . '/' . $cont . $nombreImagen;
                    $cont++;
                }
                if($cont>0){
                    $nombreImagen = $cont-1 . $nombreImagen;
                }

                if (move_uploaded_file($url_temp, $url_target)) {

                } else {
                }


                $diapositiva = new DiapositivaImagen($titulo, 'imagen', $idUltimaPresentacion, $nDiapositiva, $nombreImagen);

                DiapositivaImagen::insertDiapositivaImagen($conexion, $diapositiva);
                $conexion = null;
                $_SESSION['toast'] = true;
                header("Location: ../vista/crearDiapositiva.php");

            } else {
            }



        }
    }


}

procesarFormulario();

