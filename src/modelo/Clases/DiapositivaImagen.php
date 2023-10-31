<?php
namespace src\modelo\Clases;

use PDO;
use Exception;
use PDOException;
use src\modelo\Clases\Diapositiva;

require_once 'Diapositiva.php';


class DiapositivaImagen extends Diapositiva
{

    protected string $img;

    public function __construct(string $titulo, string $tipo, int $id_presentacion, int $nDiapositiva, string $img)
    {
        parent::__construct($titulo, $tipo, $id_presentacion, $nDiapositiva);
        $this->img = $img;
    }


    public static function insertDiapositivaImagen(PDO $pdo, DiapositivaImagen $diapositivaImagen)
    {

        try {
            $sql = "INSERT INTO diapositivas (titulo, imagen, tipoDiapositiva, presentaciones_id, nDiapositiva) VALUES (:titulo, :imagen, :tipo, :id, :nDiapositiva)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':titulo', $diapositivaImagen->titulo);
            $statement->bindValue(':imagen', $diapositivaImagen->img);
            $statement->bindValue(':tipo', $diapositivaImagen->tipo);
            $statement->bindValue(':id', $diapositivaImagen->id_presentacion);
            $statement->bindValue(':nDiapositiva', $diapositivaImagen->nDiapositiva);

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

    public static function getNombreImagen(PDO $pdo, int $diapoId)
    {
        try {
            $sql = "SELECT imagen FROM diapositivas where id = :diapoId;";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':diapoId', $diapoId);
            $statement->execute();
            $nombreImagen = $statement->fetchColumn();
            return $nombreImagen;
        } catch (PDOException $ex) {
            echo $ex;
            return false;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }

    }

    public static function eliminarCarpeta($ruta) {
        $ruta = __DIR__."/../../vista/img/".$ruta;
        if (is_dir($ruta)) {
            $archivos = scandir($ruta);
            foreach ($archivos as $archivo) {
                if ($archivo != '.' && $archivo != '..') {
                    $archivoRuta = $ruta . DIRECTORY_SEPARATOR . $archivo;
                    if (is_dir($archivoRuta)) {
                        self::eliminarCarpeta($archivoRuta);
                    } else {
                        unlink($archivoRuta);
                    }
                }
            }
            rmdir($ruta);
        } else {
        }
    }

}