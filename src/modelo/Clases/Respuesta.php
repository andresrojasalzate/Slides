<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

class Respuesta{
    protected int $id;
    protected string $respuesta;
    protected int $id_pregunta;

    public function __construct(string $respuesta, int $id_pregunta){
        $this->respuesta = $respuesta;
        $this->id_pregunta = $id_pregunta;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getRespuesta(): string{
        return $this->respuesta;
    }

    public function getRIdPregunta(): int{
        return $this->id_pregunta;
    }


    public function setId(int $id){
        $this->id = $id;
    }

    public function setRespuesta(String $respuesta){
        $this->respuesta = $respuesta;
    }

    public function setIdPregunta(String $id_pregunta){
        $this->id_pregunta = $id_pregunta;
    }

    public static function insertRespuesta(PDO $pdo, Respuesta $respuesta){
        try{
            $sql = "INSERT INTO respuestas (respuesta, id_pregunta) VALUES (:respuesta, :id_pregunta)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':respuesta', $presentacion->respuesta);
            $statement->bindValue(':id_pregunta', $presentacion->id_pregunta);
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
            $sql = "SELECT id, respuesta, id_pregunta FROM respuestas where id = :id;";
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