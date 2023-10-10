<?php

require_once 'Diapositiva.php';

class DiapositivaTitulo extends Diapositiva{
    
    //Constructor
    public function __construct(string $titulo, string $tipo){
        parent::__construct($titulo, $tipo);
    }
}