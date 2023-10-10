<?php

require_once 'Daipositiva.php';

class DiapositivaTituloContenido extends Diapositiva{
    protected string $contenido;


    //Constructor
    public function __construct(string $titulo, string $tipo, string $contenido){
        parent::__construct($titulo, $tipo);
        $this->contenido = $contenido;
    }


    //Getters

    public function getContenido(): string{
        return $this->contenido;
    }

    //Setters

    public function setContenido(string $nuevoContenido){
        $this->contenido = $nuevoContenido;
    }

}