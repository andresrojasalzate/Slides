<?php
require_once 'ConexionBD.php';

$bdConexion = ConexionBD::obtenerInstancia();
$conexion = $bdConexion->getConnection();

//$pdo = new PDO("mysql:host=localhost;dbname=nombre_de_la_base_de_datos", 'root', '1234');
//$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

$unbufferedResult = $conexion->query("SELECT nombre FROM presentaciones");
foreach ($unbufferedResult as $row) {
    echo $row['nombre'] . PHP_EOL;
}
?>