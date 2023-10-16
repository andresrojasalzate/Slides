<?php

require_once 'Diapositiva.php';

class DiapositivaTituloContenido extends Diapositiva{
    protected string $contenido;


    //Constructor
    public function __construct(string $titulo, string $tipo, string $contenido, int $idUltimaPresentacion, int $nDiapositiva){
        parent::__construct($titulo, $tipo, $idUltimaPresentacion, $nDiapositiva);
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

    public static function insertDiapositivaTituloYContenido(PDO $pdo, DiapositivaTituloContenido $diapositivaTituloContenido){

        try{
            $sql = "INSERT INTO diapositivas (titulo, contenido, tipoDiapositiva, presentaciones_id, nDiapositiva) VALUES (:titulo, :contenido, :tipo, :id, :nDiapositiva)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':titulo', $diapositivaTituloContenido->titulo);
            $statement->bindValue(':contenido', $diapositivaTituloContenido->contenido);
            $statement->bindValue(':tipo', $diapositivaTituloContenido->tipo);
            $statement->bindValue(':id', $diapositivaTituloContenido->id_presentacion);
            $statement->bindValue(':nDiapositiva', $diapositivaTituloContenido->nDiapositiva);

            $statement->execute();
            return true;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

}