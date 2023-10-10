<?php

 abstract class Diapositiva{
    protected string $titulo;
    protected string $tipo;

    //Constructor

    public function __construct(string $titulo, string $tipoDiapositiva){
        $this->titulo = $titulo;
        $this->tipo = $tipoDiapositiva;
    }

    //Getters
    
    public function getTitulo(): string{
        return $this->titulo;
    }

    public function getTipoDipositiva(): string{
        return $this->tipo;
    }

    //Setters
    public function setTitulo(string $nuevoTitulo){
        $this->titulo = $nuevoTitulo;
    }
    
}