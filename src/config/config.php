<?php

//Ip de conexión
$ip = "172.17.1.20";

//Puerto
$port = "3306";

//Nombre de la base de datos
$dbname = "dbGrupo6";

//Nombre de usuario de la BD
$user = "usuario";

//Contraseña de la BD
$password = "usuario";



$datosBaseDatos = [
    "dsn" => "mysql:host=$ip;port=$port;dbname=$dbname",
    "user" => "$user",
    "password" => "$password"
];

return $datosBaseDatos;