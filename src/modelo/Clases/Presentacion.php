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
    protected int $estilo_id;
    protected bool $vistaCliente;
    protected string $nombreURL;
    protected string $pin;

    //Constructor
    public function __construct(string $titulo, $descripcion, int $estilo_id, string $nombreURL, string $pin){
        $this->titulo = $titulo; 
        $this->descripcion = $descripcion;
        $this->diapositivas = [];
        $this->estilo_id = $estilo_id;
        $this->nombreURL = $nombreURL;
        $this->pin = $pin;
        $this->pin = $pin;
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

    public function getEstiloId(): int{
        return $this->estilo_id;
    }

    public function getNombreURL(): string{
        return $this->nombreURL;
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

    public function setEstiloId(int $nuevaEstiloId){
        $this->estilo_id = $$nuevaEstiloId;
    }

    public function setVistaCliente(bool $vistaCliente){
        $this->titulo = $vistaCliente;
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

       //try{
            $sql = "INSERT INTO presentaciones (nombre, descripcion, estilo_id, nombreURL, pin) VALUES (:nombre, :descripcion, :estilo_id, :nombreURL, :pin)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre', $presentacion->titulo);
            $statement->bindValue(':descripcion', $presentacion->descripcion);
            $statement->bindValue(':estilo_id', $presentacion->estilo_id);
            $statement->bindValue(':nombreURL', $presentacion->nombreURL);
            $statement->bindValue(':pin', $presentacion->pin);
            $statement->bindValue(':pin', $presentacion->pin);
            $statement->execute();
            
        /*} catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		} */  
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


    public static function devolverPresentaciones(PDO $pdo){
        try{
            $sql = "SELECT p.id, p.nombre, p.descripcion, estilo_id, vista_cliente, COUNT(d.id) as nroDiapositivas FROM presentaciones p
            LEFT JOIN diapositivas d ON  d.presentaciones_id = p.id GROUP BY p.id;";
            $statement = $pdo->prepare($sql);
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


    public static function devolverPresentacion(PDO $pdo, int $id){
        try{
            $sql = "SELECT id, nombre, descripcion, estilo_id, vista_cliente FROM presentaciones where id = :id;";
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

    public static function devolverPresentacionByURL(PDO $pdo, string $url){
        try{
            $sql = "SELECT id FROM presentaciones WHERE nombreURL = :url;";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':url', $url, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $presId = $result[0]; 
            return $presId;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

    public static function eliminarPresentacion(PDO $pdo, int $id){
        try{
            $sql = "START TRANSACTION;
                    DELETE FROM diapositivas WHERE presentaciones_id = :id;
                    DELETE FROM presentaciones WHERE id = :id;
                    COMMIT;";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $result = "¡Presentación eliminada!";
            return $result;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

    public static function actualizarPresentacion(PDO $pdo, int $id, string $titulo, string $descripcion, int $vistaCliente){
        try{
            $sql = "UPDATE presentaciones SET nombre = :titulo, descripcion = :descripcion, vista_cliente = :vista_cliente WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':vista_cliente', $vistaCliente, PDO::PARAM_INT);
            $statement->execute();
            $result = "¡Presentación actualizada!";
            return $result;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

    public static function compartirPresentacion(PDO $pdo, int $id){
        try{
            $sql = "UPDATE presentaciones SET vista_cliente = 1  WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $result = "¡Presentación compartida!";
            return $result;
        } catch(PDOException $ex){
            echo $ex;
            return false;
        } catch (Exception $ex) {
			echo $ex;
            return false;
		}
    }

    public static function recuperarPinPresentacion(PDO $pdo, $id){
        try{
            $sql = "SELECT pin FROM presentaciones WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchColumn(); 
            return $result;
        } catch(PDOException $ex){
            echo $ex;
           
        } catch (Exception $ex) {
			echo $ex;
            
		}
    }

    public static function estiloPresentacion(PDO $pdo, $id){
        try{
            $sql = "SELECT estilo_id FROM presentaciones WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchColumn(); 
            return $result;
        } catch(PDOException $ex){
            echo $ex;
           
        } catch (Exception $ex) {
			echo $ex;
            
		}
    }

    public static function cambiarEstiloPresentacion(PDO $pdo, $idEstilo, $id){
        try{
            $sql = "UPDATE presentaciones SET estilo_id = :estilo_id WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':estilo_id', $idEstilo, PDO::PARAM_INT);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        } catch(PDOException $ex){
            echo $ex;
           
        } catch (Exception $ex) {
			echo $ex;
            
		}
    }

}