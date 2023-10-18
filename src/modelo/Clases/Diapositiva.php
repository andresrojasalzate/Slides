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

    public static function devolverDiapositivas(PDO $pdo){
        try{
            $sql = "SELECT presentaciones_id AS id, COUNT(*) AS totalDiapositivas FROM diapositivas group by presentaciones_id ORDER BY id;";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $diapos = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $diapos;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }


}