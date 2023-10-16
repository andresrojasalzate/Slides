<?php
require_once '../modelo/Clases/Diapositiva.php';
require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/DiapositivaTitulo.php';
require_once '../modelo/Clases/DiapositivaTituloContenido.php';


function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $titulo = $_POST['tituloDiapo'];
        $descripcion = $_POST['contenidoDiapo'];
        $tipo = $_POST['tipoDiapo'];
        $idUltimaPresentacion = intval($_GET['id']);

        if (empty($titulo)) {
          
        } else {
                $bdConexion = ConexionBD::obtenerInstancia();
                $conexion = $bdConexion->getConnection();
                $nDiapositiva = Diapositiva::nDiapositivas($conexion, $idUltimaPresentacion) + 1;
            if($tipo === 'titulo'){
                $diapositiva = new DiapositivaTitulo($titulo, "titulo", $idUltimaPresentacion, $nDiapositiva);

                DiapositivaTitulo::insertDiapositivaTitulo($conexion, $diapositiva);
                header("Location: ../vista/home.php");
                
            }elseif($tipo === 'contenido'){
                $diapositiva = new DiapositivaTituloContenido($titulo,'tituloContenido', $descripcion, $idUltimaPresentacion, $nDiapositiva);

                DiapositivaTituloContenido::insertDiapositivaTituloYContenido($conexion, $diapositiva);
                header("Location: ../vista/home.php");
            }else{}

           

        }
    }

    
}

procesarFormulario();

