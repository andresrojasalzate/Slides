<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;

class Estilo{
    protected int $id;
    protected string $nombre;

    public function __construct(int $id, string $nombre){
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId(): int{
        return $this->id;
    }
    
    public function getNombre(): int{
        return $this->nombre;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }

    public static function getAllEstilos(PDO $pdo) {

        try{
            $sql = "SELECT id, nombre, img_resource FROM estilos;";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $ret = $statement->fetchAll(PDO::FETCH_ASSOC);
            

        } catch(PDOException $ex){
            echo $ex;
        } catch (Exception $ex){
            echo $ex;
        }

        return $ret;
    }

}