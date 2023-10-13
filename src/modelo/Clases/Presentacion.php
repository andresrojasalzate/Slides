<?php
require_once 'Diapositiva.php';

class Presentacion{
    protected string $titulo;
    protected string $descripcion;
    protected array $diapositivas;

    //Constructor
    public function __construct(string $titulo,string $descripcion){
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->diapositivas = [];
    }

    //Getters
    public function getTitulo(): string{
        return $this->titulo;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function getDiapositivas(): array{
        return $this->diapositivas;
    }

    //Setters

    public function setTitulo(string $nuevoTitulo){
        $this->titulo = $nuevoTitulo;
    }

    public function setDescripcion(string $nuevaDescripcion){
        $this->descripcion = $nuevaDescripcion;
    }

    public function setDiapositivas(Diapositiva $nuevaDiapositiva){
        array_push($this->diapositivas,$nuevaDiapositiva);
    }

}