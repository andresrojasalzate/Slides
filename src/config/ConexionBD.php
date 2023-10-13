<?php
class ConexionBD {

    private  $config;
    private static $instancia = null;
    private $conexion;
    
    private function __construct() {
        $this->config = require 'config.php';

        $this->conexion = new PDO($this->config['dsn'],$this->config['user'] , $this->config['password']);
        
    }
    
    public static function obtenerInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new ConexionBD();
        }
        return self::$instancia;
    }

    public function getConnection() {
        return $this->conexion;
    }
     
    
}