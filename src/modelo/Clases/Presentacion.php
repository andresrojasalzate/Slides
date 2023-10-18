<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

class Presentacion{
    protected int $id;
    protected string $titulo;
    protected string $descripcion;
    protected array $diapositivas;

    //Constructor
    public function __construct(string $titulo,string $descripcion){
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->diapositivas = [];
    }

    //Getters
    public function getTitulo(): string{
        return $this->titulo;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getDiapositivas(): array{
        return $this->diapositivas;
    }

    //Setters

    public function setTitulo(string $nuevoTitulo){
        $this->titulo = $nuevoTitulo;
    }

    public function setId(string $id){
        $this->titulo = $id;
    }

    public function setDescripcion(string $nuevaDescripcion){
        $this->descripcion = $nuevaDescripcion;
    }

    public function setDiapositivas(Diapositiva $nuevaDiapositiva){
        array_push($this->diapositivas,$nuevaDiapositiva);
    }

    /**
     * Funcion para hacer un inserte de una presentacion en la base de datos
     * 
     * @param $pdo objeto que contiene la conexxion con la base de datos
     * @param $presentacion objeto de tipo Presentacion, tiene blos datos que guardaremos
     * @throws PDOExeception esta exception se lanza si hay algun error al intartar insertar los datos
     * @throws Exception esta exception se lanaza si se produce algun error inesperado
     */
    public static function insertPresentacion(PDO $pdo, Presentacion $presentacion){

        try{
            $sql = "INSERT INTO presentaciones (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre', $presentacion->titulo);
            $statement->bindValue(':descripcion', $presentacion->descripcion);
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

    public static function idUltimaPresentacion(PDO $pdo):int{

        try{
            $sql = "SELECT MAX(id) FROM presentaciones;";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetch();
            $maxId = $result[0]; 
            return $maxId;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}

    }
    

}