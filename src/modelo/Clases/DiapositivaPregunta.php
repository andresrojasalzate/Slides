<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

class DiapositivaPregunta extends Diapositiva{
    protected string $pregunta;
    protected string $opcionesRespuestas;

    public function __construct(string $titulo, string $tipo, int $id_presentacion, int $nDiapositiva, string $pregunta, $opcionesRespuestas){

        parent::__construct($titulo, $tipo, $id_presentacion, $nDiapositiva);
        $this->pregunta = $pregunta;
        $this->opcionesRespuestas = $opcionesRespuestas;
    }

    public function getPregunta(): string{
        return $this->pregunta;
    }

    public function getOpcionesRespuestas(): string{
        return $this->opcionesRespuestas;
    }

    public function setPregunta(string $pregunta){
        $this->pregunta = $pregunta;
    }

    public function setOpcionesPregunta(string $opcionesRespuestas){
        $this->opcionesRespuestas = $opcionesRespuestas;
    }

    public static function insertDiapositivaPregunta(PDO $pdo, DiapositivaPregunta $diapositivaPregunta)
    {
        try {
            $sql = "INSERT INTO diapositivas (titulo, pregunta, contenido, tipoDiapositiva, presentaciones_id, nDiapositiva) VALUES (:titulo, :pregunta, :opciones_respuestas, :tipo, :id, :nDiapositiva)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':titulo', $diapositivaPregunta->titulo);
            $statement->bindValue(':pregunta', $diapositivaPregunta->pregunta);
            $statement->bindValue(':opciones_respuestas', $diapositivaPregunta->opcionesRespuestas);
            $statement->bindValue(':tipo', $diapositivaPregunta->tipo);
            $statement->bindValue(':id', $diapositivaPregunta->id_presentacion);
            $statement->bindValue(':nDiapositiva', $diapositivaPregunta->nDiapositiva);
            $statement->execute();
            return true;
        } catch (PDOException $ex) {
            echo $ex;
            return false;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }

    }

    public static function devolverPreguntas($pdo, $id) {
        $sql = "SELECT contenido FROM diapositivas WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        
        $resultado = $statement->fetch();
        
        if ($resultado !== false) {
            $contenido = $resultado['contenido'];
            $contenidoArray = json_decode($contenido, true);
            return $contenidoArray;
        } else {
            return array();
        }
    }

    public static function devolverIdPregunta($pdo, $id) {
        $sql = "SELECT id FROM diapositivas WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        
        $resultado = $statement->fetch();
        
        if ($resultado !== false) {
            $contenido = $resultado['contenido'];
            $contenidoArray = json_decode($contenido, true);
            return $contenidoArray;
        } else {
            return array();
        }
    }

    public static function devolverPregunta($pdo, $id){
        $sql = "SELECT pregunta FROM diapositivas WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        
        return $statement->fetchColumn();
    }
}