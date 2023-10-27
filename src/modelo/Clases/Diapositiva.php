<?php
namespace src\modelo\Clases;

use PDO, Exception, PDOException;

 abstract class Diapositiva{
    protected string $titulo;
    protected string $tipo;
    protected int $id_presentacion;
    protected int $nDiapositiva;

    //Constructor

    public function __construct(string $titulo, string $tipoDiapositiva, int $id_presentacion, $nDiapositiva){
        $this->titulo = $titulo;
        $this->tipo = $tipoDiapositiva;
        $this->id_presentacion = $id_presentacion;
        $this->nDiapositiva = $nDiapositiva;
    }

    //Getters
    
    public function getid_presentacion(): int{
        return $this->id_presentacion;
    }
    public function getTitulo(): string{
        return $this->titulo;
    }

    public function getTipoDipositiva(): string{
        return $this->tipo;
    }

    //Setters
    public function setTitulo(string $nuevoTitulo){
        $this->titulo = $nuevoTitulo;
    }
    
    public static function nDiapositivas(PDO $pdo, int $id_presentacion):int{
        try{
            $sql = "SELECT COUNT(*) FROM diapositivas WHERE presentaciones_id = :id_presentacion";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id_presentacion', $id_presentacion, PDO::PARAM_INT);
            $statement->execute();
            $count = $statement->fetchColumn(); 
            return $count;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

    public static function arrayDiapositivas(PDO $pdo, $presentacionId){
        try {
            $sql = "SELECT id, titulo, contenido, tipoDiapositiva, nDiapositiva FROM diapositivas WHERE presentaciones_id = :presentacionId ORDER BY nDiapositiva";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':presentacionId', $presentacionId, PDO::PARAM_INT);
            $statement->execute();
            $diapos = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $diapos;
        } catch(PDOException $ex) {
            echo $ex;
            return false;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }

    public static function eliminarDiapositiva(PDO $pdo, $id){
        try {
            $sql = "DELETE FROM diapositivas WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $confirmacion = "¡Diapositiva eliminada!";
            return $confirmacion;
        } catch(PDOException $ex) {
            echo $ex;
            return false;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }

    public static function reordenarDiapositivas(PDO $pdo, $id, $nDiapositiva){
        try {
            $sql = "UPDATE diapositivas SET nDiapositiva = :nDiapositiva WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':nDiapositiva', $nDiapositiva, PDO::PARAM_INT);
            $statement->execute();
        } catch(PDOException $ex) {
            echo $ex;
            return false;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }

    public static function getDiapo($pdo, $id){
        try {
            $sql = "SELECT * from diapositivas where id = :id;";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $diapo = $statement->fetch(PDO::FETCH_ASSOC);
            return $diapo;
        } catch(PDOException $ex) {
            echo $ex;
            return false;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }

    

    public static function restar1nDiapos($pdo, $id, $nDiapo){
        try {
            $sql = "UPDATE diapositivas SET nDiapositiva = nDiapositiva - 1 WHERE nDiapositiva > :nDiapo and presentaciones_id = :id;";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':nDiapo', $nDiapo, PDO::PARAM_INT);
            $statement->execute();
        } catch(PDOException $ex) {
            echo $ex;
            return false;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }
}