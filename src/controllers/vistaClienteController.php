<?php
session_start();

use src\modelo\Clases\Diapositiva;
use src\modelo\Clases\Estilo;
use src\modelo\Clases\Presentacion;

require_once '../config/ConexionBD.php';
require_once '../modelo/Clases/Presentacion.php';
require_once '../modelo/Clases/Diapositiva.php';
require_once '../modelo/Clases/Estilo.php';

$posDiapo = 0;
$mostrarFeedback = null;
$presentacion = null;

function redireccionPaginaNoEncontrada(){
    header('Location: ../vista/404.php');
    unset($_SESSION['vistaDiapositivas']);
    unset($_SESSION['estilo']);
    unset($_SESSION['posicion']);
}

if($_SERVER['REQUEST_METHOD'] === "GET"){
    $bdConexion = ConexionBD::obtenerInstancia();
    $conexion = $bdConexion->getConnection();
    if(isset($_GET['url'])&& !empty($_GET['url'])){
        $idPres =Presentacion::devolverPresentacionByURL($conexion,$_GET['url']);
        if(!empty($idPres)){
            $presentacion = Presentacion::devolverPresentacion($conexion, $idPres['id']);
            if($presentacion[0]['vista_cliente'] !== 0){
                $_SESSION['vistaDiapositivas'] = Diapositiva::arrayDiapositivas($conexion,$presentacion[0]['id']);
                $_SESSION['estilo'] = Estilo::getEstilo($conexion,$presentacion[0]['estilo_id']);
                $_SESSION['posicion'] = $posDiapo;
            }else{
                redireccionPaginaNoEncontrada();
            }
            
        }else{
            redireccionPaginaNoEncontrada();
        }
        
    }else{
        redireccionPaginaNoEncontrada();
    }
}


if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (isset($_POST['sumar'])) {
        $_SESSION['posicion'] = ($_SESSION['posicion'] + 1) % count($_SESSION['vistaDiapositivas'] );
        $posDiapo = $_SESSION['posicion'];
    } elseif (isset($_POST['restar'])) {
        $_SESSION['posicion'] = ($_SESSION['posicion'] - 1 + count($_SESSION['vistaDiapositivas'] )) % count($_SESSION['vistaDiapositivas'] );
        $posDiapo = $_SESSION['posicion'];
    }
}