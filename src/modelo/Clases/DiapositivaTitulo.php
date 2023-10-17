<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;
use src\modelo\Clases\Diapositiva;
require_once 'Diapositiva.php';


class DiapositivaTitulo extends Diapositiva{
    
    //Constructor
    public function __construct(string $titulo, string $tipo, int $id_presentacion, int $nDiapositiva){
        parent::__construct($titulo, $tipo, $id_presentacion, $nDiapositiva);
    }

    public static function insertDiapositivaTitulo(PDO $pdo, DiapositivaTitulo $diapositivaTitulo){

        try{
            
            $sql = "INSERT INTO diapositivas (titulo, tipoDiapositiva, presentaciones_id, nDiapositiva) VALUES (:titulo, :tipo, :id, :nDiapositiva)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':titulo', $diapositivaTitulo->titulo);
            $statement->bindValue(':tipo', $diapositivaTitulo->tipo);
            $statement->bindValue(':id', $diapositivaTitulo->id_presentacion);
            $statement->bindValue(':nDiapositiva', $diapositivaTitulo->nDiapositiva);

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