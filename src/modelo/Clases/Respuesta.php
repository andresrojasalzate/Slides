<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

class Respuesta{
    protected int $id;
    protected string $respuesta;
    //protected bool $correcta;
    protected int $idDiapositiva;

    public function __construct(string $respuesta, int $idDiapositiva, /*bool $correcta*/){
        $this->respuesta = $respuesta;
        $this->idDiapositiva = $idDiapositiva;
        //$this->correcta = $correcta;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getRespuesta(): string{
        return $this->respuesta;
    }

    public function getRIdDiapositivq(): int{
        return $this->idDiapositiva;
    }

    /*public function getCorrecta(): bool{
        return $this->correcta;
    }*/


    public function setId(int $id){
        $this->id = $id;
    }

    public function setRespuesta(String $respuesta){
        $this->respuesta = $respuesta;
    }

    /*public function setCorrecta(bool $correceta){
        $this->correcta = $correceta;
    }*/



    public static function insertRespuesta(PDO $pdo, Respuesta $respuesta){
        try{
            $sql = "INSERT INTO respuestas (respuesta, /*correcta,*/ id_diapositiva) VALUES (:respuesta, /*:correcta,*/ :id_diapositiva)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':respuesta', $respuesta->respuesta);
            $statement->bindValue(':id_diapositiva', $respuesta->idDiapositiva);
            //$statement->bindValue(':correcta', $respuesta->correcta);
            $statement->execute();
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

    public static function recuperarRespuesta(PDO $pdo, int $id){
        try{
            $sql = "SELECT id, respuesta, /*correcta,*/ id_diapositiva FROM respuestas where id = :id;";
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
    }

    public static function recuperarRespuestasDePregunta(PDO $pdo, int $idDiapositiva){

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
    }



}