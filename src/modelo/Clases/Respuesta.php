<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

class Respuesta{
    protected int $id;
    protected string $respuesta;
    protected bool $correcta;
    protected int $idDiapositiva;

    public function __construct(string $respuesta, int $idDiapositiva, bool $correcta){
        $this->respuesta = $respuesta;
        $this->id_pregunta = $idDiapositiva;
        $this->correcta = $correcta;
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
    public function getCorrecta(): bool{
        return $this->correcta;
    }


    public function setId(int $id){
        $this->id = $id;
    }

    public function setRespuesta(String $respuesta){
        $this->respuesta = $respuesta;
    }

    public function setIdDiapositiva(String $idPresentacion){
        $this->idPresentacion = $idPresentacion;
    }

    public function setCorrecta(bool $correceta){
        $this->correceta = $correceta;
    }


    public static function insertRespuesta(PDO $pdo, Respuesta $respuesta){
        try{
            $sql = "INSERT INTO respuestas (respuesta, correcta, id_diapositiva) VALUES (:respuesta, :correcta, :id_diapositiva)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':respuesta', $presentacion->respuesta);
            $statement->bindValue(':id_diapositiva', $presentacion->idDiapositiva);
            $statement->bindValue(':correcta', $presentacion->correcta);
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
            $sql = "SELECT id, respuesta, correcta, id_diapositiva FROM respuestas where id = :id;";
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



}