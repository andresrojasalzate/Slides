<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

require_once 'Diapositiva.php';

class DiapositivaRespuesta extends Diapositiva{
    protected string $respuestaCorrecta;
    protected int $diapoPreg_id;

    public function __construct(string $titulo, string $tipo, int $id_presentacion, int $nDiapositiva, int $diapoPreg_id , string $respuestaCorrecta){
        parent::__construct($titulo, $tipo, $id_presentacion, $nDiapositiva);
        $this->respuestaCorrecta = $respuestaCorrecta;
        $this->diapoPreg_id = $diapoPreg_id;
    }

    public function getRespuesta(): string{
        return $this->respuestaCorrecta;
    }

    public function getRIdDiapositivq(): int{
        return $this->diapoPreg_id;
    }


    public function setRespuesta(String $respuestaCorrecta){
        $this->respuestaCorrecta = $respuestaCorrecta;
    }


    public static function insertDiapositivaRespuesta(PDO $pdo, DiapositivaRespuesta $diapositivaRespuesta){
        try{
            $sql = "INSERT INTO diapositivas (titulo, contenido, tipoDiapositiva, presentaciones_id, nDiapositiva, diapositivaPreg_id) 
            VALUES (:titulo,:respuestaCorrecta, :tipo, :id, :nDiapositiva, :diapoPreg_id)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':titulo', $diapositivaRespuesta->titulo);
            $statement->bindValue(':respuestaCorrecta', $diapositivaRespuesta->respuestaCorrecta);
            $statement->bindValue(':tipo', $diapositivaRespuesta->tipo);
            $statement->bindValue(':id', $diapositivaRespuesta->id_presentacion);
            $statement->bindValue(':nDiapositiva', $diapositivaRespuesta->nDiapositiva);
            $statement->bindValue(':diapoPreg_id', $diapositivaRespuesta->diapoPreg_id);
            $statement->execute();
            return true;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        }
    }

    /*public static function recuperarRespuesta(PDO $pdo, int $id){
        try{
            $sql = "SELECT id, respuesta,id_diapositiva FROM respuestas where id = :id;";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }*/

    /*public static function recuperarRespuestasDePregunta(PDO $pdo, int $idDiapositiva){

        try{
            $sql = "SELECT respuesta, correcta, id_diapositiva FROM respuestas where id_diapositiva = :id;";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $idDiapositiva, PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $respuestasArray = array();
            foreach ($results as $row) {
                $respuesta = new Respuesta($row['respuesta'], $row['correcta'], $row['id_diapositiva']);
                $respuestasArray[] = $respuesta;
            }
            return $respuestasArray;
        }catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }*/



}