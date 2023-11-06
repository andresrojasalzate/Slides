<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

class Pregunta{
    protected int $id;
    protected string $pregunta;
    protected array $respuestas;
    
    public function __construct(string $pregunta){
        $this->pregunta = $pregunta; 
        $this->respuestas = [];
    }

    public function getId(): int{
        return $this->id;
    }

    public function getPregunta(): string{
        return $this->pregunta;
    }

    public function getRespuestas(): array{
        return $this->respuestas;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setPregunta(string $pregunta){
        $this->id = $id;
    }

    public function setRespuestas(array $respuestas){
        $this->respuestas = $respuestas;
    }

    public static function insertPregunta(PDO $pdo, Pregunta $pregunta){
        try{
            $sql = "INSERT INTO preguntas (pregunta) VALUES (:pregunta)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':pregunta', $presentacion->pregunta);
            $statement->execute();
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

    public static function recuperarPregunta(PDO $pdo, int $id){
        try{
            $sql = "SELECT id, pregunta FROM preguntas where id = :id;";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

}