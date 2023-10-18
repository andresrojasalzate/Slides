<?php
namespace src\controllers;

use ConexionBD;
use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\DiapositivaTitulo;
use src\modelo\Clases\DiapositivaTituloContenido;

require_once '../config/ConexionBD.php';
require_once '../modelo\Clases\Diapositiva.php';
require_once '../modelo\Clases\DiapositivaTitulo.php';
require_once '../modelo\Clases\DiapositivaTituloContenido.php';

function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $titulo = $_POST['tituloDiapo'];
        $descripcion = $_POST['contenidoDiapo'];
        $tipo = $_POST['tipoDiapo'];
        if (isset($_COOKIE["id_ultima_presentacion"])) {
            $idUltimaPresentacion = $_COOKIE["id_ultima_presentacion"];
        }else{}

        if (empty($titulo)) {
          
        } else {
                $bdConexion = ConexionBD::obtenerInstancia();
                $conexion = $bdConexion->getConnection();
                $nDiapositiva = Diapositiva::nDiapositivas($conexion, $idUltimaPresentacion) + 1;
            if($tipo === 'titulo'){
                $diapositiva = new DiapositivaTitulo($titulo, "titulo", $idUltimaPresentacion, $nDiapositiva);

                DiapositivaTitulo::insertDiapositivaTitulo($conexion, $diapositiva);
                $conexion = null;
                header("Location: ../vista/home.php");
                
            }elseif($tipo === 'contenido'){
                $diapositiva = new DiapositivaTituloContenido($titulo,'tituloContenido', $descripcion, $idUltimaPresentacion, $nDiapositiva);

                DiapositivaTituloContenido::insertDiapositivaTituloYContenido($conexion, $diapositiva);
                $conexion = null;
                header("Location: ../vista/home.php");
            }else{}

           

        }
    }

    
}

procesarFormulario();

